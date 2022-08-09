<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Newsletter::class, 'newsletter');
    }

    public function index()
    {
        $newsletters = Newsletter::all();
        return view('admin_dashboard.newsletter.index', compact('newsletters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.newsletter.create');
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
        ]);

        $save = Newsletter::create([
            'title' => trim(strtolower($request->input('title'))),
            'content' => $request->input('content'),
        ]);

        if ($save) {
            return redirect()->route('admin.newsletter.view')->with('success', 'Newsletter successfully created');
        } else {
            return redirect()->route('admin.newsletter.view')->with('error', 'Newsletter not created');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        return view('admin_dashboard.newsletter.show', compact('newsletter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {
        return view('admin_dashboard.newsletter.edit', compact('newsletter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $newsletter->title = trim(strtolower($request->input('title')));
        $newsletter->content = $request->input('content');

        if ($newsletter->save()) {
            return redirect()->route('admin.newsletter.view')->with('success', 'Newsletter successfully updated');
        } else {
            return redirect()->route('admin.newsletter.view')->with('error', 'Newsletter not updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        if ($newsletter->delete()) {
            return redirect()->route('admin.newsletter.view')->with('success', 'Newsletter successfully deleted');
        } else {
            return redirect()->route('admin.newsletter.view')->with('error', 'Newsletter not deleted');
        }
    }
}
