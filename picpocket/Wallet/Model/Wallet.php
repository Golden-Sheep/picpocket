<?php

namespace Picpocket\Wallet\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PicPocket\Account\Enums\AccountTypeEnum;
use Picpocket\Account\Model\Account;
use Picpocket\Wallet\Factory\WalletFactory;

/**
 * Class Wallet
 *
 * Represents a wallet model with balance and account relationships.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 *
 * @property int $balance The balance of the wallet.
 */
class Wallet extends Model
{
    use HasUuids, HasFactory;

    public $incrementing = false;

    protected $table = 'wallets';

    protected $fillable = [
        'id',
        'name',
        'account_id',
        'balance'
    ];

    protected $casts = [
        'balance' => 'integer'
    ];

    /**
     * Creates a new factory instance for the Wallet model.
     *
     * @return WalletFactory
     */
    protected static function newFactory(): WalletFactory
    {
        return WalletFactory::new();
    }

    /**
     * Checks if the wallet has sufficient balance.
     *
     * @param int $amount
     * @return bool
     */
    public function hasBalance(int $amount): bool
    {
        return $this->balance >= $amount;
    }

    /**
     * Defines the relationship between Wallet and Account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
