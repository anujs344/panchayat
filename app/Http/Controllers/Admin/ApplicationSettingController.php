<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MaintenanceMode;
use App\Models\ApplicationSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Painless\DynamicConfig\Facades\DynamicConfig;

class ApplicationSettingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ApplicationSetting::class, 'applicationSetting');
        $applicationSetting = ApplicationSetting::first();
        if (isset($applicationSetting)) {
            // Artisan:call('config:cache');
            DynamicConfig::set('app.name', ucwords($applicationSetting->application_name)); 
            DynamicConfig::set('app.timezone', $applicationSetting->timezone);
        }
    }
    
    public function index()
    {
        $data['applicationSetting'] = ApplicationSetting::find(1);
        $data['maintenanceMode'] = MaintenanceMode::find(1);
        $data['timezones'] = ApplicationSetting::$timezones;
        return view('admin_dashboard.settings.application_settings.index', $data);
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
            'application_name' => 'required',
            'timezone' => 'required',
        ]);
        
        $save = ApplicationSetting::updateOrCreate(['id'=>1],[
            'application_name' => trim(strtolower($request->input('application_name'))),
            'timezone' => $request->input('timezone'),
            'cookie_prefix' => strtolower($request->input('cookie_prefix')),
        ]);
        
        if ($save) {
            DynamicConfig::set('app.name', ucwords($save->application_name)); 
            DynamicConfig::set('app.timezone', $save->timezone);
            return redirect()->route('admin.settings.application.view')->with('success', 'Application configuration successfully saved');
        } else {
            return redirect()->route('admin.settings.application.view')->with('error', 'Application configuration not saved');
        }
    }

    public function show(ApplicationSetting $applicationSetting)
    {
        //
    }

    public function edit(ApplicationSetting $applicationSetting)
    {
        //
    }

    public function update(Request $request, ApplicationSetting $applicationSetting)
    {
        // 
    }

    public function destroy(ApplicationSetting $applicationSetting)
    {
        //
    }
}
