<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Setting;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    public function dashboard()
    {
        $audits = Tool::with('audits')->get();
        return view('admin.dashboard')->with(['tools_with_audits' => $audits]);
    }

    public function settings()
    {
        $media = Setting::where('section', 'media')->get();
        $content = Setting::where('section', 'content')->get();
        return view('admin.settings', compact('media', 'content'));
    }
    public function update_settings(Request $request)
    {
        Setting::updateOrInsert(
            ['key' => 'large_image_width'],
            ['value' => $request->large_image_width, 'section' => 'media', 'type' => 'text']
        );
        Setting::updateOrInsert(
            ['key' => 'thumbnail_width'],
            ['value' => $request->thumbnail_width, 'section' => 'media', 'type' => 'text']
        );
        Setting::updateOrInsert(
            ['key' => 'small_image_width'],
            ['value' => $request->small_image_width, 'section' => 'media', 'type' => 'text']
        );
        Setting::updateOrInsert(
            ['key' => 'small_image_height'],
            ['value' => $request->small_image_height, 'section' => 'media', 'type' => 'text']
        );

        $contentKey = !empty($request->contentKey) ? $request->contentKey : '';
        $sectionType = !empty($request->sectionType) ? $request->sectionType : '';
        $contentValue = !empty($request->contentKey) ? $request->contentValue : '';
        $inputType = !empty($request->contentKey) ? $request->inputType : '';
        $autoload = !empty($request->autoload) ? $request->autoload : '';
        for ($i = 0; $i < count($contentKey); ++$i) {
            Setting::updateOrInsert(
                ['key' => $contentKey[$i]],
                ['value' => $contentValue[$i], 'type' => $inputType[$i], 'section' => $sectionType[$i], 'autoload' => $autoload[$i]]
            );
        }
        return back();

    }
    public function modals()
    {
        $images = Media::get_media();
        return view('admin.components')->with([
            'images' => $images,
        ]);
    }
    public function settings_delete(Request $request)
    {
        $this->authorize('super_admin');
        if (Setting::destroy($request->id)) {
            return 1;
        }
    }
    public function setCookie(Request $request, $hash)
    {
        $admin = User::where('hash', $hash)->first();
        // dd($admin);
        if ($admin != null) {
            return to_route('admin_login')->withCookie(cookie()->forever('admin_hash', $hash));
        } else {
            Cookie::queue(Cookie::forget('admin_hash'));
            return redirect('/');
        }
    }
}
