<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Media;
use App\Models\Tool;
use Illuminate\Support\Facades\Route;

class FrontendController extends Controller
{
    public function __construct()
    {
    }
    
    public function index()
    {
        $tool = Tool::where('is_home', 1)->first();
        if ($tool) {
            return $this->get_tool($tool);
        } else {
            return view('main')->with('show_main', true);
        }
    }

    public function get_tool($tool)
    {
        //
        $custom = $this->CUSTOM_FUNCTION();
        //
        $is_home = 0;
        if (!$tool->is_home) {
            if ($tool->id == $tool->parent_id) {
                $slug = $tool->slug;
                $slug_n_home['is_home'] = 0;
            } else {
                $slug_n_home = Tool::select('slug', 'is_home')->where('id', $tool->parent_id)->first();
                $slug = $slug_n_home['slug'];
            }
            if ($slug_n_home['is_home'] != 1) {
                $view = 'layout.frontend.pages.' . $slug;
            } else {
                $view = 'layout.frontend.pages.home';
                $is_home = 1;
            }
            $links = Tool::select('slug', 'lang')->where('parent_id', $tool->parent_id)->get();
        } else {
            $links = Tool::select('slug', 'lang')->where('parent_id', $tool->parent_id)->get();
            $view = 'layout.frontend.pages.home';
            $slug = $tool->slug;
            $is_home = 1;
        }
        $meta_title = $tool->meta_title;
        $meta_description = $tool->meta_description;
        $content = json_decode($tool->content);
        return view($view)->with([
            'tool' => $tool,
            'content' => $content,
            'links' => @$links,
            'parent_slug' => $slug,
            'is_home' => $is_home,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'show_canonicals' => true,
            'custom' => $custom,
        ]);
    }
    public function native_language_tool($slug = null)
    {
        $tool = Tool::where('slug', $slug)->first();
        if ($tool) {
            if ($tool->is_home) {
                return to_route('home');
            }
            if ($tool->id != $tool->parent_id) {
                abort(404);
                exit;
            }
            return $this->get_tool($tool);
        } else {
            abort(404);
        }
    }
    public function other_language_tool($lang = null, $slug = null)
    {
        $native_language = config('constants.native_languge');
        $tool = Tool::where([['lang', $lang], ['slug', $slug]])->first();
        if ($tool) {
            if ($native_language == $lang) {
                return to_route('native_language_tool', ['slug' => $slug]);
            } else {
                return $this->get_tool($tool);
            }
        } else {
            abort(404);
        }
    }

    public function blog()
    {
        //
        $custom = $this->CUSTOM_BLOG_FUNCTION();
        //
        $blogs = get_blogs_by_limit(10);
        if (is_null($blogs)) {
            return view('layout.frontend.pages.blog')->with([
                'blogs' => null,
                'meta_title' => "title goes here",
                'meta_description' => "description goes here",
                'custom' => null,
            ]);
        }
        return view('layout.frontend.pages.blog')->with([
            'blogs' => $blogs,
            'meta_title' => "title goes here",
            'meta_description' => "description goes here",
            'custom' => $custom,
        ]);

    }
    public function single_blog($slug = null)
    {
        //
        $custom = $this->CUSTOM_BLOG_FUNCTION();
        //
        $blog_model = new Blog();
        $blog = $blog_model->get_blog($slug);
        return $this->load_single_blog($blog, $custom);
    }

    public function single_blog_other_language($lang = null, $slug = null)
    {
        //
        $custom = $this->CUSTOM_BLOG_FUNCTION();
        //
        $blog_model = new Blog();
        $blog = $blog_model->get_blog($slug, $lang);
        return $this->load_single_blog($blog, $custom);
    }

    public function load_single_blog($blog = null, $custom = null)
    {
        if (is_null($blog)) {
            abort(404);
        } else {
            $parent = $blog->parent;
            $children = $parent->children;
            $blog = $blog->toArray();
        }
        $media = new Media();
        $img_id = $blog['img_id'];
        $images = $media->get_images_by_id($img_id);
        if ($images) {
            foreach ($images as $value) {
                $arr[$value['dimension']] = $value['path'];
            }
            $blog['images'] = $arr;
        } else {
            $blog['images'] = null;
        }

        return view('layout.frontend.pages.single-blog')->with([
            'blog' => $blog,
            'meta_title' => $blog['meta_title'],
            'meta_description' => $blog['meta_description'],
            'custom' => $custom,
            'parent' => $parent,
            'children' => $children,
            'show_blog_canonicals' => true,
        ]);
    }
    public function privacy_policy()
    {
        return view('layout.frontend.pages.privacy-policy');
    }
    public function terms_and_conditions()
    {
        return view('layout.frontend.pages.terms-and-conditions');
    }
    // Custom Function for your general purpose
    public function CUSTOM_FUNCTION()
    {
    }
    // Custom Function for your Blog related
    public function CUSTOM_BLOG_FUNCTION()
    {
    }
    //about-us
    public function about_us()
    {
        return view('layout.frontend.pages.about-us');
    }
    //contact-us
    public function contact_us()
    {
        return view('layout.frontend.pages.contact-us');
    }

    // sitemap
    public function sitemap()
    {
        $tools = Tool::whereColumn('id', 'parent_id')->with('children')->get();
        $links = [];
        if ($tools->count() > 0) {
            foreach ($tools as $key => $item) {
                foreach ($item->children as $c_key => $c_item) {
                    if ($c_item->is_home) {
                        $links[] = route('home');
                    } else {
                        if ($c_item->id == $c_item->parent_id) {
                            $links[] = route('native_language_tool', ['slug' => $c_item->slug]);
                        } else {
                            $links[] = route('other_language_tool', ['lang' => $c_item->lang, 'slug' => $c_item->slug]);
                        }
                    }
                }
            }
        }

        if (Route::has('page.blog')) {
            $links[] = route('page.blog');
        }
        
        $blogs = Blog::whereColumn('id', 'parent_id')->with('children')->get();
        if ($blogs->count() > 0) {
            foreach ($blogs as $key => $item) {
                foreach ($item->children as $c_key => $c_item) {
                    if ($c_item->id == $c_item->parent_id) {
                        $links[] = route('page.single_blog', ['slug' => $c_item->slug]);
                    } else {
                        $links[] = route('single_blog_other_language', ['lang' => $c_item->lang_key, 'slug' => $c_item->slug]);
                    }
                }
            }
        }

        if (Route::has('privacy_policy')) {
            $links[] = route('privacy_policy');
        }
        if (Route::has('terms_and_conditions')) {
            $links[] = route('terms_and_conditions');
        }
        if (Route::has('page.about_us')) {
            $links[] = route('page.about_us');
        }
        if (Route::has('page.contact_us')) {
            $links[] = route('page.contact_us');
        }
        $links = array_merge($links, $this->CUSTOM_SITEMAP_LINKS());
        return response(view('sitemap', ['links' => $links]))
            ->withHeaders([
                'Content-Type' => 'text/xml',
            ]);
    }
    public function CUSTOM_SITEMAP_LINKS()
    {
        $links = [];
        //
        // ....ADD LINKS HERE
        //
        return $links;
    }
}
