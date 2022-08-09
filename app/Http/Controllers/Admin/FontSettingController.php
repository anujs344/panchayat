<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FontSetting;
use Illuminate\Http\Request;

class FontSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['font_settings'] = FontSetting::all();
        return view('admin_dashboard.settings.font_settings.index',$data);
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
            'name' => 'required',
            'short_form' => 'required',
            'url' => 'required',
            'font_family' => 'required',

        ]);

        $save = FontSetting::create([
            'name' => $request->input('name'),
            'short_form' => $request->input('short_form'),
            'url' => $request->input('url'),
            'font_family' => $request->input('font_family'),

        ]);
        if ($save) {
            return redirect()->route('admin.settings.font')->with('success', 'Add Font successfully created');
        } else {
            return redirect()->route('admin.settings.font')->with('error', 'Add Font not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FontSetting  $fontSetting
     * @return \Illuminate\Http\Response
     */
    public function show(FontSetting $fontSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FontSetting  $fontSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(FontSetting $fontSetting,$id)
    {
        $data['font_settings']=FontSetting::where('id',$id)->first();
        return view('admin_dashboard.settings.font_settings.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FontSetting  $fontSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FontSetting $fontSetting,$l)
    {
        $request->validate([
            'name' => 'required',
            'short_form' => 'required',
            'url' => 'required',
            'font_family' => 'required',

        ]);

        FontSetting::where('id',$l)->update([
            'name' =>$request->name,
            'short_form' =>$request->short_form,
            'url' =>$request->url,
            'font_family' =>$request->font_family,

        ]);

        return redirect()->route('admin.settings.font')->with('success', 'Language successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FontSetting  $fontSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(FontSetting $fontSetting,$id)
    {
        FontSetting::find($id)->delete();
        return redirect()->route('admin.settings.font')->with('success', 'Language successfully deleted');
    }
}
