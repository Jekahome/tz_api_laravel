<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use \App\Models\Sms;
use \App\Models\Client;
use Illuminate\Http\Response;


class LoginUserController extends Controller
{

    /**
     * Handle incoming admin request.
     *
     * @param LoginUserRequest $request
     * @return Response
     */
   public function user(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!\Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }

        $token = \Auth::user()->createToken(config('app.name'));
        $token->token->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken
        ], 200);
    }
}
