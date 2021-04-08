<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

class AppMailer{

    public function __constructor()
    {
        # code...
    }
    public function welcomeMail($arg)
    {

    }

    public static function ticketCreated($user, $arg)
    {
        Mail::to($user)->new
        # code...
    }

    public function ticketReplied($arg)
    {
        # code...
    }

    public function withdrawalRequest($arg)
    {
        # code...
    }

    public function newDeposit($arg)
    {
        # code...
    }

    public function verifyEmail($arg)
    {
        # code...
    }
}


