<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:house,apartment',
            'address' => 'required',
            'size' => 'required|integer',
            'bedrooms' => 'required|integer',
            'price' => 'required|integer',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

       

        $realEstateEntry = new RealEstateProperty();
        $realEstateEntry->type = $validatedData['type'];
        $realEstateEntry->address = $validatedData['address'];
        $realEstateEntry->size = $validatedData['size'];
        $realEstateEntry->bedrooms = $validatedData['bedrooms'];
        $realEstateEntry->price = $validatedData['price'];
        $realEstateEntry->latitude = $validatedData['latitude'];
        $realEstateEntry->longitude = $validatedData['longitude'];
        $realEstateEntry->save();

        return response()->json($realEstateEntry, 201);
    }

    public function search(Request $request){
        $query = RealEstateProperty::query();

        if ($request->has('address')) {
            $query->where('address', 'LIKE', "%{$request->address}%");
        }

        if ($request->has('size')) {
            $query->where('size', '>=', $request->size);
        }
    
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

        return response()->json($realEstateEntries);
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
