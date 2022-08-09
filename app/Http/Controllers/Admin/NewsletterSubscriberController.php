<?php

namespace App\Http\Controllers\Admin;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Newsletter as MailNewsletter;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Mail;

class NewsletterSubscriberController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Newsletter::class, 'newsletter');
    }

    public function index()
    {
        $subscriber = NewsletterSubscriber::all();
        return view('admin_dashboard.newsletter-subscriber.index', compact('subscriber'));
    }

    public function sendNewsletter(Newsletter $newsletter)
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('newsletter', $permissions) || request()->user()->role->name == 'admin') {
            return view('admin_dashboard.newsletter-subscriber.sendnewsletter', compact('newsletter'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    public function sendCustomNewsletter($email)
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('newsletter', $permissions) || request()->user()->role->name == 'admin') {
            return view('admin_dashboard.newsletter-subscriber.sendcustomnewsletter', compact('email'));
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('newsletter', $permissions) || request()->user()->role->name == 'admin') {
            $request->validate([
                'email' => 'required|string',
                'content' => 'required',
            ]);
            $data = [
                'subject' => $request->subject,
                'content' => $request->content,
            ];
            $emails = explode(',',$request->email);
            foreach ($emails as $email) {
                Mail::to($email)->send(new MailNewsletter($data));
            }
            
            if (Mail::failures()) {
                return back()->with('error', 'Newsletter not send');
            } else {
                return back()->with('success', 'Newsletter successfully send');
            }
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubscriberNewsletter  $subscriberNewsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsletterSubscriber $newsletterSubscriber)
    {
        if ($newsletterSubscriber->delete()) {
            return redirect()->route('admin.newsletter.view')->with('success', 'Subscriber successfully deleted');
        } else {
            return redirect()->route('admin.newsletter.view')->with('error', 'Subscriber not deleted');
        }
    }
}
