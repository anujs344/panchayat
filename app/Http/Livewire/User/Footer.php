<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Navigation;
use App\Models\SocialMediaSetting;

class Footer extends Component
{
    public function render()
    {
        $data = navigation();
        $data['socialMediaLink'] = SocialMediaSetting::find(1);
        return view('livewire.user.footer', $data);
    }
}
