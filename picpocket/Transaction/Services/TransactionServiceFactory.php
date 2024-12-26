<?php

namespace Picpocket\Transaction\Services;

use Picpocket\Api\External\PaymentGateways\PaymentGatewayInterface;
use Picpocket\Notifications\Api\External\NotificationInterface;
use Picpocket\Transaction\Actions\TransactionActionInterface;
use Picpocket\Wallet\Actions\WalletActionInterface;
use Psr\Log\LoggerInterface;

/**
 * Class TransactionServiceFactory
 *
 * Factory for creating instances of the TransactionService class.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class TransactionServiceFactory
{
    /**
     * Creates a new instance of TransactionService.
     *
     * @return TransactionService
     */
    public function __invoke(): TransactionService
    {
        $walletAction = app(WalletActionInterface::class);
        $transactionAction = app(TransactionActionInterface::class);
        $paymentGateway = app(PaymentGatewayInterface::class);
        $picpayNotification = app(NotificationInterface::class);
        $logger = app(LoggerInterface::class);

        return new TransactionService($walletAction, $transactionAction, $paymentGateway, $picpayNotification, $logger);
    }
}
