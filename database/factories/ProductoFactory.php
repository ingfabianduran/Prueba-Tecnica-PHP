<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => 'Producto ' . $this->faker->numberBetween(100, 200),
            'referencia' => $this->faker->numberBetween(10000, 99999),
            'precio' => $this->faker->numberBetween(1000, 9999),
            'peso' => $this->faker->numberBetween(100, 999),
            'categoria' => $this->faker->randomElement(['Frutos', 'Postres', 'Panes', 'Bebidas', 'Dulces']),
            'stock' => $this->faker->numberBetween(1, 50)
        ];
    }
}
