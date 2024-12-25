<?php

namespace Tests\Feature\Picpocket\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Picpocket\Transaction\Enums\TransactionStatusEnum;
use Picpocket\Wallet\Model\Wallet;
use Tests\TestCase;

/**
 * Class TransactionControllerTest
 *
 * Tests the functionality of the TransactionController.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class TransactionControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Tests the payment transaction flow.
     *
     * @return void
     */
    public function testPostPayment()
    {

        $payer = Wallet::factory()->customer()->create([
            'balance' => 10_00
        ]);

        $payee = Wallet::factory()->customer()->create([
            'balance' => 10_00
        ]);

        $amount = 5_00;

        $response = $this->postJson(route('transactions.store'), [
            'payer_id' => $payer->getKey(),
            'payee_id' => $payee->getKey(),
            'amount' => $amount
        ]);

        $response->assertNoContent();

        $this->assertDatabaseHas('transactions', [
            'wallet_from_id' => $payer->getKey(),
            'wallet_to_id' => $payee->getKey(),
            'amount' => $amount,
            'status' => TransactionStatusEnum::Completed,
        ]);

        $this->assertDatabaseHas('wallets', [
            'id' => $payer->getKey(),
            'balance' => 5_00,
        ]);

        $this->assertDatabaseHas('wallets', [
            'id' => $payee->getKey(),
            'balance' => 15_00,
        ]);
    }
}
