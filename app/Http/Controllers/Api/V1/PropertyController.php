<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\Properties\PropertiesBathroomsFilter;
use App\Filters\Properties\PropertiesBedroomsFilter;
use App\Filters\Properties\PropertiesGaragesFilter;
use App\Filters\Properties\PropertiesNameFilter;
use App\Filters\Properties\PropertiesPriceFilter;
use App\Filters\Properties\PropertiesStoreysFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Resources\V1\PropertyResource;
use App\Models\Property;
use Illuminate\Pipeline\Pipeline;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::query();
        $response =
            app(Pipeline::class)
            ->send($properties)
            ->through([
                PropertiesBathroomsFilter::class,
                PropertiesBedroomsFilter::class,
                PropertiesGaragesFilter::class,
                PropertiesNameFilter::class,
                PropertiesPriceFilter::class,
                PropertiesStoreysFilter::class,
            ])
            ->via('apply')
            ->then(function ($properties) {
                return $properties->orderBy('id', 'DESC')->paginate(5);
            });

        return PropertyResource::collection($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        return response()->json(['error' => 'Not authorized.'],403);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return new PropertyResource($property);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        return response()->json(['error' => 'Not authorized.'],403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        return response()->json(['error' => 'Not authorized.'],403);
    }
}
