<?php

namespace App\Http\Controllers;

use App\Services\EmaiFaqService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class EmaiChatController extends Controller
{
    public function ask(Request $request, EmaiFaqService $emai): JsonResponse
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'min:2', 'max:500'],
        ]);

        try {
            $result = $emai->answer($data['message'], $request);
        } catch (Throwable $e) {
            Log::error('E-Mai chat failed', [
                'message' => $e->getMessage(),
                'exception' => $e,
            ]);

            return response()->json([
                'name' => config('emai.name', 'E-Mai'),
                'message' => (string) config('emai.fallback', 'Sorry, I could not answer that right now. Please try again or visit the Contact page.'),
                'matched_question' => null,
                'confidence' => 0.0,
                'links' => [
                    ['label' => 'Contact', 'url' => route('contact', [], false)],
                    ['label' => 'Admissions', 'url' => route('admissions.enrollment', [], false)],
                ],
            ]);
        }

        return response()->json([
            'name' => config('emai.name'),
            'message' => $result['answer'],
            'matched_question' => $result['question'],
            'confidence' => $result['confidence'],
            'links' => $result['links'],
            'source' => $result['source'] ?? null,
        ]);
    }
}
