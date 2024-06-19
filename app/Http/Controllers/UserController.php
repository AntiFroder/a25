<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string|max:100',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|string|min:6|max:15',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }
        User::create($validator->validated());
        return response()->json([
            'success' => true,
        ]);
    }

    public function getAmountPayment(): JsonResponse
    {
        $response = User::with(['hourWorks' => fn($query) => $query->notPaid()])
            ->get()
            ->sortBy('id');
        $amountPayment = $response->map(fn($item) => [$item->id => $item->hourWorks->sum('amount')]);
        return response()->json($amountPayment);
    }
}
