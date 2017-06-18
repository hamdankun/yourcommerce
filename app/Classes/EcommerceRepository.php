<?php
namespace App\Classes;

use App\Models\Master\Category;
use App\Models\Master\Brand;

/**
 * Ecommerce Repository
 */
trait EcommerceRepository
{
  /**
   * Fetch current category
   *
   */
  public function fetchCategory($main = true, $parentId = 0)
  {
    if ($main) {
      return $this->mainCategory();
    } else if ($parentId) {
      return $this->categoryByParent($parentId);
    }

    return $this->allCategory();
  }

  /**
   * Get main category
   * @return \App\Models\Master\Category
   */
  public function mainCategory()
  {
    return Category::main()->get();
  }

  /**
   * Get all category
   * @return \App\Models\Master\Category
   */
  public function allCategory()
  {
    return Category::get();
  }

  /**
   * Get category by parent
   * @param integer $parentId
   * @return \App\Models\Master\Category
   */
  public function categoryByParent($parentId)
  {
    return Category::where('parent_id', $parentId)->get();
  }

  /**
   * Get random by random
   * @return \App\Models\Master\Category
   */
  public function randomCategory($main = true)
  {
    return Category::main()->orderByRaw('RAND()');
  }

  public function fetchBrand($slug = '')
  {
    if (!$slug) {
      return Brand::orderBy('id', 'desc');
    }

    return Brand::whereSlug($slug);
  }

}
