<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.registration_success')
                    ->with([
                        'name' => $this->user->name,
                        'role' => $this->user->role,
                    ])
                    ->subject('Registration Successful');
    }
}
