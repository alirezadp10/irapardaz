<?php

namespace App\Http\Controllers;

use App\Http\Requests\ViewerRequest;
use App\Http\Resources\ViewerCollection;
use App\Http\Resources\ViewerResource;
use App\Models\Viewer;
use Symfony\Component\HttpFoundation\Response;

class ViewerController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => __('app.success'),
            'data'    => new ViewerCollection(Viewer::paginate()),
        ], Response::HTTP_OK);
    }

    public function store(ViewerRequest $request)
    {
        $viewer = Viewer::create($request->validated());

        return response()->json([
            'message' => __('app.success'),
            'data'    => new ViewerResource($viewer),
        ], Response::HTTP_CREATED);
    }
}
