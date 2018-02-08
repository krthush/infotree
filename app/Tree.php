<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tree extends Model
{
    protected $fillable = ['title','user_id','university','shared','favourite','likes','description','global'];

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

    // parents
    public function parent()
    {
       return $this->belongsTo('App\Tree','parent_id');
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
