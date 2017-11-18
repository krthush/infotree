<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;

    protected $table = 'likeables';

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

    /**
     * Get all of the trees that are assigned this like.
     */
    public function trees()
    {
    	//N.B. did not see "morphedByMany" in laravel 5.5 docs, maybe changed to "morphMany"
        return $this->morphedByMany('App\Tree', 'likeable');
    }


}
