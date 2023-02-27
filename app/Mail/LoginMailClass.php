<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginMailClass extends Mailable
{
    use Queueable, SerializesModels;
    protected $email;
    protected $password;
    protected $role;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->role = $data['role'];

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
            'role'=>$this->role,

            ])
        ->view('emails.login')
        ->subject('Регистрация | Dars Sigur');
    }
}
