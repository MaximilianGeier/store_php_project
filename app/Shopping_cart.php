<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $ordered_count
 * @property User $user
 * @property Product $product
 */
class Shopping_cart extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Shopping_cart';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'product_id', 'ordered_count'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
