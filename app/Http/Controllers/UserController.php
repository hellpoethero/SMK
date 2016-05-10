<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);
    }

    public function create() {
        $user = Auth::user();
        if ($user['role_id']==1) {
            return view('user.create');
        } else {
            return redirect('/');
        }
    }

    public function store(Request $request) {
        $user = Auth::user();
        if ($user['role_id']==1) {
            $data = $request->all();
            $validator = $this->validator($data);
            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role_id' => 1
            ]);
            return redirect('user/create');
        } else {
            return redirect('/');
        }
    }
}
