<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['title','user_id','parent_id','tree_id','parent_orig_id','facts','shared'];

    /**
     * Get the index name for the model.
     *
     * @return string
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tree()
    {
        return $this->belongsTo(Tree::class);
    }

    public function childs() 
    {
        return $this->hasMany('App\Branch','parent_id') ;
    }

    // Each branch may have a parent
    public function parent() {
        return $this->belongsTo('App\Branch','parent_id');
    }

    public function leaves()
    {
        return $this->hasMany('App\Leaf','parent_id');
    }

}

