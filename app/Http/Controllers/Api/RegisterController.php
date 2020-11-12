<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserToken;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Show the form to create a new blog post.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $hashedPassword = Hash::make($request->input('password'));

        $findUserByEmail = User::select('id')->where('email', $email)->first();

        if ($findUserByEmail) {
            return response()->json([
                'error' => [
                    'code' => 'EmailAlreadyExists',
                    'message' => 'Email Already Being Used',
                ],
            ], 400);
        }

        $createdUser = User::create(array('name' => $name, 'email' => $email, 'password' => $hashedPassword));

        $token = hash('sha256', $createdUser->id.Str::random(32));

        UserToken::create(array('token' => $token, 'user_id' => $createdUser->id));

        return response()->json(['name' => $createdUser->name, 'email' => $createdUser->email, 'token' => $token]);
    }
}
