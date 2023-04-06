<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $path
 * @property User $user
 * @property Product[] $products
 * @property Store[] $stores
 */
class Images extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Images';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'path'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Product', 'Products_images', 'image_id', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stores()
    {
        return $this->hasMany('App\Store', 'image_id');
    }
}
