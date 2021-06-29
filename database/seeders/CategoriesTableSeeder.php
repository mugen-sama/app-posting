<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = collect(['Framework', 'Code']);
        $categories->each(function($c) {
            \App\Models\Category::create([
                'name' => $c,
                'slug' => Str::slug($c),
            ]);
        });
    }
}
