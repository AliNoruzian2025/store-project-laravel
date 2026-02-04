<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $productImages = [
            'https://cdn.dummyjson.com/products/images/laptops/Apple%20MacBook%20Pro%2014%20Inch%20Space%20Grey/thumbnail.png',
            'https://cdn.dummyjson.com/products/images/smartphones/iPhone%20X/thumbnail.png',
            'https://cdn.dummyjson.com/products/images/mens-watches/Rolex%20Submariner%20Watch/thumbnail.png',
            'https://cdn.dummyjson.com/products/images/vehicle/Charger%20SXT%20RWD/thumbnail.png',
            'https://cdn.dummyjson.com/products/images/womens-jewellery/Green%20Oval%20Earring/thumbnail.png',
            'https://cdn.dummyjson.com/products/images/sports-accessories/Cricket%20Helmet/thumbnail.png',
            'https://cdn.dummyjson.com/products/images/mobile-accessories/Apple%20Airpods/thumbnail.png',
            'https://cdn.dummyjson.com/products/images/womens-bags/Blue%20Women\'s%20Handbag/thumbnail.png',
            'https://cdn.dummyjson.com/products/images/womens-shoes/Golden%20Shoes%20Woman/thumbnail.png',
            'https://cdn.dummyjson.com/products/images/mens-shoes/Nike%20Air%20Jordan%201%20Red%20And%20Black/thumbnail.png',
        ];

        return [
            'name' => $this->faker->sentence(3),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->paragraphs(2, true),
            'price' => $this->faker->numberBetween(10000, 1000000),
            'discount_price' => $this->faker->boolean(30) ? $this->faker->numberBetween(5000, 500000) : null,
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => $this->faker->randomElement($productImages),
            'category_id' => $this->faker->numberBetween(1, 5),
            'is_active' => true,
            'is_featured' => $this->faker->boolean(20),
        ];
    }
}