<?php

namespace Picpocket\Notifications\Api\External;

interface NotificationServiceInterface
{
    /**
     * Returns the name of the notification API.
     */
    public function getNotificationApiName(): string;

    /**
     * Sends a payment notification using the PicPay API.
     */
    public function sendNotificationPayment(): bool;
}
