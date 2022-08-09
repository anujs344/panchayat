<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ContactMessage::class, 'contactMessage');
    }

    public function index()
    {
        $contactMessages = ContactMessage::all();
        return view('admin_dashboard.contact-message.index', compact('contactMessages'));
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
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Http\Response
     */
    public function show(ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactMessage $contactMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactMessage  $contactMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $deleted = $contactMessage->delete();
        if ($deleted) {
            return redirect()->route('admin.contactMessage.view')->with('success', 'Contact message successfully deleted');
        } else {
            return redirect()->route('admin.contactMessage.view')->with('error', 'Contact message not deleted');
        }
        
    }
}
