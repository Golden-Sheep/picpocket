<?php

namespace Picpocket\Account\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PicPocket\Account\Enums\AccountTypeEnum;
use Picpocket\Account\Factory\AccountFactory;
use Picpocket\Customer\Model\Customer;

/**
 * Class Account
 *
 * Represents the Account model, including relationships and casts.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class Account extends Model
{
    use HasFactory, HasUuids;

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
    protected $table = 'accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'customer_id',
        'type',
        'cpf_cnpj',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => AccountTypeEnum::class,
    ];

    /**
     * Creates a new factory instance for the model.
     */
    protected static function newFactory(): AccountFactory
    {
        return AccountFactory::new();
    }

    /**
     * Defines the relationship between Account and Customer.
     *
     * * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    /**
     * Checks if is retailer account.
     *
     * @property AccountTypeEnum $type
     */
    public function isRetailerAccount(): bool
    {
        return $this->type === AccountTypeEnum::LEGAL;
    }
}
