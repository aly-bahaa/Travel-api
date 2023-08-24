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
  /**
     * Display a listing of public travels
     *   
     * Gets all Public travels
     *
     * @queryParam page_size int  Size per page. Default is 15. Example: 10
     * @queryParam page int  Page to view. Example: 1
     * 
 */
    public function index()
    {
        $travels = Travel::where('is_public',1)->paginate();
        
        return TravelResource::collection($travels);
    }
    /**
     * Create a travel 
     *   
     * User must be authenticated and an admin in order to create a travel
     *
     * @bodyParam name string required  Name of the travel. Example: Around Spain
     * @bodyParam is_public boolean required Wether the travel is public or private. Example: 1
     * @bodyParam description string required Description of the travel. Example: This is an awesome travel!
     * @bodyParam number_of_days int required Number of days of the travel. Example: 3

 */
    public function store (TravelRequest $request){

        $newTravel['name'] = $request->name;
        $newTravel['is_public'] = $request->is_public;
        $newTravel['description'] = $request->description;
        $newTravel['number_of_days'] = $request->number_of_days;

        $newTravel1 = Travel::create($newTravel);

        return TravelResource::collection($newTravel1);
    }
     /**
     * Update a travel 
     *   
     * User must be authenticated and an editor in order to update a travel
     *
 */

    public function update(Travel $travel,TravelRequest $request){
        $travel->update($request->validated());

        return response()->json($travel);
    }
   
}
