<?php

namespace Picpocket\Account\Factory;

use Illuminate\Database\Eloquent\Factories\Factory;
use PicPocket\Account\Enums\AccountTypeEnum;
use Picpocket\Account\Model\Account;
use Picpocket\Customer\Model\Customer;

/**
 * Class AccountFactory
 *
 * Factory for generating Account model instances for testing or seeding.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 *
 * @extends Factory<Account>
 */
class AccountFactory extends Factory
{
    /**
     * The name of the model corresponding to the factory.
     *
     * @var class-string<Account>
     */
    protected $model = Account::class;

    /**
     * Define the default state of the Account model.
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'customer_id' => Customer::factory(),
            'type' => AccountTypeEnum::PHYSICAL,
            'cpf_cnpj' => $this->faker->numerify('###########'),
        ];
    }

    /**
     * Define the state for a legal ("Pessoa Jurídica") account.
     */
    public function setPj(): self
    {
        return $this->state(function () {
            return [
                'type' => AccountTypeEnum::LEGAL,
                'cpf_cnpj' => $this->faker->numerify('##############'),
            ];
        });
    }

    /**
     * Define the state for a physical ("Pessoa Física") account.
     */
    public function setPf(): self
    {
        return $this->state(function () {
            return [
                'type' => AccountTypeEnum::PHYSICAL,
                'cpf_cnpj' => $this->faker->numerify('###########'),
            ];
        });
    }
}
