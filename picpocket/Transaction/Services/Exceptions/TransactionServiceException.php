<?php

namespace Picpocket\Transaction\Services\Exceptions;

use Exception;
use Picpocket\Api\External\PaymentGateways\PaymentGateway;
use Picpocket\Notifications\Api\External\PicpayNotificationService;

/**
 * Class TransactionServiceException
 *
 * Custom exceptions for transaction service operations.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class TransactionServiceException extends Exception
{
    /**
     * Exception for when retailers attempt to make a payment.
     *
     * @return self
     */
    public static function retailerNotAllowedToPay(): self
    {
        return new self("Retailers are not allowed to make payments.");
    }

    /**
     * Exception for insufficient wallet balance.
     *
     * @return self
     */
    public static function outOfPocket(): self
    {
        return new self("Insufficient funds in the wallet.");
    }

    /**
     * Exception for payment authorization failure.
     *
     * @param PaymentGateway $gateway
     * @return self
     */
    public static function notAuthorizedByGateway(PaymentGateway $gateway): self
    {
        return new self(sprintf('Payment not authorized by %s. Rolling back...', $gateway->getGatewayName()));
    }

    /**
     * Exception for notification failure.
     *
     * @param PicpayNotificationService $notification
     * @return self
     */
    public static function paymentMessageNotSent(PicpayNotificationService $notification): self
    {
        return new self(sprintf('Notification message not sent by %s. Rolling back...', $notification->getNotificationApiName()));
    }
}
