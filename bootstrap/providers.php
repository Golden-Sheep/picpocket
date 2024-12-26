<?php

return [
    App\Providers\AppServiceProvider::class,
    \Picpocket\Transaction\Providers\TransactionRouteProvider::class,
    \Picpocket\Transaction\Providers\TransactionProvider::class,
    \Picpocket\Wallet\Providers\WalletProvider::class,
    \Picpocket\Api\External\PaymentGateways\PayamentGatewayProvider::class,
    \Picpocket\Notifications\Api\External\NotificationServiceProvider::class,
    \Picpocket\Log\Provider\LoggerProvider::class
];
