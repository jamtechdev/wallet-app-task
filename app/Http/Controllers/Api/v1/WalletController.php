<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{

    public function addFunds(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:3|max:100|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $amount = $request->input('amount');
        $user->wallet += $amount;
        $user->save();

        return response()->json(['message' => 'Funds added successfully']);
    }
}
