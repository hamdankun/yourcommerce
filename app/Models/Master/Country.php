<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Master\Country
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Country whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Country whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Country whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Country whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Master\MemberAddress[] $addresses
 */
class Country extends Model
{
    /**
     * The fillable columns
     * @var array
     */
    protected $fillable = ['code', 'name'];

    /**
     * Relation With address member
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
      return $this->hasMany(MemberAddress::class, 'country_id');
    }
}
