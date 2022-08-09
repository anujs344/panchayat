<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ContactSetting;
use App\Models\GeneralSetting;
use App\Models\GoogleRecaptcha;
use App\Models\SocialMediaSetting;
use App\Http\Controllers\Controller;

class GeneralSettingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(GeneralSetting::class, 'generalSetting');
    }

    public function index()
    {
        $data['generalSetting'] = GeneralSetting::find(1);
        $data['contactSetting'] = ContactSetting::find(1);
        $data['socialMediaSetting'] = SocialMediaSetting::find(1);
        $data['google_reCAPTCHA'] = GoogleRecaptcha::find(1);
        
        return view('admin_dashboard.settings.general_settings.index', $data);
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
        $save = GeneralSetting::updateOrCreate(['id'=>1],[
            'menu_limit' => $request->input('menu_limit'),
            'cookie_warning' => $request->input('cookie_warning'),
            'cookie_text' => $request->input('cookie_text'),
            'footer_about_section' => $request->input('footer_about_section'),
            // 'post_url' => strtolower($request->input('post_url')),
            'copyright' => $request->input('copyright'),
        ]);

        if ($save) {
            return redirect()->route('admin.settings.general.view')->with('success', 'General settings successfully saved');
        } else {
            return redirect()->route('admin.settings.general.view')->with('error', 'General settings not saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function show(GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(GeneralSetting $generalSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeneralSetting $generalSetting)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GeneralSetting  $generalSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneralSetting $generalSetting)
    {
        //
    }
}
