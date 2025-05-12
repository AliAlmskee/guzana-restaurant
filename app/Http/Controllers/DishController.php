<?php

namespace App\Http\Controllers;

use App\Http\Requests\DishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Http\Resources\DishResource;
use App\Models\Dish;
use App\Services\PhotoService;
use Illuminate\Http\Request;

class DishController extends Controller
{
    protected PhotoService $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function index(Request $request)
    {
        $query = Dish::query();
        
        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }
        
        return DishResource::collection(
            $query->orderByRaw('CASE WHEN photo IS NULL OR photo = "" THEN 1 ELSE 0 END')
                  ->get()
        );
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
