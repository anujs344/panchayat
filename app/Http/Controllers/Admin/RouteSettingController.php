<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RouteSetting;
use Illuminate\Http\Request;

class RouteSettingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(RouteSetting::class, 'routeSetting');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RouteSetting  $routeSetting
     * @return \Illuminate\Http\Response
     */
    public function show(RouteSetting $routeSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RouteSetting  $routeSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(RouteSetting $routeSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RouteSetting  $routeSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RouteSetting $routeSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RouteSetting  $routeSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(RouteSetting $routeSetting)
    {
        //
    }
}
