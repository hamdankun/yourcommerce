<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sales\OrderDetail
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property float $price
 * @property int $qty
 * @property float $discount
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\OrderDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\OrderDetail whereDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\OrderDetail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\OrderDetail whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\OrderDetail wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\OrderDetail whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\OrderDetail whereQty($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\OrderDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Sales\Order $order
 */
class OrderDetail extends Model
{
    /**
     * The fillable columns
     * @var array
     */
    protected $fillable = ['order_id', 'product_id', 'price', 'qty', 'discount'];

    /**
     * Relation with order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
      return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Relation with product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
      return $this->belongsTo(\App\Models\Master\Product::class, 'product_id');
    }
}
