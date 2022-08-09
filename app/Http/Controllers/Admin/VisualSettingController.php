<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\VisualSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class VisualSettingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(VisualSetting::class, 'visualSetting');
    }

    public function index()
    {
        $data['visualSetting'] = VisualSetting::find(1);

        return view('admin_dashboard.settings.visual_settings.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'logo' => 'image|mimes:png,jpg,jpeg,svg,gif,',
            'logo_footer' => 'image|mimes:png,jpg,jpeg,svg,gif,',
            'logo_email' => 'image|mimes:png,jpg,jpeg',
            'favicon_icon' => 'image|mimes:png',
        ]);

        $file1 = $request->file('logo');
        $file2 = $request->file('logo_footer');
        $file3 = $request->file('logo_email');
        $file4 = $request->file('favicon_icon');
        
        $visualSetting = VisualSetting::find(1);
        // logo
        if($request->hasFile('logo')){
            $logo = sprintf('logo_%s' . '.'. $file1->getClientOriginalExtension(), rand(1, 1000));
            if(isset($visualSetting) && Storage::exists('/public/media/images/logo/'.$visualSetting->logo)){
                Storage::delete(['public/media/images/logo/' . $visualSetting->logo]);
            }
            $file1->storeAs('media/images/logo', $logo, 'public');
        } else {
            if (isset($visualSetting->logo)) {
                $logo = $visualSetting->logo;
            } else{
                $logo = null;
            }
        }
        // logo footer
        if($request->hasFile('logo_footer')){
            $logo_footer = sprintf('logo_footer_%s' . '.'. $file2->getClientOriginalExtension(), rand(1, 1000));
            if(isset($visualSetting) && Storage::exists('/public/media/images/logo/'.$visualSetting->logo_footer)){
                Storage::delete(['public/media/images/logo/' . $visualSetting->logo_footer]);
            }
            $file2->storeAs('media/images/logo', $logo_footer, 'public');
        } else {
            if (isset($visualSetting->logo_footer)) {
                $logo_footer = $visualSetting->logo_footer;
            } else{
                $logo_footer = null;
            }
        }
        // logo email
        if($request->hasFile('logo_email')){
            $logo_email = sprintf('logo_email_%s' . '.'. $file3->getClientOriginalExtension(), rand(1, 1000));
            if(isset($visualSetting) && Storage::exists('/public/media/images/logo/'.$visualSetting->logo_email)){
                Storage::delete(['public/media/images/logo/' . $visualSetting->logo_email]);
            }
            $file3->storeAs('media/images/logo', $logo_email, 'public');
        } else {
            if (isset($visualSetting->logo_email)) {
                $logo_email = $visualSetting->logo_email;
            } else{
                $logo_email = null;
            }
        }
        // favicon icon
        if($request->hasFile('favicon_icon')){
            $favicon_icon = sprintf('favicon_icon_%s' . '.'. $file4->getClientOriginalExtension(), rand(1, 1000));
            if(isset($visualSetting) && Storage::exists('/public/media/images/logo/'.$visualSetting->favicon_icon)){
                Storage::delete(['public/media/images/logo/' . $visualSetting->favicon_icon]);
            }
            $file4->storeAs('media/images/logo', $favicon_icon, 'public');
        } else {
            if (isset($visualSetting->favicon_icon)) {
                $favicon_icon = $visualSetting->favicon_icon;
            } else{
                $favicon_icon = null;
            }
        }
        
        $save = VisualSetting::updateOrCreate(['id'=>1],[
            'logo' => $logo,
            'logo_footer' => $logo_footer,
            'logo_email' => $logo_email,
            'favicon_icon' => $favicon_icon,
        ]);
        
        if ($save) {
            return redirect()->route('admin.settings.visual.view')->with('success', 'Visual settings successfully saved');
        } else {
            return redirect()->route('admin.settings.visual.view')->with('error', 'Visual settings not saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisualSetting  $visualSetting
     * @return \Illuminate\Http\Response
     */
    public function show(VisualSetting $visualSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisualSetting  $visualSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(VisualSetting $visualSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisualSetting  $visualSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisualSetting $visualSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisualSetting  $visualSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisualSetting $visualSetting)
    {
        //
    }
}
