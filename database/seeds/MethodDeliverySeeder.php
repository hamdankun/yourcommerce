<?php

use Illuminate\Database\Seeder;

class MethodDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Master\DeliveryMethod::class, 5)->create();
    }
}
