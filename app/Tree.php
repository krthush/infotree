<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tree extends Model
{
    protected $fillable = ['title','user_id','university','shared','favourite','likes','description','global','parent_id'];

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

    // Each tree may have multiple children
    public function childs() 
    {
        return $this->hasMany('App\Tree','parent_id') ;
    }

    // Each tree may have one parent
    public function parent() {
        return $this->belongsTo('App\Tree','parent_id');
    }

    // function that gets all parents as collection of models (use "$tree->parents")
    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while(!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
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
