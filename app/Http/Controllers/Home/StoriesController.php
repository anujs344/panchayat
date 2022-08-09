<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Navigation;

use Illuminate\Http\Request;

class StoriesController extends Controller
{
    public function stories(){
        return view('homepage.stories');
    }
}
