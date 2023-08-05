<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourListRequest;
use App\Http\Resources\TourResource;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
{
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
}
