<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VisitPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testVisitHome()
    {
      $response = $this->get('/');

      $response->assertStatus(200);
    }

    public function testVisitProductPage()
    {
      $category = \App\Models\Master\Category::main()->orderByRaw('RAND()')->first();

      $lists = collect(['all']);

      while ($category) {
        $lists->push($category->slug);
        $category = $category->child->first();
      }

      $url = $lists->implode('/');

      $response = $this->get('/'.$url);

      $response->assertStatus(200);
    }

    public function testVisitProductDetailPage()
    {
      $product = \App\Models\Master\Product::orderByRaw('RAND()')->first();

      $categories = collect([$product->slug]);

      $category = $product->category;

      while ($category) {
        $categories->push($category->slug);
        $category = $category->parent;
      }

      $categories->push('s');

      $categories = $categories->reverse()->values();

      $url = $categories->implode('/');

      $response = $this->get('/'.$url);

      $response->assertStatus(200);
    }

    public function testRedirectIfNotHaveCartOrderOnStep1()
    {
      $response = $this->get('/o/c/step-1');

      $response->assertStatus(302);
    }

    public function testRedirectIfNotHaveCartOrderOnStep2()
    {
      $response = $this->get('/o/c/step-2');

      $response->assertStatus(302);
    }

    public function testRedirectIfNotHaveCartOrderOnStep3()
    {
      $response = $this->get('/o/c/step-3');

      $response->assertStatus(302);
    }

    public function testRedirectIfNotHaveCartOrderOnStep4()
    {
      $response = $this->get('/o/c/step-4');

      $response->assertStatus(302);
    }

    public function testNotFoundPage()
    {
      $response = $this->get('/not-found-page');

      $response->assertStatus(404);
    }
}
