<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $parent_name
 * @property Product[] $products
 */
class Categories extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Categories';

    /**
     * @var array
     */
    protected $fillable = ['name', 'parent_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Product', 'Products_categories', 'category_id', 'product_id');
    }
}
