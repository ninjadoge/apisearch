<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Resources\RealEstatePropertyCollection;
use App\Http\Resources\RealEstatePropertyResource;
use App\Models\RealEstateProperty;
use Illuminate\Http\Request;

class RealEstateEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {   
        $validatedData = $request->all();
        
        $realEstateEntry = new RealEstateProperty();
        $realEstateEntry->type = $validatedData['type'];
        $realEstateEntry->address = $validatedData['address'];
        $realEstateEntry->size = $validatedData['size'];
        $realEstateEntry->bedrooms = $validatedData['bedrooms'];
        $realEstateEntry->price = $validatedData['price'];
        $realEstateEntry->latitude = $validatedData['latitude'];
        $realEstateEntry->longitude = $validatedData['longitude'];
        $realEstateEntry->save();

        return new RealEstatePropertyResource($realEstateEntry);
        // return response()->json($realEstateEntry, 201);  
    }

    public function search(Request $request){

        $query = RealEstateProperty::query();

        if ($request->has('address')) {
            $query->where('address', 'LIKE', "%{$request->address}%");
        }

        if ($request->has('min_size')) {
            $query->where('size', '>=', $request->min_size);
        }

        if ($request->has('max_size')) {
            $query->where('size', '<=', $request->max_size);
        }
    
        // if ($request->has('size')) {
        //     $query->where('size', '>=', $request->size);
        // }
    
        if ($request->has('bedrooms')) {
            $query->where('bedrooms', '=', $request->bedrooms);
        }
    
        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
    
        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        
        if ($request->has('latitude') && $request->has('longitude') && $request->has('radius')) {
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $radius = $request->radius;
            
            $haversine = "(6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude))))";
            $query->selectRaw("*, $haversine AS distance")->orderBy('distance')->whereRaw("$haversine < ?", [$radius]);
        }
        
        $realEstateEntries = $query->get();

        return new RealEstatePropertyCollection($realEstateEntries);

        // return response()->json($realEstateEntries);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
