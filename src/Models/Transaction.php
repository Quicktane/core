<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Carbon;
use Lunar\Base\Casts\Price;
use Lunar\Database\Factories\TransactionFactory;
use Quicktane\Core\Base\BaseModel;

/**
 * @property int $id
 * @property ?int $parent_transaction_id
 * @property int $order_id
 * @property bool $success
 * @property string $type
 * @property string $driver
 * @property int $amount
 * @property string $reference
 * @property string $status
 * @property ?string $notes
 * @property string $card_type
 * @property ?string $last_four
 * @property ?array $meta
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property ?Carbon $deleted_at
 */
class Transaction extends BaseModel
{
    use HasFactory;

    /**
     * {@inheritDoc}
     */
    protected $guarded = [];

    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'refund' => 'bool',
        'amount' => Price::class,
        'meta' => AsArrayObject::class,
    ];

    /**
     * Return the order relationship.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Return the currency relationship.
     */
    public function currency(): HasOneThrough
    {
        return $this->hasOneThrough(
            Currency::class,
            Order::class,
            'id',
            'code',
            'order_id',
            'currency_code'
        );
    }
}
