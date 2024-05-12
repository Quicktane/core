<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;

/**
 * @property int     $id
 * @property int     $cart_id
 * @property string  $purchasable_type
 * @property int     $purchasable_id
 * @property int     $quantity
 * @property ?array  $meta
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @method static static|QueryBuilder|EloquentBuilder query()
 */
class CartItem extends BaseModel
{
    use HasFactory;

    /**
     * Define which attributes should be
     * protected from mass assignment.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'quantity' => 'integer',
        'meta'     => AsArrayObject::class,
    ];

    /**
     * Return the cart relationship.
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
