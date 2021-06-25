<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrdenMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');   
    }

    public function enviar(Request $request, $numero)
    {
        $user = $request->user();
        $correo = New posts($user, $numero);
        $post->comments()->save($comment);
        

        Mail::to($user)->send($correo);

        return "Se envio el correo electronico";
    }
}
