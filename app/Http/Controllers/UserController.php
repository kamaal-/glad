<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Firebase\JWT\JWT;
use App\User;

use App\Http\Requests;

class UserController extends Controller
{
    /**
     * Generate JSON Web Token.
     */
    protected function createToken($user)
    {
        $payload = [
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + (2 * 7 * 24 * 60 * 60)
        ];
        return JWT::encode($payload, Config::get('app.token_secret'));
    }

    /**
     * Get signed in user's profile.
     */
    public function getUser(Request $request)
    {
        $user = User::find($request['user']['sub']);
        return $user;
    }

    /**
     * Update signed in user's profile.
     */
    public function updateUser(Request $request)
    {
        $user = User::find($request['user']['sub']);
        $user->displayName = $request->input('displayName');
        $user->email = $request->input('email');
        $user->country = $request->input('country');
        $user->nationality = $request->input('nationality');
        $user->mobile = $request->input('mobile');
        $user->save();
        $token = $this->createToken($user);
        return response()->json(['token' => $token]);
    }

}
