<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CacheSystem;
use Illuminate\Http\Request;

class CacheSystemController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(CacheSystem::class, 'cacheSystem');
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
     * @param  \App\Models\CacheSystem  $cacheSystem
     * @return \Illuminate\Http\Response
     */
    public function show(CacheSystem $cacheSystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CacheSystem  $cacheSystem
     * @return \Illuminate\Http\Response
     */
    public function edit(CacheSystem $cacheSystem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CacheSystem  $cacheSystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CacheSystem $cacheSystem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CacheSystem  $cacheSystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CacheSystem $cacheSystem)
    {
        //
    }
}
