<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Master\Country;
use App\Http\Controllers\Controller;
class CountryController extends Controller
{
    /**
     * Handel for ajax request country
     * @return \Illuminate\Http\Response
     */
    public function ajaxRequest()
    {
      $countries = $this->toCache('countries', function() {
        return Country::get();
      });
      return response()->json(['countries' => $countries]);
    }
}
