<?php

namespace App\Http\Controllers;

use App\Mail\SendContactForm;
use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function sendContact(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'contactNo' => 'required',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $data = [
            'name' => $request->firstName . " " . $request->lastName,
            'email' => $request->email,
            'contactNo' => $request->contactNo,
            'formMessage' => $request->message,
        ];

        if (env('APP_ENV') == 'local' && app()->debug) {
            Mail::to(env('MAIL_CONTACT'))->send(new SendContactForm($data));
            return view('emails.contact-email-md', ['data' => $data]);
        } else {
            Mail::to(env('MAIL_CONTACT'))->send(new SendContactForm($data));
        }

        return back()->with('success', 'Hi ' . $request->firstName . ' ' . $request->lastName . ', Thanks for contacting us, we will get back to you soon!');
    }
}
