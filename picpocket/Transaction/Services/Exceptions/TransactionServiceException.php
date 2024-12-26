<?php

namespace Picpocket\Transaction\Services\Exceptions;

use Exception;
use Picpocket\Api\External\PaymentGateways\PaymentGatewayInterface;
use Picpocket\Notifications\Api\External\NotificationServiceInterface;

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
     */
    public static function retailerNotAllowedToPay(): self
    {
        return new self('Retailers are not allowed to make payments.');
    }

    /**
     * Exception for insufficient wallet balance.
     */
    public static function outOfPocket(): self
    {
        return new self('Insufficient funds in the wallet.');
    }

    /**
     * Exception for payment authorization failure.
     */
    public static function notAuthorizedByGateway(PaymentGatewayInterface $gateway): self
    {
        return new self(sprintf('Payment not authorized by %s. Rolling back...', $gateway->getGatewayName()));
    }

    /**
     * Exception for notification failure.
     */
    public static function paymentMessageNotSent(NotificationServiceInterface $notification): self
    {
        return new self(sprintf('Notification message not sent by %s. Rolling back...', $notification->getNotificationApiName()));
    }
}
