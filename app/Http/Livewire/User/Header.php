<?php

namespace App\Http\Livewire\User;

use App\Models\VisualSetting;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        $data = navigation();
        $visualSetting = VisualSetting::first();
        return view('livewire.user.header', $data, compact('visualSetting'));
    }
}
