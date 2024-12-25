<?php

namespace Picpocket\Transaction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Picpocket\Transaction\Http\Requests\CreateTransactionRequest;
use Picpocket\Transaction\Services\TransactionServiceInterface;

/**
 * Class TransactionController
 *
 * Handles HTTP requests related to transactions.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class TransactionController extends Controller
{
    /**
     * TransactionController constructor.
     *
     * @param TransactionServiceInterface $transactionService
     */
    public function __construct(
        private readonly TransactionServiceInterface $transactionService
    ) {
    }

    /**
     * Handles the creation of a transaction.
     *
     * @param CreateTransactionRequest $request
     * @return Response
     */
    public function createTransaction(
        CreateTransactionRequest $request
    ): Response {
        $this->transactionService->handle($request->toDTO());
        return response()->noContent();
    }
}
