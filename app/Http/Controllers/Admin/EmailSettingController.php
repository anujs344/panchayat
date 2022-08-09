<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Painless\DynamicConfig\Facades\DynamicConfig;

class EmailSettingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(EmailSetting::class, 'emailSetting');
    }

    public function index()
    {
        $data['emailSetting'] = EmailSetting::first();
        $data['mailers'] = EmailSetting::$mailers;

        return view('admin_dashboard.settings.email_settings.index', $data);
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
    public function store($type, Request $request)
    {
        if ($type == 'setting') {
            $request->validate([
                'from_address' => 'required',
                'from_name' => 'required',
                'host' => 'required',
                'port' => 'required',
                'username' => 'required',
                'password' => 'required',
            ]);

            $save = EmailSetting::updateOrCreate(['id'=>1],[
                'library' => $request->input('library'),
                'from_address' => strtolower($request->input('from_address')),
                'from_name' => $request->input('from_name'),
                'host' => $request->input('host'),
                'port' => $request->input('port'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ]);

            if ($save) {
                DynamicConfig::set('mail.default', $save->library); 
                DynamicConfig::set('mail.from.address', $save->from_address);
                DynamicConfig::set('mail.from.name', $save->from_name);
                DynamicConfig::set('mail.mailers.smtp.host', $save->host);
                DynamicConfig::set('mail.mailers.smtp.port', $save->port);
                DynamicConfig::set('mail.mailers.smtp.username', $save->username);
                DynamicConfig::set('mail.mailers.smtp.password', $save->password);
                return redirect()->route('admin.settings.email.view')->with('success', 'Email settings successfully saved');
            } else {
                return redirect()->route('admin.settings.email.view')->with('error', 'Email settings not saved');
            }
        }

        if ($type == 'verification') {
            $save = EmailSetting::updateOrCreate(['id'=>1],[
                'verification_status' => $request->input('verification_status'),
            ]);

            if ($save) {
                return redirect()->route('admin.settings.email.view')->with('success', 'Email settings successfully saved');
            } else {
                return redirect()->route('admin.settings.email.view')->with('error', 'Email settings not saved');
            }
        }

        if ($type == 'contact') {
            $save = EmailSetting::updateOrCreate(['id'=>1],[
                'contact_message_status' => $request->input('contact_message_status'),
                'contact_message_email' => strtolower($request->input('contact_message_email')),
            ]);

            if ($save) {
                return redirect()->route('admin.settings.email.view')->with('success', 'Email settings successfully saved');
            } else {
                return redirect()->route('admin.settings.email.view')->with('error', 'Email settings not saved');
            }
        }

        if ($type == 'test_mail') {
                return $request->input('test_mail');

            if (true) {
                return redirect()->route('admin.settings.email.view')->with('success', 'Email settings successfully saved');
            } else {
                return redirect()->route('admin.settings.email.view')->with('error', 'Email settings not saved');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmailSetting  $emailSetting
     * @return \Illuminate\Http\Response
     */
    public function show(EmailSetting $emailSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailSetting  $emailSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailSetting $emailSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmailSetting  $emailSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailSetting $emailSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailSetting  $emailSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailSetting $emailSetting)
    {
        //
    }
}
