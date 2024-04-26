<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tools = Tool::select('id', 'name', 'parent_id', 'lang')->with('parent')->oldest()->get();
        return view('admin.tools.index')->with('tools', $tools);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_files = array_reverse(Storage::files('media'));
        $parent = Tool::select('id', 'name')->whereColumn('id', 'parent_id')->get();
        if ($parent) {
            return view('admin.tools.add')->with('parent', $parent);
        }
        $html = '';
        if (count($all_files) > 0) {
            foreach ($all_files as $image) {
                $html .= view('admin.partials.gallary_image')->with('image', $image)->render();
            }
            return view('admin.tools.add')->with('images', $html);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'is_home' => 'unique:tools,is_home',
            'slug' => 'unique:tools,slug',
        ]);
        $contentKey = !empty($request->contentKey) ? $request->contentKey : '';
        $contentValue = !empty($request->contentKey) ? $request->contentValue : '';
        $inputType = !empty($request->contentKey) ? $request->inputType : '';
        $contentArr = [];
        if (!empty($contentKey) && !empty($contentValue)) {
            for ($i = 0; $i < count($contentKey); $i++) {
                $contentArr[$contentKey[$i]]['type'] = $inputType[$i];
                $contentArr[$contentKey[$i]]['value'] = $contentValue[$i];
            }
        }
        if ($request->parent == 0) {
            $content_json = json_encode($contentArr);
        } else {
            $content_json = Tool::select('content')->where('id', $request->parent)->get();
            $content_json = $content_json[0]->content;
        }
        $is_home = 0;
        if ($request->has('is_home')) {
            $is_home = $request->is_home;
        }
        $tool = Tool::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'lang' => $request->lang,
            'parent_id' => $request->parent,
            'content' => $content_json,
            'is_home' => $is_home,
        ]);
        if ($request->parent == 0) {
            Tool::where('id', $tool->id)->update(['parent_id' => $tool->id]);
        }
        if ($tool) {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function show(Tool $tool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function edit(Tool $tool)
    {
        $images = Media::get_media();
        $parent = Tool::select('id', 'name')->whereColumn('id', 'parent_id')->get();
        return view('admin.tools.edit')->with('tool', $tool)->with([
            'parent' => $parent,
            'images' => $images,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tool $tool)
    {
        $tool->name = $request->name;
        if ($request->filled('slug')) {
            $tool->slug = $request->slug;
        }
        $tool->meta_title = $request->meta_title;
        $tool->meta_description = $request->meta_description;
        $contentKey = !empty($request->contentKey) ? $request->contentKey : '';
        $contentValue = !empty($request->contentKey) ? $request->contentValue : '';
        $inputType = !empty($request->contentKey) ? $request->inputType : '';
        $contentArr = [];
        if (!empty($contentKey) && !empty($contentValue)) {
            for ($i = 0; $i < count($contentKey); $i++) {
                $regex = '/[^A-Za-z1-9\_]/gi';
                $contentKey[$i] = Str::replace($regex, "_", $contentKey[$i]);
                $contentArr[$contentKey[$i]]['type'] = $inputType[$i];
                $contentArr[$contentKey[$i]]['value'] = $contentValue[$i];
            }
        }
        $content_json = json_encode($contentArr);
        $tool->content = $content_json;
        $tool->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tool $tool)
    {
        $this->authorize('super_admin');
        $tool->delete();
        return back();
    }

    public function trash_list()
    {
        $this->authorize('super_admin');
        $tools = Tool::onlyTrashed()->get();
        return view('admin.tools.trash')->with(['tools' => $tools]);
    }
    public function tool_permanent_destroy($id)
    {
        $this->authorize('super_admin');
        Tool::onlyTrashed()->find($id)->forceDelete();
        return back();
    }

    public function tool_restore($id)
    {
        $this->authorize('super_admin');
        Tool::withTrashed()->find($id)->restore();
        return back();
    }

    public function download(Tool $tool)
    {
        if ($tool) {
            header('Content-Type: application/json');
            $content = $tool['content'];
            $content_to_store = json_encode(json_decode($content), JSON_PRETTY_PRINT);
            $target = "tool_content";
            if (!Storage::exists($target)) {
                Storage::makeDirectory($target, 0777, true, true);
            }
            $fileName = "content_" . time() . ".json";
            $path = $target . '/' . $fileName;
            Storage::path($path);
            if (Storage::put($target . '/' . $fileName, $content_to_store)) {
                return Storage::download($path);
            }
        }
    }
    public function upload_tool_content(Request $request, Tool $tool)
    {
        $this->authorize('super_admin');
        $type = (int) $request->get('btnradio');
        if ($type == 1) {
            $array1 = json_decode($tool->content, true);
            $array2 = json_decode($request->upload_json, true);
            $mergedJson = json_encode(array_merge($array1, $array2));
            $tool->content = $mergedJson;
        } else if ($type == 2) {
            $tool->content = $request->upload_json;
        }
        $tool->save();
        return redirect()->back();
    }
    public function tool_audit($id)
    {
        $audits = Tool::find($id)->audits->reverse();
        return view('admin.tools.audit')->with([
            'audits' => $audits,
        ]);
    }
}
