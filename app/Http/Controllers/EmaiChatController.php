<?php

namespace App\Http\Controllers;

use App\Services\EmaiFaqService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmaiChatController extends Controller
{
    public function ask(Request $request, EmaiFaqService $emai): JsonResponse
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'min:2', 'max:500'],
        ]);

        $result = $emai->answer($data['message'], $request);

        return response()->json([
            'name' => config('emai.name'),
            'message' => $result['answer'],
            'matched_question' => $result['question'],
            'confidence' => $result['confidence'],
            'links' => $result['links'],
        ]);
    }
}
