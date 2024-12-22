<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $types = ['fiction', 'non-fiction', 'educational', 'biography'];

        foreach ($types as $type) {
            DB::table('types')->insert([
                'name' => $type
            ]);
        }
    }
}
