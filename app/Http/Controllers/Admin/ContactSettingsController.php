<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactSettingsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ContactSetting::class, 'contactSetting');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $save = ContactSetting::updateOrCreate(['id'=>1],[
            'address' => strtolower($request->input('address')),
            'phone' => $request->input('phone'),
            'email' => trim(strtolower($request->input('email'))),
            'contact_text' => $request->input('contact_text'),
        ]);
        if ($save) {
            return redirect()->route('admin.settings.general.view')->with('success', 'Contact settings successfully saved');
        } else {
            return redirect()->route('admin.settings.general.view')->with('error', 'Contact settings not saved');
        }
    }

    public function show(ContactSetting $contactSetting)
    {
        //
    }

    public function edit(ContactSetting $contactSetting)
    {
        //
    }

    public function update(Request $request, ContactSetting $contactSetting)
    {
        //
    }

    public function destroy(ContactSetting $contactSetting)
    {
        //
    }
}
