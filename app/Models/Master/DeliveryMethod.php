<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Master\DeliveryMethod
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property float $fee
 * @property int $estimated_time
 * @property string $image
 * @property bool $main
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\DeliveryMethod whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\DeliveryMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\DeliveryMethod whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\DeliveryMethod whereEstimatedTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\DeliveryMethod whereFee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\DeliveryMethod whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\DeliveryMethod whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\DeliveryMethod whereMain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\DeliveryMethod whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\DeliveryMethod whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sales\Order[] $orders
 */
class DeliveryMethod extends Model
{
    /**
     * The fillable columns
     * @var array
     */
    protected $fillable = ['code', 'name', 'description', 'fee', 'estimated_time', 'image', 'main'];

    /**
     * Relation with orders
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function orders()
    {
      return $this->hasMany(\App\Models\Sales\Order::class, 'delivery_method_id');
    }
}
