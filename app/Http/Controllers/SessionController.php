<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public static function store($type, $value) {
        if (Auth::user()->role_id==2) {
            $session = new Session();
            $session->user_id = Auth::user()->id;
            $session->type = $type;
            $session->value = $value;
            $session->save();
        }
    }
}
