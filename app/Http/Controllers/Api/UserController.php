<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\Register;
use Validator;
//use App\Helper\CommonHelper;
use App\Repository\Api\RepositoryInterface\UserRepositoryInterface;
use App\Models\User;

//use App\Models\Api\UserRole;
//use App\Models\Api\UserRolePermission;
use Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        private UserRepositoryInterface $repository
    ) {
    }

    public function index()
    {
        //
    }

    /**
     * register a newly created resource in storage.
     */
    public function register(Register $request)
    {
        $user = $this->repository->registerUser($request);
        $resArr = [
            'status' => true,
            'message' => 'User created successfully.',
            'data' => $user
        ];
        return response($resArr, Response::HTTP_CREATED);
    }

    public function loginWithEmail(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if ($validation->fails()) {
            return response(['error' => $validation->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $resArr = [
            'status' => false,
            'message' => 'Invalid credential'
        ];
        $user=User::where('email',$request->email)->first();
        if($user==null){
            return response($resArr, Response::HTTP_UNAUTHORIZED); 
        }
        if (Hash::check($request->password, $user->password)) {
            $user = $this->repository->getUserAfterLoggedIn($user);
            /*if ($request->cookie('jwt')) {
                 \Cookie()->forget('jwt');
             }
             $expiry = now()->addDays(7);
             */
            //dd(env('PASSPORT_TOKEN_NAME'));
            $tokenName = env('PASSPORT_TOKEN_NAME', 'Token Name');
            //dd($tokenName);
            $token = $user->createToken($tokenName)->accessToken;
            $cookie = cookie('token', $token, 5); // 1 week
            $resArr = [
                'status' => true,
                'message' => 'Success',
                'token' => $token,
                "token_type" => "Bearer",
            ];
            //return response($resArr, Response::HTTP_OK);
            return response($resArr, Response::HTTP_OK)->withCookie($cookie);
        } else {
            return response($resArr, Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Display the specified resource.
     */
    function UserProfile(Request $request)
    {
        $user = \Auth::guard('api')->user();
        $user = $this->repository->getUserAfterLoggedIn($user);
        $resArr = [
            'status' => true,
            'message' => 'Success',
            'data' => $user
        ];
        return response($resArr, Response::HTTP_OK);
    }

    public function logOut(Request $request)
    {
        if (\Auth::guard('api')->user()) {
            $request->user()->token()->revoke();
            $cookie = cookie('token', '', time()-3600);
            //$cookie=\Cookie()->forget('token');
            //$cookie=\Cookie()->forget('jwt');
            $resArr = [
                'status' => true,
                'message' => 'Success',
                'data' => $request->user
            ];
            return response($resArr, Response::HTTP_OK)->withCookie($cookie);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
