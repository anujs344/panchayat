@php
use App\Models\VisualSetting;
    $visualSetting = VisualSetting::first();
@endphp
<a href="/" style="display:flex;align-items:center;">
    <img style="width:3rem;" src="{{ isset($visualSetting) ? asset('storage/media/images/logo/' . $visualSetting->logo) : '' }}">
    <div style="font-size: 32px;color:#00f;font-weight:500;padding:0 6px;">{{ config('app.name', '') }}</div>
</a>