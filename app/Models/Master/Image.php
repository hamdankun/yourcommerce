<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Master\Image
 *
 * @property int $id
 * @property int $product_id
 * @property string $path
 * @property string $type
 * @property int $position
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Image whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Image wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Image wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Image whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Image whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Image whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Master\Product[] $products
 */
class Image extends Model
{
    /**
     * The fillable columns on table
     * @var array
     */
    protected $fillable = ['product_id', 'path', 'type', 'position'];

    /**
     * Relation with product
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
      return $this->hasMany(Product::class, 'product_id');
    }
}
