<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property string $nickname
 * @property string $first_name
 * @property string $last_name
 * @property string $birthday
 * @property string $email
 * @property string $password
 * @property string $image_id
 * @property boolean $is_admin
 * @property boolean $is_seller
 * @property Complain[] $complains
 * @property Image[] $images
 * @property Review[] $reviews
 * @property Product[] $products
 * @property Store[] $stores
 */
class User extends Authenticatable
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'User';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['nickname', 'first_name', 'last_name', 'birthday', 'email', 'password', 'image_id', 'is_admin', 'is_seller'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function complains()
    {
        return $this->hasMany('App\Complain', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\Image', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Review', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Product', 'Shopping_cart', 'user_id', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stores()
    {
        return $this->hasMany('App\Store', 'seller_id');
    }

    public function isAdmin()
    {
        return $this->is_admin === 1;
    }

    public function isSeller()
    {
        return $this->is_seller === 1;
    }
}
