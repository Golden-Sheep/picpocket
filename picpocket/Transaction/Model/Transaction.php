<?php

namespace Picpocket\Transaction\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Picpocket\Wallet\Model\Wallet;

/**
 * Class Transaction
 *
 * Represents the Transaction model, including relationships and data casting.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 *
 * @property string $id
 * @property string $wallet_from_id
 * @property string $wallet_to_id
 * @property int $amount
 * @property string $status
 * @property string|null $description
 * @property \Carbon\Carbon $transaction_date
 */
class Transaction extends Model
{
    use HasUuids;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'wallet_from_id',
        'wallet_to_id',
        'amount',
        'status',
        'description',
        'transaction_date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'integer',
        'transaction_date' => 'datetime'
    ];

    /**
     * Relationship: The wallet from which the transaction originates.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function walletFrom()
    {
        return $this->belongsTo(Wallet::class, 'wallet_from_id', 'id');
    }

    /**
     * Relationship: The wallet to which the transaction is sent.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function walletTo()
    {
        return $this->belongsTo(Wallet::class, 'wallet_to_id', 'id');
    }
}
