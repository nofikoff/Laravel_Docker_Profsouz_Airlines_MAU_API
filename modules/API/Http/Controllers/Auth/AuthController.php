<?php

namespace Modules\API\Http\Controllers\Auth;

use Illuminate\Http\Request;
use LaraComponents\Centrifuge\Centrifuge;
use Laravel\Passport\Client;
use Laravel\Passport\Token;
use Modules\API\Http\Controllers\APIController;
use Modules\API\Http\Requests\LoginRequest;
use Modules\API\Http\Requests\RegisterRequest;
use Modules\Users\Entities\User;
use Lcobucci\JWT\Parser as JwtParser;

class AuthController extends APIController
{

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $this->_createUser($request->all());

        $client = Client::where('password_client', 1)->first();

        \Request::merge([
            'grant_type'    => "password",
            'client_id'     => $client->id,
            'client_secret' => $client->secret,
            'username'      => $request->get('phone'),
            'password'      => $request->get('password'),
        ]);

        $token = Request::create(
            route('api.login'),
            'POST'
        );

        return \Route::dispatch($token);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    private function _createUser(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'phone'      => $data['phone'],
            'password'   => $data['password'],
            'locale'     => env('SETTINGS_DEFAULT_LANG', 'ru'),
        ]);
    }

    /**
     * @param Centrifuge $centrifuge
     * @param JwtParser $jwt
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Centrifuge $centrifuge, JwtParser $jwt, LoginRequest $request)
    {
        $get_auth_data = Request::create(
            'oauth/token',
            'POST'
        );

        $req = \Route::dispatch($get_auth_data);

        if ($req->getStatusCode() !== 200) {
            return $req;
        }

        $authorize_data = json_decode($req->getContent());

        $jti = $jwt->parse($authorize_data->access_token)->getHeader('jti');

        $token = Token::where('id', $jti)->first();

        $timestamp = time();
        $user      = $token->user_id;
        $token     = $centrifuge->generateToken($user, $timestamp);

        return response()
            ->json(array_merge((array)$authorize_data, compact('user', 'token', 'timestamp')));
    }

    /**
     * @param Centrifuge $centrifuge
     * @return \Illuminate\Http\JsonResponse
     */
    public function centrifuge(Centrifuge $centrifuge)
    {
        $timestamp = (string)time();
        $user      = (string)\Auth::id();
        $token     = $centrifuge->generateToken($user, $timestamp);

        return response()->json(compact('user', 'token', 'timestamp'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAuth()
    {
        return response()->json(['auth' => \Auth::guard('api')->check()]);
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setLocale($locale)
    {
        if (in_array($locale, explode(',', env('SETTINGS_LOCALES')))) {
            if ($user = \Auth::user()) {
                $user->locale = $locale;
                $user->save();
            }

            \Session::put('locale', $locale);
        } else {
            abort(404, 'Locale not found.');
        }

        return response()->json(['success' => 'success']);
    }
}
