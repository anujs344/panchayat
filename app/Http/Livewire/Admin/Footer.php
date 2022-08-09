<?php

namespace App\Http\Livewire\Admin;

use App\Models\GeneralSetting;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $generalSetting = GeneralSetting::first();
        return view('livewire.admin.footer', compact('generalSetting'));
    }
}
