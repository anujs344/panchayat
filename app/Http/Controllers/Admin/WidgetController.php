<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Widget::class, 'widget');
    }

    public function index()
    {
        $widgets = Widget::all();
        return view('admin_dashboard.widget/index', compact('widgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_dashboard.widget/create');
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
            'title' => 'required'
        ]);

        $save = Widget::create([
            'title' => trim(strtolower($request->input('title'))),
            'widget_order' => $request->input('order'),
            'visibility' => $request->input('visibility'),
            'content' => $request->input('content'),
        ]);

        if ($save) {
            return redirect()->route('admin.widget.view')->with('success', 'Widget successfully created');
        } else {
            return redirect()->route('admin.widget.view')->with('error', 'Widget not created');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function show(Widget $widget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function edit(Widget $widget)
    {
        return view('admin_dashboard.widget/edit', compact('widget'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Widget $widget)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $widget->title = trim(strtolower($request->input('title')));
        $widget->widget_order = $request->input('order');
        $widget->visibility = $request->input('visibility');
        $widget->content = $request->input('content');

        if ($widget->save()) {
            return redirect()->route('admin.widget.view')->with('success', 'Widget successfully created');
        } else {
            return redirect()->route('admin.widget.view')->with('error', 'Widget not created');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Widget $widget)
    {
        if ($widget->delete()) {
            return redirect()->route('admin.widget.view')->with('success', 'Widget successfully deleted');
        } else {
            return redirect()->route('admin.widget.view')->with('error', 'Widget not deleted');
        }
    }
}
