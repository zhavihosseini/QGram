<?php

namespace App\Mail;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $url = route('login');
        $time = Carbon::now()->toArray()['formatted'];
        return $this->view('emails.welcome')
            ->with([
                'fname'=> $this->user['name'],
                'username'=>$this->user['username'],
                'time'=>$time,
                'url'=>$url,
            ])
            ->subject('Welcome To Q Gram');
    }
}
