<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LanguageSetting;
use Illuminate\Http\Request;

class LanguageSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['language_settings'] = LanguageSetting::all();
        return view('admin_dashboard.settings.language_settings.index',$data);
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
            'language_name' => 'required',
            'short_form' => 'required',
            'language_code' => 'required',
            'text_editor_language' => 'required',
            'menu_order' => 'required',
            'text_direction' => 'required',
            'status' => 'required',
        ]);

        $save = LanguageSetting::create([
            'language_name' => $request->input('language_name'),
            'short_form' => $request->input('short_form'),
            'language_code' => $request->input('language_code'),
            'menu_order' => $request->input('menu_order'),
            'text_editor_language' => $request->input('text_editor_language'),
            'text_direction' => $request->input('text_direction'),
            'text_direction' => $request->input('text_direction'),
            'status' => $request->input('status'),
        ]);
        if ($save) {
            return redirect()->route('admin.settings.language')->with('success', 'Add Language successfully created');
        } else {
            return redirect()->route('admin.settings.language')->with('error', 'Add Language not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LanguageSetting  $languageSetting
     * @return \Illuminate\Http\Response
     */
    public function show(LanguageSetting $languageSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LanguageSetting  $languageSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(LanguageSetting $languageSetting,$id)
    {
        $data['language_settings']=LanguageSetting::where('id',$id)->first();
        return view('admin_dashboard.settings.language_settings.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LanguageSetting  $languageSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, LanguageSetting $languageSetting,$l)
    { $req->validate([
        'language_name' => 'required',
        'short_form' => 'required',
        'language_code' => 'required',
        'text_editor_language' => 'required',
        'menu_order' => 'required',
        'text_direction' => 'required',
        'status' => 'required',

    ]);

    LanguageSetting::where('id',$l)->update([
        'language_name' =>$req->language_name,
        'short_form' =>$req->short_form,
        'language_code' =>$req->language_code,
        'text_editor_language' =>$req->text_editor_language,
        'menu_order' =>$req->menu_order,
        'text_direction' =>$req->text_direction,
        'status' =>$req->status,

    ]);

    return redirect()->route('admin.settings.language')->with('success', 'Language successfully updated');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LanguageSetting  $languageSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(LanguageSetting $languageSetting,$id)
    {
        LanguageSetting::find($id)->delete();
        return redirect()->route('admin.settings.language')->with('success', 'Language successfully deleted');

    }


}
