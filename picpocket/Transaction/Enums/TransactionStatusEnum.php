<?php

namespace Picpocket\Transaction\Enums;

/**
 * Enum TransactionStatusEnum
 *
 * Represents the possible statuses for a transaction.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
enum TransactionStatusEnum: string
{
    /**
     * Status when the transaction is created.
     */
    case Created = 'created';

    /**
     * Status when the amount is withdrawn from the payer's account.
     */
    case Withdrawed = 'withdrawed';

    /**
     * Status when the amount is debited.
     */
    case Debited = 'debited';

    /**
     * Status when the transaction is completed successfully.
     */
    case Completed = 'completed';
}
