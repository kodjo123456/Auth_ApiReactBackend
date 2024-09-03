<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Interfaces\AuthInterface;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Auth;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    private AuthInterface $authInterface;

    public function __construct(AuthInterface $authInterface)
    {
        $this->authInterface = $authInterface;
    }

    public function register(RegisterRequest $registerRequest)
    {
        $data = [
            'name' => $registerRequest->name,
            'email' => $registerRequest->email,
            'password' => $registerRequest->password,
        ];

        DB::beginTransaction();

        try {
            $user = $this->authInterface->register($data);

            DB::commit();

            return ApiResponse::sendResponse(true, [new UserResource($user)], 'Opération effectuée.', 201);
        
        } catch (\Throwable $th) {
            return ApiResponse::rollback($th);
        }
    }
    public function login(LoginRequest $loginRequest)
    {
        $data = [
            'email' => $loginRequest->email,
            'password' => $loginRequest->password,
        ];

        DB::beginTransaction();

        try {
            $user = $this->authInterface->login($data);

            DB::commit();

            if (!$user){
                return ApiResponse::sendResponse(
                    false,
                    [],
                    'identifiant invalide.',
                    200
                );
            }

            return ApiResponse::sendResponse(
                true,
                [],
                'connexion effectuée.',
                200 
            );
        } catch (\Throwable $th) {
            return ApiResponse::rollback($th);
        }
    }

    public function checkOtpCode(Request $request)
    {
        $data = [
            'email' => $request->email,
            'code' => $request->code,
        ];

        DB::beginTransaction();
        try {
            $user = $this->authInterface->checkOtpCode($data);

            DB::commit();

            if (!$user) {

                return ApiResponse::sendResponse(
                    false,
                    [],
                    'Code de Confirmation Invalide.',
                    200
                );
            }


            return ApiResponse::sendResponse(
                true,
                [new UserResource($user)],
                'Opérations effectué.',
                200
            );
        } catch (\Throwable $th) {

            // return $th;
            return ApiResponse::rollback($th);
        }
    }

    public function logout()
    {
        $user = User::find(auth()->user()->getAuthIdentifier());
        $user->tokens()->delete();

        return ApiResponse::sendResponse(
            true,
            [],
            'Utilisateur déconnecter.',
            200
        );
    }
}
