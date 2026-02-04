<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // دسته‌بندی‌ها
        if (Category::count() === 0) {
            $categories = [
                ['name' => 'الکترونیک', 'slug' => 'electronics'],
                ['name' => 'لباس', 'slug' => 'clothing'],
                ['name' => 'کتاب', 'slug' => 'books'],
                ['name' => 'خانه و آشپزخانه', 'slug' => 'home-kitchen'],
                ['name' => 'ورزشی', 'slug' => 'sports'],
            ];

            foreach ($categories as $category) {
                Category::create($category);
            }
        }

        // محصولات
        if (Product::count() === 0) {
            Product::factory(50)->create();
            Product::factory(10)->create(['is_featured' => true]);
        }
    }
}