<?php
namespace App\Http\Controllers\Home;

use App\Models\Post;
use App\Models\SeoTool;
use Illuminate\Http\Request;
use App\Mail\WelcomeNewsletter;
use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(){
    
        $sliders = Post::where(['visibility'=>1, 'status'=>1, 'slider'=>1, 'post_type'=>'article'])->where('show_auth_user', '!=', 1)->latest()->get();
        $seo = SeoTool::first();
        $navigations = home_menu();
        $meta['ogtitle'] = ucwords($seo->home_title ?? '');
        $meta['ogdescription'] = ucwords($seo->description ?? '');
        $meta['keywords'] = ucwords($seo->keywords ?? '');
        // dd($data);
         
        // return view('homepage.index',compact('meta'),$data);
        return view('homepage.index')->with(compact('meta', 'sliders', 'navigations'));
    }

    public function subscribe()
    {
        return view('homepage.subscribe');
    }

    public function newsletterSubscribe(Request $request)
    {
        $data = NewsletterSubscriber::whereEmail($request->input('email'))->first();
        if (!isset($data)) {
            NewsletterSubscriber::create([
                'email' => $request->input('email'),
            ]);
            Mail::to($request->input('email'))->send(new WelcomeNewsletter);
            return back()->with('success','You have successfully subscribe our newsletter');
        } else {
            return back()->with('warning','You have allready subscribe our newsletter');
        }
    }
}
