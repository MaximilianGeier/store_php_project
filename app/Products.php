<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $store_id
 * @property string $name
 * @property string $description
 * @property int $count
 * @property float $price
 * @property Store $store
 * @property Category[] $categories
 * @property Complain[] $complains
 * @property Image[] $images
 * @property User[] $users
 */
class Products extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Products';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['store_id', 'name', 'description', 'count', 'price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo('App\Store', 'store_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'Products_categories', 'product_id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function complains()
    {
        return $this->belongsToMany('App\Complain', 'Products_complains', 'product_id', 'complain_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany('App\Image', 'Products_images', 'product_id', 'image_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'Shopping_cart', 'product_id', 'user_id');
    }
}
