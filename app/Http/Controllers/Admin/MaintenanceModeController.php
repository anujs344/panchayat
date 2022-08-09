<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceMode;
use Illuminate\Http\Request;

class MaintenanceModeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(MaintenanceMode::class, 'maintenanceMode');
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
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',

        ]);

        $save = MaintenanceMode::updateOrCreate(['id'=>1],[
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),

        ]);
        if ($save) {
            return redirect()->route('admin.settings.application.view')->with('success',  'Maintenance Mode Settings successfully saved');
        } else {
            return redirect()->route('admin.settings.application.view')->with('error', ' Maintenance Mode Settings not saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaintenanceMode  $maintenanceMode
     * @return \Illuminate\Http\Response
     */
    public function show(MaintenanceMode $maintenanceMode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaintenanceMode  $maintenanceMode
     * @return \Illuminate\Http\Response
     */
    public function edit(MaintenanceMode $maintenanceMode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaintenanceMode  $maintenanceMode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaintenanceMode $maintenanceMode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaintenanceMode  $maintenanceMode
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaintenanceMode $maintenanceMode)
    {
        //
    }
}
