<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdatePassMailClass extends Mailable
{
    use Queueable, SerializesModels;
    protected $email;
    protected $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $email)
    {
        $this->email = $email;
        $this->password = $data['password'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('a.posmitnaya@itsolutions77.ru')
        ->with([
            'email'=>$this->email,
            'password'=>$this->password,
            ])
        ->view('emails.updatepass')
        ->subject('Смена пароля | Dars Sigur');
    }
}
