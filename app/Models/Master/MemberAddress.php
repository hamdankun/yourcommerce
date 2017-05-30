<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Master\MemberAddress
 *
 * @property int $id
 * @property int $member_id
 * @property string $member_type
 * @property string $city
 * @property string $country_id
 * @property string $zip
 * @property string $address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\MemberAddress whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\MemberAddress whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\MemberAddress whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\MemberAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\MemberAddress whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\MemberAddress whereMemberId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\MemberAddress whereMemberType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\MemberAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\MemberAddress whereZip($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $member
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sales\Order[] $orders
 * @property-read \App\Models\Master\Country $country
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\MemberAddress whereCountryId($value)
 */
class MemberAddress extends Model
{
    /**
     * The fillable columns
     * @var array
     */
    protected $fillable = ['member_id', 'member_type', 'city', 'country_id', 'zip', 'address'];

    /**
     * Relation with member
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function member()
    {
      return $this->morphTo();
    }

    /**
     * Relation with orders
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function orders()
    {
      return $this->hasMany(\App\Models\Sales\Order::class, 'address_id');
    }

    /**
     * Relation With country
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
      return $this->belongsTo(Country::class, 'country_id');
    }
}
