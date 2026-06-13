<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $groups = SiteSetting::allGrouped();

        $groupLabels = [
            'hero'    => 'Hero Section',
            'shop'    => 'Shop Section',
            'about'   => 'About Section',
            'contact' => 'Contact & Social',
            'marquee' => 'Marquee Strip',
            'footer'  => 'Footer',
        ];

        return view('admin.settings.index', compact('groups', 'groupLabels'));
    }

    public function update(Request $request)
    {
        $settings = $request->input('settings', []);

        foreach ($settings as $key => $value) {
            SiteSetting::where('key', $key)->update(['value' => $value]);
        }

        // Handle image uploads
        if ($request->hasFile('setting_files')) {
            foreach ($request->file('setting_files') as $key => $file) {
                $filename = $key . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $filename);
                SiteSetting::where('key', $key)->update(['value' => $filename]);
            }
        }

        Cache::forget('site_settings');

        return back()->with('success', 'Settings saved successfully.');
    }
}
