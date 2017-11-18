<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements BannableContract
{
    use Notifiable;
    use HasRoles;
    use Bannable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leaf::class);
    }

    public function trees()
    {
        return $this->hasMany(Tree::class);
    }

    public function likedTrees()
    {
        return $this->morphedByMany('App\Tree', 'likeable')->whereDeletedAt(null);
    }
}
