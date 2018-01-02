<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tree extends Model
{
    protected $fillable = ['title','user_id','university','shared','favourite','likes','description'];

    /**
     * Get the index name for the model.
     *
     * @return string
    */

    public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

	public function leaves()
    {
        return $this->hasMany(Leaf::class);
    }

    public function likes()
    {
        return $this->morphToMany('App\User', 'likeable')->whereDeletedAt(null);
    }

    public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }

}
