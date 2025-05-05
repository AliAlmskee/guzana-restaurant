<?php

namespace App\Http\Controllers;

use App\Http\Requests\DishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Http\Resources\DishResource;
use App\Models\Dish;
use App\Services\PhotoService;

class DishController extends Controller
{
    protected PhotoService $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function index()
    {
        return DishResource::collection(Dish::all());
    }

    public function store(DishRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $uploadResult = $this->photoService->upload($request->file('photo'));
            $data['photo'] = $uploadResult['url'];
        }

        $dish = Dish::create($data);

        return new DishResource($dish);
    }

    public function show(Dish $dish)
    {
        return new DishResource($dish);
    }

    public function update(UpdateDishRequest $request, Dish $dish)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($dish->photo) {
                $oldFilename = basename($dish->photo); 
                $this->photoService->delete($oldFilename);
            }

            $uploadResult = $this->photoService->upload($request->file('photo'));
            $data['photo'] = $uploadResult['url'];
        }

        $dish->update($data);

        return new DishResource($dish);
    }

    public function destroy(Dish $dish)
    {
        if ($dish->photo) {
            $this->photoService->delete(basename($dish->photo));
        }

        $dish->delete();

        return response()->json(null, 204);
    }
}
