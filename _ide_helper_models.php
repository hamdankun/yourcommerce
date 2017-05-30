<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
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
 */
	class User extends \Eloquent {}
}

namespace App\Models\Master{
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
 */
	class Product extends \Eloquent {}
}

namespace App\Models\Master{
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
 */
	class Image extends \Eloquent {}
}

namespace App\Models\Master{
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
	class Category extends \Eloquent {}
}

