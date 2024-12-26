<?php

namespace Picpocket\Api\External\PaymentGateways;

/**
 * Interface PaymentGatewayInterface
 *
 * Defines the contract for payment gateway integrations.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
interface PaymentGatewayInterface
{
    /**
     * Returns the name of the payment gateway.
     */
    public function getGatewayName(): string;

    /**
     * Authorizes a payment request using the PicPay API.
     */
    public function authorizePayment(): bool;
}
