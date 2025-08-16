<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- BUAT KATEGORI ---
        $skincare = Category::create([
            'name' => 'Skincare',
            'slug' => Str::slug('Skincare'),
        ]);

        $makeup = Category::create([
            'name' => 'Makeup',
            'slug' => Str::slug('Makeup'),
        ]);

        $haircare = Category::create([
            'name' => 'Hair Care',
            'slug' => Str::slug('Hair Care'),
        ]);

        // --- BUAT PRODUK-PRODUK ---

        // Produk untuk kategori Skincare
        Product::create([
            'category_id' => $skincare->id,
            'name' => 'Hydrating Face Serum',
            'slug' => Str::slug('Hydrating Face Serum'),
            'price' => 150000,
            'stock' => 50,
            'description' => 'Serum wajah yang melembapkan dengan kandungan Hyaluronic Acid untuk kulit kenyal dan sehat.'
        ]);

        Product::create([
            'category_id' => $skincare->id,
            'name' => 'Gentle Cleansing Foam',
            'slug' => Str::slug('Gentle Cleansing Foam'),
            'price' => 85000,
            'stock' => 100,
            'description' => 'Pembersih wajah busa yang lembut, mengangkat kotoran tanpa membuat kulit kering.'
        ]);

        // Produk untuk kategori Makeup
        Product::create([
            'category_id' => $makeup->id,
            'name' => 'Matte Finish Foundation',
            'slug' => Str::slug('Matte Finish Foundation'),
            'price' => 220000,
            'stock' => 75,
            'description' => 'Foundation dengan hasil akhir matte yang tahan lama, menutupi noda dengan sempurna.'
        ]);

        Product::create([
            'category_id' => $makeup->id,
            'name' => 'Velvet Cream Lipstick - Ruby Red',
            'slug' => Str::slug('Velvet Cream Lipstick - Ruby Red'),
            'price' => 120000,
            'stock' => 120,
            'description' => 'Lipstik dengan tekstur creamy dan warna merah ruby yang intens.'
        ]);
        
        Product::create([
            'category_id' => $makeup->id,
            'name' => 'Waterproof Mascara',
            'slug' => Str::slug('Waterproof Mascara'),
            'price' => 95000,
            'stock' => 80,
            'description' => 'Maskara tahan air yang memberikan volume dan memanjangkan bulu mata.'
        ]);

        // Produk untuk kategori Hair Care
        Product::create([
            'category_id' => $haircare->id,
            'name' => 'Nourishing Hair Oil',
            'slug' => Str::slug('Nourishing Hair Oil'),
            'price' => 135000,
            'stock' => 60,
            'description' => 'Minyak rambut yang menutrisi dari akar hingga ujung, membuat rambut berkilau dan kuat.'
        ]);
    }
}
