<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (PostTooLargeException $e, $request) {
            $message = 'The uploaded file is too large. Compress images to under 4 MB (JPG/PNG recommended), then try again.';

            if ($request->expectsJson()) {
                return response()->json(['message' => $message], 413);
            }

            return redirect()
                ->back()
                ->withInput($request->except([
                    'cover_photo',
                    'photo',
                    'featured_image',
                    'image',
                    'image_path',
                    'logo',
                    'file',
                    'po_files',
                ]))
                ->with('status', $message)
                ->withErrors(['upload' => $message]);
        });
    }
}
