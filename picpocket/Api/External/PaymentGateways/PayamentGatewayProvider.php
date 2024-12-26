<?php

namespace Picpocket\Api\External\PaymentGateways;

use Carbon\Laravel\ServiceProvider;

/**
 * Class PayamentGatewayProvider
 *
 * Service provider to bind the payment gateway interface to its implementation.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class PayamentGatewayProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->bindPayamentGateway();
    }

    /**
     * Bind the PaymentGatewayInterface to its implementation.
     *
     * @return void
     */
    protected function bindPayamentGateway()
    {
        $this->app->bind(PaymentGatewayInterface::class, function () {
            return (new PicpayGatewayFactory)();
        });
    }
}
