<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Leaf extends Model
{
    use Searchable;

    protected $fillable = ['title','user_id','parent_id','tree_id','link','type'];

    /**
     * Get the index name for the model.
     *
     * @return string
    */

    public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function branch()
	{
		return $this->belongsTo(Branch::class);
	}

    public function tree()
    {
        return $this->belongsTo(Profile::class);
    }
    public function searchableAs()
    {
        return 'leaves_index';
    }
}
