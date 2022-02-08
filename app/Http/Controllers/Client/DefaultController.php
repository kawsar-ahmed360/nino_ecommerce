<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Citie;
use App\Models\Client\State;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function CountryToState(Request $request){

        $state = State::where('country_id',$request->countryId)->get();
        return response()->json($state);
    }

    public function CountryToCity(Request $request){
        $city = Citie::where('state_id',$request->stateId)->get();
        return response()->json($city);
    }
}
