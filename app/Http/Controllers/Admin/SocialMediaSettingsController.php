<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMediaSetting;
use Illuminate\Http\Request;

class SocialMediaSettingsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(SocialMediaSetting::class, 'socialMediaSetting');
    }

    public function index()
    {
        //
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
        
        $save = SocialMediaSetting::updateOrCreate(['id'=>1],[
            'facebook_url' => $request->input('facebook_url'),
            'twitter_url' => $request->input('twitter_url'),
            'instagram_url' => $request->input('instagram_url'),
            'pinterest_url' => $request->input('pinterest_url'),
            'linkedIn_url' => $request->input('linkedIn_url'),
            'vk_url' => $request->input('vk_url'),
            'telegram_url' => $request->input('telegram_url'),
            'youtube_url' => $request->input('youtube_url'),
        ]);
        if ($save) {
            return redirect()->route('admin.settings.general.view')->with('success', 'Social Media successfully saved');
        } else {
            return redirect()->route('admin.settings.general.view')->with('error', 'Social Media not saved');
        }
    }

    public function show(SocialMediaSetting $socialMediaSetting)
    {
        //
    }

    public function edit(SocialMediaSetting $socialMediaSetting)
    {
        //
    }

    public function update(Request $request, SocialMediaSetting $socialMediaSetting)
    {
        //
    }

    public function destroy(SocialMediaSetting $socialMediaSetting)
    {
        //
    }
}
