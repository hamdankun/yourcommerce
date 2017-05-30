<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Master\PaymentMethod
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\PaymentMethod whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\PaymentMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\PaymentMethod whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\PaymentMethod whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\PaymentMethod whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\PaymentMethod whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\PaymentMethod whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sales\Order[] $orders
 */
class PaymentMethod extends Model
{
    /**
     * The fillable columns
     * @var array
     */
    protected $fillable = ['code', 'name', 'description', 'image'];

    /**
     * Relation with orders
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function orders()
    {
      return $this->hasMany(\App\Models\Sales\Order::class, 'payment_method_id');
    }
}
