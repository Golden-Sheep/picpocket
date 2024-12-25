<?php

namespace Picpocket\Transaction\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Picpocket\Transaction\Http\Controllers\TransactionController;

/**
 * Class TransactionRouteProvider
 *
 * Registers the routes related to transactions.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class TransactionRouteProvider extends RouteServiceProvider
{
    /**
     * Map the transaction routes.
     *
     * @return void
     */
    public function map(): void
    {
        Route::post(
            '/transactions',
            [TransactionController::class, 'createTransaction']
        )->name('transactions.store');
    }
}
