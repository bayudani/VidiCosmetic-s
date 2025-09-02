<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(3, true); // Buat nama produk palsu (misal: "Sleek Cotton Computer")

        return [
            'name' => $name,
            'category_id' => Category::factory(),
            'slug' => Str::slug($name), // Buat slug otomatis dari nama
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(50000, 250000), // Harga antara 50rb - 250rb
            // 'cost_price' => fake()->numberBetween(25000, 100000), // Harga modal
            'stock' => fake()->numberBetween(10, 100), // Stok antara 10 - 100
        ];
    }
}
