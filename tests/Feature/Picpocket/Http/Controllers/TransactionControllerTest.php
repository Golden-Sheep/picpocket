<?php

namespace Tests\Feature\Picpocket\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery;
use Picpocket\Api\External\PaymentGateways\PaymentGatewayInterface;
use Picpocket\Notifications\Api\External\NotificationServiceInterface;
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
    public function test_post_payment()
    {
        // Arrange: Create mocks for external dependencies
        $picpayGatewayMock = Mockery::mock(PaymentGatewayInterface::class);
        $picpayGatewayMock->shouldReceive('authorizePayment')
            ->once()
            ->andReturn(true);

        $picpayNotificationMock = Mockery::mock(NotificationServiceInterface::class);
        $picpayNotificationMock->shouldReceive('sendNotificationPayment')
            ->once()
            ->andReturn(true);

        // Replace mocked instances in the Laravel container
        $this->app->instance(PaymentGatewayInterface::class, $picpayGatewayMock);
        $this->app->instance(NotificationServiceInterface::class, $picpayNotificationMock);

        // Arrange: Create payer and payee wallets with initial balances
        $payer = Wallet::factory()->customer()->create(['balance' => 10_00]);
        $payee = Wallet::factory()->customer()->create(['balance' => 10_00]);
        $amount = 5_00;

        // Act: Make the POST request to perform the transaction
        $response = $this->postJson(route('transactions.store'), [
            'payer_id' => $payer->getKey(),
            'payee_id' => $payee->getKey(),
            'amount' => $amount,
        ]);

        // Assert: Verify the response and database state
        $response->assertCreated();

        // Check if the transaction was recorded
        $this->assertDatabaseHas('transactions', [
            'wallet_from_id' => $payer->getKey(),
            'wallet_to_id' => $payee->getKey(),
            'amount' => $amount,
            'status' => TransactionStatusEnum::Completed,
        ]);

        // Check if balances were updated correctly
        $this->assertDatabaseHas('wallets', [
            'id' => $payer->getKey(),
            'balance' => 5_00,
        ]);

        $this->assertDatabaseHas('wallets', [
            'id' => $payee->getKey(),
            'balance' => 15_00,
        ]);
    }

    /**
     * Cleanup Mockery after each test.
     */
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
