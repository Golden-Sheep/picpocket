<?php

namespace Picpocket\Customer\Factory;

use Illuminate\Database\Eloquent\Factories\Factory;
use Picpocket\Customer\Model\Customer;

/**
 * Class CustomerFactory
 *
 * Factory for generating Customer model instances for testing or seeding.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class CustomerFactory extends Factory
{
    /**
     * The name of the model corresponding to the factory.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the default state of the Customer model.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
        ];
    }
}
