<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Http\Requests\DishRequest;
use App\Http\Resources\DishResource;

class DishController extends Controller
{
    public function index()
    {
        return DishResource::collection(Dish::all());
    }

    public function store(DishRequest $request)
    {
        $dish = Dish::create($request->validated());
        return new DishResource($dish);
    }

    public function show(Dish $dish)
    {
        return new DishResource($dish);
    }

    public function update(DishRequest $request, Dish $dish)
    {
        $dish->update($request->validated());
        return new DishResource($dish);
    }

    public function destroy(Dish $dish)
    {
        $dish->delete();
        return response()->json(null, 204);
    }
}
