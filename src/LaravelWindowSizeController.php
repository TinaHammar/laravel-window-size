<?php

namespace Tanthammar\LaravelWindowSize;

use Illuminate\Http\Request;

class LaravelWindowSizeController
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $w = (int)$request->input('width');
        $h = (int)$request->input('height');

        if (is_int($w) && $w > 0) session(['windowW' => $w]);
        if (is_int($h) && $h > 0) session(['windowH' => $h]);

        return response()->json();
    }
}
