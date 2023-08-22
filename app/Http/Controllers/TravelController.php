<?php

namespace App\Http\Controllers;

use App\Http\Requests\TravelRequest;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TravelController extends Controller
{
    public function index()
    {
        $travels = Travel::where('is_public',1)->paginate();
        
        return TravelResource::collection($travels);
    }
    public function store (TravelRequest $request){

        $newTravel['name'] = $request->name;
        $newTravel['is_public'] = $request->is_public;
        $newTravel['description'] = $request->description;
        $newTravel['number_of_days'] = $request->number_of_days;

        $newTravel1 = Travel::create($newTravel);

        return TravelResource::collection($newTravel1);
    }
    public function update(Travel $travel,TravelRequest $request){
        $travel->update($request->validated());

        return response()->json($travel);
    }
   
}
