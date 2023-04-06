<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $image_id
 * @property int $seller_id
 * @property string $name
 * @property Image $image
 * @property User $user
 * @property Product[] $products
 */
class Stores extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Stores';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['image_id', 'seller_id', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo('App\Image', 'image_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'seller_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product', 'store_id');
    }
}
