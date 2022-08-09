<?php

namespace App\Http\Livewire\Admin;

use App\Models\VisualSetting;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();
        $visualSetting = VisualSetting::first();
        return view('livewire.admin.sidebar', compact('visualSetting', 'permissions'));
    }
}
