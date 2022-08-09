<?php

use App\Models\Navigation;
use App\Models\GeneralSetting;
use phpDocumentor\Reflection\Types\Boolean;

function appName()
{
    $generalSetting = GeneralSetting::find(1);
    return $generalSetting->application_name;
}

function navigation()
{
    $generalSetting = GeneralSetting::find(1);
    $data['home'] = Navigation::where(['title'=>'home', 'menu_status'=>1])->first();
    $data['navigations'] = Navigation::with(['category.child'])->where(['menu_status'=>1])->take($generalSetting->menu_limit ?? 1)->orderBy('menu_order')->latest('updated_at')->get();

    return $data;
}

function home_menu()
{
    $generalSetting = GeneralSetting::find(1);
    $navigations = Navigation::with(['category.posts'])->where(['home_status'=>1])->take($generalSetting->menu_limit ?? 1)->orderBy('menu_order')->latest('updated_at')->get();

    return $navigations;
}

if (!function_exists('getShorterString')) {
    function getShorterString($text, $length=null, $ucwords=false)
    {
        if ($ucwords == true) {
            $formatedString = ucwords($text);
        } else {
            $formatedString = ucfirst($text);
        }

        if ($length != null) {
            if (strlen($formatedString) <= $length) {
                return $formatedString;
            } else {
                $y=substr($formatedString, 0, $length) . '...';
                return $y;
            }
        } else {
            return $formatedString;
        }
    }
}

?>