<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginClientRequest;
use Illuminate\Http\Request;
use \App\Models\Sms;
use \App\Models\Client;
use Illuminate\Http\Response;
use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;

class LoginClientController extends Controller
{
    /**
     * Handle incoming client request.
     *
     * @param LoginClientRequest $request
     * @return Response
     * @throws \Exception
     */
    public function client(LoginClientRequest $request)
    {
        $phone = $request->only('phone');
        $phone = $phone['phone'];

        $client = Client::where('phone', $phone)->first();

        if(!is_null($client)){
            $code = mt_rand(100, 100000);
            $sms = new Sms();
            $sms->code = $code;
            $sms->save();

            $client->note = $code;
            $client->save();

            $SPApiClient = new ApiClient(env('API_USER_ID'), env('API_SECRET'), new FileStorage());

            $data = [
                "$phone" => [
                    [
                        [
                            'name' => 'code',
                            'type' => 'integer',
                            'value' =>  "$code",
                        ]
                    ]
                ]
            ];

            $SPApiClient->addPhonesWithVariables(env('SP_BOOK_ID'),$data);

            return response()->json([
                'Code sent',
            ], 200);
        }
        return response()->json([
            'error' => 'Resource not found'
        ], 404);
    }

    /**
     * Processing an incoming client request.
     * Checking the code.
     *
     * @param Request $request
     * @return Response
     */
    public function verification_code(Request $request)
    {
        $code = $request->only('code');
        $client = Client::where('note', $code)->first();
        $client->note='';
        $client->save();
        Sms::where('code', $code)->delete();

        auth('client')->login($client);

        $token = \Auth::guard('client')->user()->createToken(config('app.name'));
        $token->token->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
        ], 200);
    }

}
