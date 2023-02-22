<?php

namespace Tanthammar\LaravelWindowSize;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LaravelWindowSizeController
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $w = (int)$request->input('width');
        $h = (int)$request->input('height');

        if ($w > 0) {
            session(['windowW' => $w]);
        }
        if ($h > 0) {
            session(['windowH' => $h]);
        }

        return response()->json();
    }
}
