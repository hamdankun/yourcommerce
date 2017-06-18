<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * App\Models\Master\Product
 *
 * @property int $id
 * @property int $category_id
 * @property string $sku
 * @property string $name
 * @property bool $is_display
 * @property float $price
 * @property string $description
 * @property int $stock
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Master\Image[] $images
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product createdAtAsc()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product createdAtDesc()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product findBySlug($slug)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product findSimilarSlugs(\Illuminate\Database\Eloquent\Model $model, $attribute, $config, $slug)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product hasAndWithImage()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product hotProduct()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product onDisplay()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product valid()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product visibleColumn()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product whereIsDisplay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product whereSku($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product whereStock($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Master\Category $category
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product isNew()
 * @property int $brand_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Product whereBrandId($value)
 */
class Product extends Model
{
    use Sluggable;

    /**
     * The fillable columns on table
     * @var array
     */
    protected $fillable = ['category_id', 'sku', 'name', 'is_display', 'price', 'description', 'stock', 'slug', 'brand_id'];

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
     * Product Relation With Image
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images() {
      return $this->hasMany(Image::class, 'product_id');
    }

    /**
     * Product relation with category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
      return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Product relation with brand
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
      return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * Scope for product who has flag hot
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeHotProduct($query) {
      return $query->visibleColumn()->isNew()->valid()->orderByRaw('RAND()');
    }

    public function scopeIsNew($query) {
      return $query->addSelect(\DB::raw('
        CASE WHEN DATEDIFF(current_timestamp, created_at) <= 3 THEN true else false end as new
      '));
    }

    /**
     * Scope for product who has images and show images if has
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeHasAndWithImage($query) {
      return $query->has('images')->with(['images' => function($query) {
        $query->orderBy('position', 'asc');
      }]);
    }

    /**
     * Scope for product valid
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeValid($query) {
      return $query->hasAndWithImage()->onDisplay();
    }

    /**
     * Scope for select spesific columns
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeVisibleColumn($query, $addColumns = []) {
      $defaultColumns = ['id', 'slug', 'name', 'price'];
      $columns = array_merge($defaultColumns, $addColumns);
      return $query->select($columns);
    }

    /**
     * Scope for order product base on created at desc
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeCreatedAtDesc($query)
    {
      return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope for order product base on created at asc
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeCreatedAtAsc($query)
    {
      return $query->orderBy('created_at', 'asc');
    }

    /**
     * Show product display only
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeOnDisplay($query)
    {
      return $query->where('is_display', true);
    }

    /**
     * Show product base on slug
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFindBySlug($query, $slug)
    {
      return $query->where('slug', $slug);
    }
}
