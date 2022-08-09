<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLoginConfiguration;
use Illuminate\Http\Request;

class SocialLoginConfigurationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(SocialLoginConfiguration::class, 'socialLoginConfiguration');
    }

    public function index()
    {
        $data['socialLogin'] = SocialLoginConfiguration::find(1);
        
        return view('admin_dashboard.settings.social_login_settings.index', $data);
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
    public function store($type, Request $request)
    {
        if ($type == 'facebook') {
            $request->validate([
                'facebook_id' => 'required',
                'facebook_secret' => 'required',
            ]);

            $save = SocialLoginConfiguration::updateOrCreate(['id'=>1],[
            'facebook_id' => $request->input('facebook_id'),
            'facebook_secret' => $request->input('facebook_secret'),
            ]);

            if ($save) {
                return redirect()->route('admin.settings.socialLogin.view')->with('success', 'Social settings successfully saved');
            } else {
                return redirect()->route('admin.settings.socialLogin.view')->with('error', 'Social settings not saved');
            }
        }

        if ($type == 'google') {
            $request->validate([
                'google_id' => 'required',
                'google_secret' => 'required',
            ]);
            
            $save = SocialLoginConfiguration::updateOrCreate(['id'=>1],[
            'google_id' => $request->input('google_id'),
            'google_secret' => $request->input('google_secret'),
            ]);

            if ($save) {
                return redirect()->route('admin.settings.socialLogin.view')->with('success', 'Social settings successfully saved');
            } else {
                return redirect()->route('admin.settings.socialLogin.view')->with('error', 'Social settings not saved');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialLoginConfiguration  $socialLoginConfiguration
     * @return \Illuminate\Http\Response
     */
    public function show(SocialLoginConfiguration $socialLoginConfiguration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialLoginConfiguration  $socialLoginConfiguration
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialLoginConfiguration $socialLoginConfiguration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialLoginConfiguration  $socialLoginConfiguration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialLoginConfiguration $socialLoginConfiguration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialLoginConfiguration  $socialLoginConfiguration
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialLoginConfiguration $socialLoginConfiguration)
    {
        //
    }
}
