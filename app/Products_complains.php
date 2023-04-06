<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $product_id
 * @property int $complain_id
 * @property Product $product
 * @property Complain $complain
 */
class Products_complains extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Products_complains';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'complain_id'];

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
    public function complain()
    {
        return $this->belongsTo('App\Complain', 'complain_id');
    }
}
