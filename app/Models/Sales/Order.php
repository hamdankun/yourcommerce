<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sales\Order
 *
 * @property int $id
 * @property int $member_id
 * @property string $member_type
 * @property int $delivery_method_id
 * @property int $address_id
 * @property int $payment_method_id
 * @property string $invoice
 * @property string $date
 * @property float $total
 * @property float $tax
 * @property float $shipping_cost
 * @property float $discount_total
 * @property float $grand_total
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereAddressId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereDeliveryMethodId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereDiscountTotal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereGrandTotal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereInvoice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereMemberId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereMemberType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order wherePaymentMethodId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereShippingCost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereTax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereTotal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\Order whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Master\MemberAddress $address
 * @property-read \App\Models\Master\DeliveryMethod $deliveryMethod
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sales\OrderDetail[] $details
 * @property-read \App\Models\Master\PaymentMethod $paymentMethod
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $member
 */
class Order extends Model
{
  /**
   * The fillable columns
   * @var array
   */
  protected $fillable = ['member_id', 'member_type', 'delivery_method_id', 'address_id', 'payment_method_id', 'invoice', 'date', 'total', 'tax', 'shipping_cost', 'discount_total', 'grand_total', 'order_number'];

  const NAMESPACE_MASTER = 'App\\Models\\Master\\';


  /**
   * The boot models
   * @return void
   */
  protected static function boot()
  {
    parent::boot();
    static::created(function($model) {
      $model->order_number = time().$model->id;
      $model->invoice = 'INV/'.date('Y').'/'.date('m').'/'.date('d').'/'.date('H').'/'.date('i').'/'.date('s').'/'.$model->id;
      $model->save();
    });
  }
  /**
   * Relation with member
   * @return \Illuminate\Database\Eloquent\Relations\MorphTo
   */
  public function member()
  {
    return $this->morphTo();
  }

  /**
   * Relation with delivery method
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function deliveryMethod()
  {
    return $this->belongsTo(static::NAMESPACE_MASTER.\DeliveryMethod::class, 'delivery_method_id');
  }

  /**
   * Relation with address member
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function address()
  {
    return $this->belongsTo(static::NAMESPACE_MASTER.\MemberAddress::class, 'address_id');
  }

  /**
   * Relation With payment method
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function paymentMethod()
  {
    return $this->belongsTo(static::NAMESPACE_MASTER.\PaymentMethod::class, 'payment_method_id');
  }

  /**
   * Relation with order details
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function details()
  {
    return $this->hasMany(OrderDetail::class, 'order_id');
  }

}
