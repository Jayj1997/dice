<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client as OClient;
use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    const LEVEL_NEW = 1;
    const LEVEL_ROOKIE = 2;
    const LEVEL_OWNER = 10;

    public $successStatus = 200;
    public $unauthorised = 401;
    public $error = 500;

    public function register(Request $request) {
        // todo 验证邮箱
        $name = $request->has('name');
        $password = $request->has('password');
        if ($name && $password) {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            try {
                User::create(array_merge($input));
                return response()->json(['msg' => 'success'], $this->successStatus);
            } catch (Exception $e) {
                return response()->json(['error' => 'duplicated email'], $this->error);
            }
//            $oClient = OClient::where('password_client', 1)->first();
//            return $this->getTokenAndRefreshToken($oClient, $user->email, $password);
        } else {
            return response()->json(['error' => 'no name or password'], $this->unauthorised);
        }

    }

    public function login() {
        if (Auth::attempt([
            'email' => request('email'),
            'password' => request('password')])) {
            $oClient = OClient::where('password_client', 1)->first();
            return $this->getTokenAndRefreshToken($oClient, request('email'),
            request('password'));
        } else {
            return response()->json(['error' => 'wrong email or password'], $this->error);
        }
    }

    public function details() {
        $user = Auth::user();
        return response()->json($user, $this->successStatus);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function unauthorized() {
        return response()->json('unauthorized', $this->unauthorised);
    }

    public function refreshToken(Request $request) {
        $refresh_token = $request->header('Refreshtoken');
        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client;
        try {
            $response = $http->request('POST', env('LOCAL_URL').'oauth/token', [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refresh_token,
                    'client_id' => $oClient->id,
                    'client_secret' => $oClient->secret,
                    'scope' => '*'
                ]
            ]);
            return json_decode((string) $response->getBody(), true);
        } catch (Exception $e) {
            return response()->json('unauthorized', $this->unauthorised);
        }
    }

    public function getTokenAndRefreshToken(OClient $oClient, $email, $password) {
        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client;
        $response = $http->request('POST', env('LOCAL_URL').'oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ],
        ]);
        $result = json_decode((string) $response->getBody(), true);
        return response()->json($result, $this->successStatus);
    }
}
