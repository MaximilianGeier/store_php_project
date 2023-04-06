<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $product_id
 * @property int $category_id
 * @property Product $product
 * @property Category $category
 */
class Products_categories extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Products_categories';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'category_id'];

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
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
