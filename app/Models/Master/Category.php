<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * App\Models\Master\Category
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $parent_id
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Master\Category[] $child
 * @property-read \App\Models\Master\Category $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Master\Product[] $products
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Category findBySlug($slug)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Category findSimilarSlugs(\Illuminate\Database\Eloquent\Model $model, $attribute, $config, $slug)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Category main()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Category whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Category whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Category whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Master\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use Sluggable;

    /**
     * The fillable columns on table
     * @var array
     */
    protected $fillable = ['code', 'name', 'parent_id', 'slug'];

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
    * Get child by random
    * @return \Illuminate\Database\Query\Builder
    */
   public function randomChild()
   {
     return $this->child()->orderByRaw('RAND()');
   }

    /**
     * Get main category
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeMain($query) {
      return $query->where('parent_id', 0);
    }

    /**
     * Find category by slug
     * @param  \Illuminate\Database\Query\Builder $query
     * @param  string $slug
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeFindBySlug($query, $slug)
    {
      return $query->where('slug', $slug);
    }

    /**
     * Relation with self {child}
     * @return \Illuminate\Database\Relations\Eloquent\HasMany
     */
    public function child()
    {
      return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Relation with self {parent}
     * @return \Illuminate\Database\Relations\Eloquent\BelongsTo
     */
    public function parent()
    {
      return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Relation with products
     * @return \Illuminate\Database\Relations\Eloquent\HasMany
     */
    public function products()
    {
      return $this->HasMany(Product::class, 'category_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
      parent::boot();
      static::created(function($model) {
        $model->code = str_pad($model->id, 5, '0', STR_PAD_LEFT);
        $model->save();
      });
    }
}
