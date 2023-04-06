<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $review_id
 * @property int $complaint_id
 * @property Review $review
 * @property Complain $complain
 */
class Reviews_complains extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Reviews_complains';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['review_id', 'complaint_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function review()
    {
        return $this->belongsTo('App\Review', 'review_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complain()
    {
        return $this->belongsTo('App\Complain', 'complaint_id');
    }
}
