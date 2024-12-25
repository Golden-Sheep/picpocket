<?php

namespace Picpocket\Api\External\PaymentGateways;

/**
 * Class PicpayGatewayFactory
 *
 * Factory for creating instances of the PaymentGateway class.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class PicpayGatewayFactory
{
    /**
     * Creates a new instance of the PaymentGateway.
     *
     * @return PaymentGateway
     */
    public function __invoke(): PaymentGateway
    {
        return new PaymentGateway();
    }
}
