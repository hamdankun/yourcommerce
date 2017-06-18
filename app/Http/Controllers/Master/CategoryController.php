<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
    * Handel for ajax request country
    * @return \Illuminate\Http\Response
    */
    public function ajaxRequest()
    {
      return response()->json(['categories' => $this->getTreeCategory(false)]);
    }
}
