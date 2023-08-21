<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CookieController extends Controller
{
    public function buyCookie(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'number_of_cookies' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $number_of_cookies = $request->input('number_of_cookies', 1);

        if ($user->wallet < $number_of_cookies) {
            return response()->json(['error' => 'Insufficient funds'], 422);
        }

        $user->wallet -= $number_of_cookies;

        $cookie = Cookie::where('user_id', $user->id)->first();

        if ($cookie) {
            $cookie->number_of_cookies += $number_of_cookies;
            $cookie->save();
        } else {
            $cookie = new Cookie([
                'user_id' => $user->id,
                'number_of_cookies' => $number_of_cookies,
            ]);
            $cookie->save();
        }

        $user->save();

        return response()->json(['message' => 'Cookies bought successfully']);
    }

    public function getUserCookies()
    {
        $user = Auth::user();

        $cookies = $user->cookies;
        if (!$cookies) {
            return response()->json(['message' => 'No cookies available for the user']);
        }

        return response()->json(['cookies' => $cookies->number_of_cookies]);
    }
}
