<?php

namespace Picpocket\Transaction\DTO;

/**
 * Class CreateTransactionDTO
 *
 * Data Transfer Object for creating a transaction.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
readonly class CreateTransactionDTO
{
    /**
     * CreateTransactionDTO constructor.
     *
     * @param string $payerId ID of the payer.
     * @param string $payeeId ID of the payee.
     * @param int    $amount  Amount of the transaction.
     */
    public function __construct(
        public string $payerId,
        public string $payeeId,
        public int    $amount
    ) {
    }
}
