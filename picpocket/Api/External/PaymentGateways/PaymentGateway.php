<?php

namespace Picpocket\Api\External\PaymentGateways;

use Illuminate\Support\Facades\Http;

/**
 * Class PaymentGateway
 *
 * Implementation of the PaymentGatewayInterface for handling PicPay payment gateway interactions.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class PaymentGateway implements PaymentGatewayInterface
{
    /**
     * @inheritdoc
     */
    public function getGatewayName(): string
    {
        return 'picpay';
    }

    /**
     * @inheritdoc
     */
    public function authorizePayment(): bool
    {
        $request = Http::get('https://util.devi.tools/api/v2/authorize')->json();
        return $request['status'] == 'success';
    }
}
