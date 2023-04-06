<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $product_id
 * @property int $image_id
 * @property Product $product
 * @property Image $image
 */
class Products_images extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Products_images';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'image_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo('App\Image', 'image_id');
    }
}
