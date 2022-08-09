<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoTool;
use Illuminate\Http\Request;

class SeoToolController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(SeoTool::class, 'seoTool');
    }

    public function index()
    {
        $data['seo'] = SeoTool::find(1);
        
        return view('admin_dashboard.settings.seo_settings.index', $data);
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
            'site_title' => 'required',
            'home_title' => 'required',
        ]);

        $save = SeoTool::updateOrCreate(['id'=>1],[
        'site_title' => strtolower($request->input('site_title')),
        'home_title' => strtolower($request->input('home_title')),
        'description' => strtolower($request->input('description')),
        'keywords' => strtolower($request->input('keywords')),
        ]);

        if ($save) {
            return redirect()->route('admin.settings.seo.view')->with('success', 'SEO tools successfully saved');
        } else {
            return redirect()->route('admin.settings.seo.view')->with('error', 'SEO tools not saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SeoTool  $seoTool
     * @return \Illuminate\Http\Response
     */
    public function show(SeoTool $seoTool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SeoTool  $seoTool
     * @return \Illuminate\Http\Response
     */
    public function edit(SeoTool $seoTool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SeoTool  $seoTool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SeoTool $seoTool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SeoTool  $seoTool
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeoTool $seoTool)
    {
        //
    }
}
