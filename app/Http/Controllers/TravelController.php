<?php

namespace App\Http\Controllers;

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

   
}
