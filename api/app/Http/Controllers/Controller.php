<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    //

    public function respond ($data) : JsonResponse
    {
        return response()->json($data);
    }
}
