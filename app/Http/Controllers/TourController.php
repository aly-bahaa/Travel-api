<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourListRequest;
use App\Http\Requests\TourRequest;
use App\Http\Resources\TourResource;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
{
     /**
     * Display a listing of the tours of a travel.
     *   
     * Gets the tours of a specific travel by the slug of the travel.
     * The user can also filter based on the price and date.
     * 
     * @urlParam travel_slug string The slug of the travel. Example: around-spain
     *
 */
    public function index(Travel $travel,TourListRequest $request)
    {   
       $tours = $travel->tours()
       ->when($request->priceFrom,function ($query) use ($request){
        $query->where('price','>=',$request->priceFrom * 100);
       })
       ->when($request->priceTo,function ($query) use ($request){
        $query->where('price','<=',$request->priceTo * 100);
       })
       ->when($request->dateFrom,function ($query) use ($request){
        $query->where('starting_date','>=',$request->dateFrom);
       })
       ->when($request->dateTo,function ($query) use ($request){
        $query->where('starting_date','<=',$request->dateTo);
       })
       ->when($request->sort && $request->sortBy,function ($query) use ($request){
        $query->orderBy($request->sort,$request->sortBy);
       })
       ->orderBy('starting_date')->paginate();
        
    
       
       return TourResource::collection($tours);
    }
/**
     * Create a tour 
     *   
     * User must be authenticated and an admin in order to create a tour
     *
     * @bodyParam name string required  Name of the tour. Example: Madrid
 */
    public function store(Travel $travel,TourRequest $request){
        $tour = $travel->tours()->create($request->validated());
        return response()->json($tour);
    }
}
