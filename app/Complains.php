<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property User $user
 * @property Product[] $products
 * @property Review[] $reviews
 */
class Complains extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Complains';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'text'];

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
        return $this->belongsToMany('App\Product', 'Products_complains', 'complain_id', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reviews()
    {
        return $this->belongsToMany('App\Review', 'Reviews_complains', 'complaint_id', 'review_id');
    }
}
