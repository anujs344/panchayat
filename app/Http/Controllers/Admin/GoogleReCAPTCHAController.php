<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoogleRecaptcha;
use Illuminate\Http\Request;

class GoogleReCAPTCHAController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(GoogleRecaptcha::class, 'googleRecaptcha');
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
        $request->validate([
            'site_key' => 'required',
            'secret_key' => 'required',
        ]);

        $save = GoogleRecaptcha::updateOrCreate(['id'=>1],[
            'site_key' => $request->input('site_key'),
            'secret_key' => $request->input('secret_key'),
        ]);
        if ($save) {
            return redirect()->route('admin.settings.general.view')->with('success',  'Google_reCAPTCHA Settings successfully saved');
        } else {
            return redirect()->route('admin.settings.general.view')->with('error', ' Google_reCAPTCHA Settings not saved');
        }
    }

    public function show(GoogleRecaptcha $googleRecaptcha)
    {
        //
    }

    public function edit(GoogleRecaptcha $googleRecaptcha)
    {
        //
    }

    public function update(Request $request, GoogleRecaptcha $googleRecaptcha)
    {
        //
    }

    public function destroy(GoogleRecaptcha $googleRecaptcha)
    {
        //
    }
}
