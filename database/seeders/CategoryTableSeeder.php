<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Category::query()->upsert([
            ["name" => "Pencil carving", "slug" => "pencil-carving"],
            ["name" => "Art on rice grains", "slug" => "art-on-rice-grains"],
            ["name" => "Micro painting and drawing", "slug" => "micro-painting-and-drawing"],
            ["name" => "Micro engraving", "slug" => "micro-engraving"],
            ["name" => "Others", "slug" => "others"],
        ], ["slug"], ["name"]);
    }
}
