<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
    {
        $request->viewer->reserves()->attach($request->timeTable);

        DB::commit();

        return response()->json(['message' => __('app.success')], Response::HTTP_CREATED);
    }
}
