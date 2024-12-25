<?php

namespace Picpocket\Notifications\Api\External;

interface NotificationInterface
{
    /**
     * Returns the name of the notification API.
     *
     * @return string
     */
    public function getNotificationApiName(): string;

    /**
     * Sends a payment notification using the PicPay API.
     *
     * @return bool
     */
    public function sendNotificationPayment(): bool;
}
