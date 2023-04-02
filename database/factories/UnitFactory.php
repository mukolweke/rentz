<?php

namespace Database\Factories;

use App\Data\Models\House;
use App\Data\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class UnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Unit::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(1),
            'block' => $this->faker->sentence(1),
            'description' => $this->faker->paragraph(2),
            'house_id' => House::all()->random()->id,
        ];
    }
}
