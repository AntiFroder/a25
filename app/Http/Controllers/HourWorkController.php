<?php

namespace App\Http\Controllers;

use App\Models\HourWork;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HourWorkController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'bail|required|exists:users,id',
            'hour' => 'bail|required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }
        HourWork::create($validator->validated());
        return response()->json([
            'success' => true,
        ]);
    }

    public function paymentAccumulatedAmount(): JsonResponse
    {
        HourWork::query()->notPaid()->update([
            'paid' => true
        ]);
        return response()->json([
            'success' => true,
        ]);
    }
}
