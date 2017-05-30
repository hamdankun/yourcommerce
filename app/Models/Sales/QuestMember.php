<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sales\GuestMember
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $company
 * @property string $company_shipping
 * @property string $telephone
 * @property string $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\GuestMember whereCompany($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\GuestMember whereCompanyShipping($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\GuestMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\GuestMember whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\GuestMember whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\GuestMember whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\GuestMember whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\GuestMember whereTelephone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sales\GuestMember whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sales\Order[] $orders
 */
class GuestMember extends Model
{
  /**
   * The fillable columns
   * @var array
   */
    protected $fillable = ['first_name', 'last_name', 'company', 'company_shipping', 'telephone', 'email'];

    /**
     * Relation with orders
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function orders()
    {
      return $this->morphMany(Order::class, 'member');
    }
}
