<?php

namespace App\Containers\Product\Data\Seeders;

use App\Containers\Product\Models\Product;
use App\Ship\Parents\Seeders\Seeder;

class ProductPermissionsSeeder1 extends Seeder
{
    public function run()
    {
        factory(Product::class, 100)->create();
    }
}
