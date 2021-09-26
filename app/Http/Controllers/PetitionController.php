<?php

namespace App\Http\Controllers;

use App\Http\Resources\PetitionCollection;
use App\Http\Resources\PetitionResource;
use App\Models\Petition;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(new PetitionCollection(Petition::all()), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $petition = Petition::create($request->only(['title', 'author', 'category', 'description', 'signees']));
        return response()->json(new PetitionResource($petition), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petition  $petition
     * @return JsonResponse
     */
    public function show(Petition $petition)
    {
        return response()->json(new PetitionResource($petition), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Petition  $petition
     * @return JsonResponse
     */
    public function update(Request $request, Petition $petition)
    {
        $petition->update($request->only([
            'title', 'description', 'author', 'category', 'signees'
        ]));

        return response()->json(new PetitionResource($petition), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petition  $petition
     * @return JsonResponse
     */
    public function destroy(Petition $petition)
    {
        $petition->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
