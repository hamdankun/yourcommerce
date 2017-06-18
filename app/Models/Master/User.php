<?php

namespace App\Models\Master;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $related_id
 * @property string $related_type
 * @property string $username
 * @property string $status
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $related
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\User whereRelatedId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\User whereRelatedType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\User whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\User whereUsername($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'username', 'email', 'password', 'related_id', 'related_type', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Related with member
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function related()
    {
      return $this->morphTo();
    }
}
