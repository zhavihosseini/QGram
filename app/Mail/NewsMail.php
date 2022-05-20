<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $message;
    protected $users;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($users,$message)
    {
        $this->message = $message;
        $this->users = $users;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $time = Carbon::now()->toArray()['formatted'];

        return $this->view('emails.news')->with([
            'subject'=>$this->message['subject'],
            'content'=>$this->message['content'],
            'link'=>$this->message['link'],
            'linkcontent'=>$this->message['linkcontent'],
            'name'=>$this->users['name'],
            'username'=>$this->users['username'],
        ]);
    }
}
