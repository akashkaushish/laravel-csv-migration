<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->unique()->uuid(),
            'seller_id' => $this->faker->unique()->randomDigit,
            'seller_firstname' => $this->faker->name(),
            'seller_lastname' => $this->faker->name(),
            'date_joined' => date('Y-m-d'),
            'country' => $this->faker->text(5),
            'contact_region' => $this->faker->text(10),
            'contact_date' => date('Y-m-d'),
            'contact_customer_fullname' => $this->faker->name(),
            'contact_type' => $this->faker->text(5),
            'contact_product_type_offered_id' => $this->faker->unique()->randomDigit,
            'contact_product_type_offered' => $this->faker->text(10),
            'sale_net_amount' => $this->faker->randomFloat('2', 0, 2),
            'sale_gross_amount' => $this->faker->randomFloat('2', 0, 2),
            'sale_tax_rate' => $this->faker->randomFloat('2', 0, 2),
            'sale_product_total_cost' => $this->faker->randomFloat('2', 0, 2),

        ];
    }
}
