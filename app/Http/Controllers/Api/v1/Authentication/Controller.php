<?php

namespace App\Http\Controllers\Api\v1\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use App\Constants\ResponseCode;
use App\Constants\ResponseMessage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller as MasterController;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class Controller extends MasterController
{

    public function manualSignup(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'unique:users|required|email',
                'name' => 'required|alpha',
                'password' => 'required|confirmed|min:6',
            ]);
            if ($validator->fails()) {
                return validationErrorHandler($validator->errors());
            }

            $user = User::createUser($request->all());
            $token = $user->createToken($user->email)->plainTextToken;
            $user['token'] = $token;

            return successHandler(
                new UserResource($user),
                ResponseCode::ACCEPTED_CODE,
                ResponseMessage::LOGGED_IN_SUCCESS_MESSAGE
            );
        } catch (\Exception $e) {
            return serverErrorHandler($e);
        }
    }


    public function manualSignIn(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return validationErrorHandler($validator->errors());
            }

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return errorHandler(
                    ResponseCode::UNAUTHORISED_CODE,
                    ResponseMessage::INVALID_CREDENTIALS_MESSAGE
                );
            }

            if (!Hash::check($request->password, $user->password)) {
                return errorHandler(
                    ResponseCode::UNAUTHORISED_CODE,
                    ResponseMessage::INVALID_CREDENTIALS_MESSAGE
                );
            }

            // Delete existing tokens
            $user->tokens()->delete();

            $token = $user->createToken($user->id)->plainTextToken;
            $user['token'] = $token;

            return successHandler(
                new UserResource($user),
                ResponseCode::OK_CODE,
                ResponseMessage::LOGGED_IN_SUCCESS_MESSAGE
            );
        } catch (\Exception $e) {
            return serverErrorHandler($e);
        }
    }

    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return successHandler(
                null,
                ResponseCode::ACCEPTED_CODE,
                ResponseMessage::LOGGED_OUT_SUCCESS_MESSAGE
            );
        } catch (\Throwable $e) {
            return serverErrorHandler($e);
        }
    }
}
