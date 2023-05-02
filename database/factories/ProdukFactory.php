<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Produk;

class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Produk::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            // 'gambar' => $this->faker->imageUrl(),
            'gambar' => 'images/produk/202304110641-placeholder.png', // custom string value

            'harga' => $this->faker->numberBetween(10000, 500000),
            'deskripsi' => $this->faker->sentence(),
            'kondisi' => $this->faker->randomElement(['baru', 'bekas']),
            'alamat' => $this->faker->address(),
            'kuantitas' => $this->faker->numberBetween(1, 100),
            'provinsi' => $this->faker->state(),
        ];
    }


}
