<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowRequest;
use App\Http\Resources\ShowCollection;
use App\Http\Resources\ShowResource;
use App\Models\Show;
use App\Models\TimeTable;
use Symfony\Component\HttpFoundation\Response;

class ShowController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => __('app.success'),
            'data'    => new ShowCollection(Show::paginate(5)),
        ], Response::HTTP_OK);
    }

    public function store(ShowRequest $request)
    {
        $show = Show::create($request->validated());

        $times = [];

        foreach ($request->times as $time) {
            $times[] = new TimeTable($time);
        }

        $show->times()->saveMany($times);

        return response()->json([
            'message' => __('app.success'),
            'data'    => new ShowResource($show),
        ], Response::HTTP_CREATED);
    }
}
