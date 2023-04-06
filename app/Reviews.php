<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property int $rating
 * @property User $user
 * @property Complain[] $complains
 */
class Reviews extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Reviews';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'text', 'rating'];

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
    public function complains()
    {
        return $this->belongsToMany('App\Complain', 'Reviews_complains', 'review_id', 'complaint_id');
    }
}
