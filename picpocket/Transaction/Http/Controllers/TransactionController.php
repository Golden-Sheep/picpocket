<?php

namespace Picpocket\Transaction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Picpocket\Transaction\Http\Requests\CreateTransactionRequest;
use Picpocket\Transaction\Services\TransactionServiceInterface;
use Picpocket\Transaction\Services\Exceptions\TransactionServiceException;

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
     * @return JsonResponse
     */
    public function createTransaction(
        CreateTransactionRequest $request
    ): JsonResponse {
        try {
            $this->transactionService->handle($request->toDTO());

            return response()->json([
                'message' => 'Transaction created successfully.',
            ], Response::HTTP_CREATED); // HTTP 201
        } catch (TransactionServiceException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST); // HTTP 400
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR); // HTTP 500
        }
    }
}
