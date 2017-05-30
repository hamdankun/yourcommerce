<?php

namespace App\Http\Controllers\Frontend;

use SEOMeta;
use OpenGraph;
use Illuminate\Http\Request;
use App\Models\Master\Product;
use App\Models\Master\Category;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    /**
     * Get All depedencies here
     */
    public function __construct()
    {
      $this->getTreeCategory();
    }
    /**
     * Show Product base on category
     * @param  integer $categoryLvl1
     * @param  integer $categoryLvl2
     * @param  integer $categoryLvl3
     * @return \Illuminate\Http\Response
     */
    public function index($categoryLvl1 = 0, $categoryLvl2 = 0, $categoryLvl3 = 0)
    {
      $data['box_title'] = ucwords(str_replace('-', '', $categoryLvl1));
      $this->defaultMeta();
      $this->defineBreadcrumbsAndCategory($categoryLvl1, $categoryLvl2, $categoryLvl3);
      return view('frontend.product.index', $data);
    }

    public function show($argument1 = '', $argument2 = '', $argument3 = '', $argument4 = '')
    {
      $slugs = collect([$argument1, $argument2, $argument3, $argument4]);
      $slugs = $slugs->reject(function($slug) {
        return $slug === '';
      });
      $slug = $slugs->last();
      $product = Product::select('*')
                        ->isNew()
                        ->findBySlug($slug)
                        ->onDisplay()
                        ->valid()->with('category')->first();

      if (!$product) return view('layouts.404');

      $this->setMetaProduct($product);
      $this->defineBreadcrumbsAndCategory($argument1, $argument2, $argument3);
      return view('frontend.product.show', ['product' => $product]);
    }

    /**
     * Define variable for depedencies template
     * @return void
     */
    public function defineBreadcrumbsAndCategory($categoryLvl1, $categoryLvl2, $categoryLvl3)
    {
      view()->share('breadcrumbs', [ $categoryLvl1, $categoryLvl2, $categoryLvl3 ]);
      view()->share('category', $categoryLvl3);
    }

    /**
     * Handle for get resource base on type
     * @param string $type
     * @return \Illuminate\Http\Response
     */
    public function ajaxRequest($type)
    {

      if ($type == 'hot') {
        $products = Product::hotProduct()->addSelect('category_id')->createdAtDesc()->limit(16)->get();
      } else if (request()->route()->getName() == 'product.category'){
        $category = Category::findBySlug($type)->first();
        $perpage = request()->get('per_page') ? valid_number(request()->get('per_page')) : 16;
        if ($category) {
          $products = $category->products()->visibleColumn()->valid();
        } else {
          $products = Product::visibleColumn()->valid();

        }

        if (request()->has('sorting_by')) {
          $sorting = $this->defineSorting(request()->get('sorting_by'));
          $products = $products->orderBy($sorting['column'], $sorting['dir']);
        } else {
          $products = $products->createdAtDesc();
        }

        $products = $products->paginate($perpage);
      } else {
        $products = Product::visibleColumn()->orderByRaw('RAND()');
      }
      $products = $this->toCache(request()->fullUrl(), function() use($products) {
        if (!$products instanceof \Illuminate\Pagination\LengthAwarePaginator) {
          foreach ($products as $key => $value) {
            $category = [];
            $category[] = $value->category->slug;
            $parent = $value->category->parent;
            while ($parent) {
              $category[] = $parent->slug;
              $parent = $parent->parent;
            }
            $products[$key]->categories = array_reverse($category);
          }
        }
        return $products;
      });

      return response()->json(['data' => $products]);
    }

    /**
     * Define sorting
     * @param  string $sorting
     * @return array
     */
    public function defineSorting($sorting)
    {
      $data = [];

      if ($sorting == 'new') {
        $data['column'] = 'created_at';
        $data['dir'] = 'asc';
      } else if ($sorting == 'old') {
        $data['column'] = 'created_at';
        $data['dir'] = 'desc';
      } else if ($sorting == 'cheapest') {
        $data['column'] = 'price';
        $data['dir'] = 'asc';
      } else if ($sorting == 'expensive') {
        $data['column'] = 'price';
        $data['dir'] = 'desc';
      } else {
        $data['column'] = 'name';
        $data['dir'] = $sorting == 'a_z' ? 'asc' : 'desc';
      }

      return $data;
    }
}
