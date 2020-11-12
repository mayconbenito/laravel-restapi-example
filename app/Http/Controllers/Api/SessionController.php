<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserToken;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SessionController extends Controller
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
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $findUserByEmail = User::where('email', $email)->first();

        if (!$findUserByEmail) {
            return response()->json([
                'error' => [
                    'code' => 'InvalidCredentials',
                    'message' => 'Email or password is invalid',
                ],
            ]);
        }

        if (!Hash::check($password, $findUserByEmail->password)) {
            return response()->json([
                'error' => [
                    'code' => 'InvalidCredentials',
                    'message' => 'Email or password is invalid',
                ],
            ], 401);
        }

        $token = hash('sha256', $findUserByEmail->id.Str::random(32));

        UserToken::create(array('token' => $token, 'user_id' => $findUserByEmail->id));

        return response()->json(['name' => $findUserByEmail->name, 'email' => $findUserByEmail->email, 'token' => $token]);
    }
}
