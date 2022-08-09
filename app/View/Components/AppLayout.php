<?php

namespace App\View\Components;

use App\Models\VisualSetting;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $visualSetting = VisualSetting::first();
        return view('layouts.app', compact('visualSetting'));
    }
}
