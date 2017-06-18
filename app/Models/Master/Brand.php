<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * App\Models\Master\Brand
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Brand whereAlias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Brand whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Brand whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Brand whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Brand whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Brand findSimilarSlugs(\Illuminate\Database\Eloquent\Model $model, $attribute, $config, $slug)
 */
class Brand extends Model
{
    use Sluggable;

    /**
     * The fillable columns on table
     * @var array
     */
    protected $fillable = ['name', 'alias', 'slug'];

    /**
     * Return the sluggable configuration array for this model.
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Brand relation with product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function products()
    {
      return $this->hasMany(Product::class, 'brand_id');
    }
}
