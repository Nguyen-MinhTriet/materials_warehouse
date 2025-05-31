<?php

namespace Database\Factories;

use App\Models\warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'position' => $this->faker->randomElement(['Manager', 'Staff', 'Supervisor', 'Worker']),
            'contract' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract']),
            'gender' => $this->faker->boolean(), // 0: Nữ, 1: Nam
            'birth_date' => $this->faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'status' => $this->faker->boolean(), // 0: Không hoạt động, 1: Hoạt động
            'warehouse_id' => warehouse::query()->inRandomOrder()->value('id'), // Tạo hoặc lấy ID từ Warehouse
        ];
    }
}
