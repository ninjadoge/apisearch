<?php

namespace Database\Seeders;

use App\Models\RealEstateProperty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RealEstateFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RealEstateProperty::factory()
            ->count(100)
            ->create();
    }
}
