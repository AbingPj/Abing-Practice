<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function sendEmailSample()
    {

        $to_name = 'TO LEopoldo Abi';
        $to_email = 'leopoldo.a@filipinowebmasters.com';
        $data = array('name' => "Sam Jose", "body" => "Test mail");
        Mail::send('emails.mail', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Artisans Web Testing Mail');
            $message->from('abing.leopold@gmail.com', 'Artisans Web');
        });
    }
}
