<?php

namespace Picpocket\Wallet\Factory;

use Illuminate\Database\Eloquent\Factories\Factory;
use Picpocket\Account\Model\Account;
use Picpocket\Wallet\Model\Wallet;

/**
 * Class WalletFactory
 *
 * Factory for generating Wallet model instances for testing or seeding.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class WalletFactory extends Factory
{
    /**
     * The name of the model corresponding to the factory.
     *
     * @var string
     */
    protected $model = Wallet::class;

    /**
     * Define the default state of the Wallet model.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'account_id' => null,
            'balance' => 20000,
        ];
    }

    /**
     * Define the state for a wallet associated with a customer account.
     *
     * @return static
     */
    public function customer(): static
    {
        $account = Account::factory()->pf()->create();
        return $this->state(fn (array $attributes) => [
            'account_id' => $account->id
        ]);
    }

    /**
     * Define the state for a wallet associated with a retailer account.
     *
     * @return static
     */
    public function retailer(): static
    {
        $account = Account::factory()->pj()->create();
        return $this->state(fn (array $attributes) => [
            'account_id' => $account->id
        ]);
    }
}
