<?php

namespace App\Http\Controllers;

use Hash;
use Config;
use Validator;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

use App\User;
use Socialite;
use App\Http\Requests;

class AuthController extends Controller
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
     * Unlink provider.
     */
    public function unlink(Request $request, $provider)
    {
        $user = User::find($request['user']['sub']);
        if (!$user)
        {
            return response()->json(['message' => 'User not found']);
        }
        $user->$provider = '';
        $user->save();

        return response()->json(array('token' => $this->createToken($user)));
    }

    /**
     * Log in with Email and Password.
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', '=', $email)->first();
        if (!$user)
        {
            return response()->json(['message' => 'Wrong email and/or password'], 401);
        }
        if (Hash::check($password, $user->password))
        {
            unset($user->password);
            return response()->json(['token' => $this->createToken($user)]);
        }
        else
        {
            return response()->json(['message' => 'Wrong email and/or password'], 401);
        }
    }

    /**
     * Create Email and Password Account.
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'displayName' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()], 400);
        }
        $user = new User;
        $user->displayName = $request->input('displayName');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return response()->json(['token' => $this->createToken($user)]);
    }

    /**
     * Login with Facebook.
     */
    public function facebook(Request $request)
    {
        if ($request->has('redirectUri')) {
            config()->set("services.facebook.redirect", $request->get('redirectUri'));
        }

        $provider = Socialite::driver('facebook');

        $provider->stateless();

        // Step 1 + 2
        $profile = $provider->user();
        //dd($profile);
        // Step 3a. If user is already signed in then link accounts.
        if ($request->header('Authorization'))
        {
            $user = User::where('facebook', '=', $profile['id']);
            if ($user->first())
            {
                return response()->json(['message' => 'There is already a Facebook account that belongs to you'], 409);
            }
            $token = explode(' ', $request->header('Authorization'))[1];
            $payload = (array) JWT::decode($token, Config::get('app.token_secret'), array('HS256'));
            $user = User::find($payload['sub']);
            $user->facebook = $profile['id'];
            $user->email = $user->email ?: $profile['email'];

            $user->displayName = $user->displayName ?: $profile['name'];
            $user->save();
            return response()->json(['token' => $this->createToken($user)]);
        }
        // Step 3b. Create a new user account or return an existing one.
        else
        {
            $user = User::where('facebook', '=', $profile['id']);
            if ($user->first())
            {
                return response()->json(['token' => $this->createToken($user->first())]);
            }

            $user = new User;
            $user->facebook = $profile['id'];
            $user->email = $profile['email'];
            $user->displayName = $profile['name'];
            $user->save();
            return response()->json(['token' => $this->createToken($user)]);
        }
    }
}
