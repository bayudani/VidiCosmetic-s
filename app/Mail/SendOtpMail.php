<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class SendOtpMail extends Mailable
{
    // public $otp;

    public $otpCode; // <-- Samain namanya jadi otpCode

    public function __construct($otpCode) // <-- Samain namanya jadi otpCode
    {
        $this->otpCode = $otpCode;
    }

    public function build()
    {
        return $this->subject('Kode OTP Verifikasi Akun Anda')
                    ->view('emails.otp');
    }
}
