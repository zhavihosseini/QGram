<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mesg;
    protected $iremm;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($iremm,$mesg)
    {
        $this->mesg = $mesg;
        $this->iremm = $iremm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact')
            ->with([
                'time'=>$this->iremm['time'],
                'subject'=>$this->mesg['subject'],
                'content'=>$this->mesg['content'],
                'link'=>$this->mesg['link'],
                'linkcontent'=>$this->mesg['linkcontent'],
                'name'=>$this->iremm['name'],
            ])
            ->subject('Contact');
    }
}
