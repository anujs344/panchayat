<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\SiteFontSetting;
use Illuminate\Http\Request;

class SiteFontSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $request->validate([
            'language' => 'required',
            'primary_font' => 'required',
            'secondary_font' => 'required',
            'tertiary_font' => 'required',


        ]);

        $save = SiteFontSetting::create([
            'language' => $request->input('language'),
            'primary_font' => $request->input('primary_font'),
            'secondary_font' => $request->input('secondary_font'),
            'tertiary_font' => $request->input('tertiary_font'),


        ]);
        if ($save) {
            return redirect()->route('admin.settings.font')->with('success', 'Site Font successfully saved');
        } else {
            return redirect()->route('admin.settings.font')->with('error', 'Site Font not saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiteFontSetting  $siteFontSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SiteFontSetting $siteFontSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiteFontSetting  $siteFontSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteFontSetting $siteFontSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SiteFontSetting  $siteFontSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteFontSetting $siteFontSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiteFontSetting  $siteFontSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteFontSetting $siteFontSetting)
    {
        //
    }
}
