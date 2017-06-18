<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Master\Member
 *
 * @property int $id
 * @property string $name
 * @property string $joined_at
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Member whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Member whereJoinedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Member whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Member whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Member whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $image_path
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Member whereImagePath($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Master\MemberAddress[] $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sales\Order[] $orders
 * @property-read \App\Models\Master\User $user
 */
class Member extends Model
{
  /**
   * The fillable columns on table
   * @var array
   */
  protected $fillable = ['name', 'joined_at', 'status', 'image_path'];

  /**
   * The namespace sales
   * @var string
   */
  const NAMESPACE_SALES = 'App\\Models\\Sales\\';

  /**
   * Relation with address
   * @return \Illuminate\Database\Eloquent\Relations\MorphMany
   */
  public function addresses()
  {
    return $this->morphMany(MemberAddress::class, 'member');
  }

  /**
   * Relation with order
   * @return \Illuminate\Database\Eloquent\Relations\MorphMany
   */
  public function orders()
  {
    return $this->morphMany(static::NAMESPACE_SALES.\Order::class, 'member');
  }

  /**
   * Relation with order
   * @return \Illuminate\Database\Eloquent\Relations\MorphOne
   */
  public function user()
  {
    return $this->morphOne(User::class, 'related');
  }

  /**
   * The booting proses
   * @return void
   */
  protected static function boot()
  {
    parent::boot();
  }


}
