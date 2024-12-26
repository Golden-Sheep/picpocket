<?php

namespace Picpocket\Notifications\Api\External;

use Illuminate\Support\Facades\Http;

/**
 * Class PicpayNotificationServiceService
 *
 * Implementation of the NotificationServiceInterface for sending notifications via PicPay.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class PicpayNotificationServiceService implements NotificationServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function getNotificationApiName(): string
    {
        return 'picpay';
    }

    /**
     * {@inheritdoc}
     */
    public function sendNotificationPayment(): bool
    {
        $request = Http::post('https://util.devi.tools/api/v1/notify');

        return $request->successful();
    }
}
