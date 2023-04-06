<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $ordered_count
 * @property string $created_at
 * @property string $address
 * @property User $user
 * @property Product $product
 */
class Orders extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Orders';
    const UPDATED_AT = null;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'product_id', 'ordered_count', 'created_at', 'address'];

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
