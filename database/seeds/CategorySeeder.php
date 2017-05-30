<?php

use Illuminate\Database\Seeder;
use App\Models\Master\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(\App\Models\Master\Category::class, 5)->create();
        $this->generate(['Men', 'Ladies']);
    }

    public function generate($categories)
    {
      foreach ($categories as $key => $value) {
          $level1 = Category::create([
            'name' => $value,
            'parent_id' => 0
          ]);

          foreach (['clothing', 'shoes', 'accesories', 'featured', 'looks and trends'] as $key => $value) {
            $level2 = Category::create([
              'name' => $value,
              'parent_id' => $level1->id
            ]);

            foreach (['t-shirts', 'shirts', 'pants', 'accesories'] as $key => $value) {
              $level3 = Category::create([
                'name' => $value,
                'parent_id' => $level2->id
              ]);
            }
          }
      }
    }
}
