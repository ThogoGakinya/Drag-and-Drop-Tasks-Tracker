<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Priority;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Priority::create([
            'name' =>  'Low',
            'level' =>  4
            ]);

        Priority::create([
            'name' =>  'Medium',
            'level' =>  3
            ]);

        Priority::create([
            'name' =>  'High',
            'level' =>  2
            ]);

        Priority::create([
            'name' =>  'Critical',
            'level' =>  1
            ]);
    }
}
