<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Master\Product;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Get All depedencies here
     */
    public function __construct()
    {
      $this->getTreeCategory();
    }
    /**
     * Show Home Index
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $this->defaultMeta();
      return view('frontend.home');
    }
}
