<?php

namespace App\Containers\User\Data\Seeders;

use App\Containers\User\Models\User;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class NormalUserSeeder extends ParentSeeder
{
    public function run()
    {
        factory(User::class, 1000)->create();
    }
}
