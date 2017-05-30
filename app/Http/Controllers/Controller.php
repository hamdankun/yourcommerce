<?php

namespace App\Http\Controllers;

use SEOMeta;
use Twitter;
use OpenGraph;
use App\Classes\EcommerceRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, EcommerceRepository;

    /**
     * Get main category
     * @return void
     */
    public function getTreeCategory()
    {
      $treeCategory = $this->toCache('main_categoris', function() {
        $mainCategories = $this->mainCategory();
        $treeCategory = [];
        foreach ($mainCategories as $keyLevelOne => $levelOne) {
            $treeCategory[$keyLevelOne] = $levelOne;
          foreach ($levelOne->child as $keyLevelTwo => $levelTwo) {
            $treeCategory[$keyLevelOne]->child = $levelOne->child;
            foreach ($levelTwo->child as $levelThree => $levelThree) {
              $treeCategory[$keyLevelOne]->child->child = $levelThree;
            }
          }
        }
        return $treeCategory;
      });
      view()->share('main_categories', $treeCategory);
    }

    public function randomUrlCategory()
    {
      $pathCategory = $this->toCache('random-category', function() {
        $category = $this->randomCategory()->select('id', 'slug')->first();
        $path = ['all'];
        while ($category) {
          $path[] = $category->slug;
          $category = $category->randomChild()->first();
        }

        return $path;
      });

      return url(implode('/',$pathCategory));
    }

    /**
     * Set data to cache
     * @param  array $data
     * @param  integer $durations
     * @return void
     */
    public function toCache($key, \Closure $callback, $duration = 5)
    {
      return cache()->remember($key, $duration, $callback);
    }

    /**
     * Set default meta website
     * @return vouid
     */
    public function defaultMeta()
    {
      SEOMeta::setTitle('Home');
      SEOMeta::setDescription('YourCommerce the new website eccomerce for your solutions bussines');
      SEOMeta::setCanonical(request()->url());
      SEOMeta::addMeta('og:description', 'YourCommerce the new website eccomerce for your solutions bussines', 'property');
      SEOMeta::addMeta('fb:admins', 'hamdan.hanafi.98', 'property');
      SEOMeta::addMeta('name', 'YourCommerce the new website eccomerce for your solutions bussines', 'itemprop');
      SEOMeta::addMeta('description', 'YourCommerce the new website eccomerce for your solutions bussines', 'itemprop');
      SEOMeta::addMeta('Content-Type', 'Content-Type', 'http-equiv');
      SEOMeta::addMeta('robots', 'all,follow', 'name');
      SEOMeta::addMeta('googlebot', 'index,follow,snippet,archive', 'name');
      SEOMeta::addMeta('author', 'Hamdan Hanafi | hamdanhanafi90@gmail.com"', 'name');
      SEOMeta::addMeta('csrf-token', csrf_token(), 'name');

      OpenGraph::setDescription('YourCommerce the new website eccomerce for your solutions bussines');
      OpenGraph::setTitle('Home');
      OpenGraph::setUrl(request()->url());
      OpenGraph::addProperty('type', 'Homepage');

      Twitter::setTitle('Home');
      Twitter::setSite('YourCommerce');
      Twitter::addValue('card', 'summary');
      Twitter::setDescription('YourCommerce the new website eccomerce for your solutions bussines');
      return $this;
    }

    /**
     * Set title seo
     * @param string $value
     * @return $this
     */
    public function setTitle($value) {
      SEOMeta::setTitle($value);
      OpenGraph::setTitle($value);
      Twitter::setTitle($value);
      return $this;
    }

    /**
     * Set title meta for seo
     * @param string $value
     * @return $this
     */
    public function setProperty($type, $value) {
      OpenGraph::addProperty('type', $value);
      return $this;
    }

    /**
     * Set meta product on html
     * @param \App\Models\Master\Product $product
     * @return void
     */
    public function setMetaProduct($product)
    {
      SEOMeta::setTitle($product->name);
      SEOMeta::setDescription($product->description);
      SEOMeta::addMeta('article:published_time', $product->created_at->toW3CString(), 'property');
      SEOMeta::addMeta('article:section', $product->category->name, 'property');
      SEOMeta::addMeta('csrf-token', csrf_token(), 'name');
      SEOMeta::addKeyword(['yourCommerce', 'product', $product->name, $product->sku]);

      OpenGraph::setDescription($product->description);
      OpenGraph::setTitle($product->name);
      OpenGraph::setUrl(request()->url());
      OpenGraph::addProperty('type', 'article');
      OpenGraph::addProperty('locale', 'id_ID');
      OpenGraph::addProperty('locale:alternate', ['en_GB', 'id_ID']);


      OpenGraph::addImage($product->images->first()->path);

      OpenGraph::setTitle('Article')
          ->setDescription($product->description)
          ->setType('article')
          ->setArticle([
              'published_time' => $product->created_at->toW3CString(),
              'modified_time' => $product->updated_at->toW3CString(),
              'author' => 'hamdanhanafi90@gmail.com',
              'section' => $product->name,
              'tag' => [$product->name, $product->category->name, 'yourCommerce']
          ]);
    }

    /**
     * Audit error and write into laravel.log
     * @param  \Exception $e
     * @return void
     */
    public function writeErrors($e)
    {
      info($e->getMessage());
      info($e->getLine());
      info($e->getFile());
    }
}
