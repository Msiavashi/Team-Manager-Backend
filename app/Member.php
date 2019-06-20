<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // protected $fillable = [
    //     'name'
    // ];

    public function teams()
    {
        return $this->belongsToMany('App\Team', 'team_member', 'member_id', 'team_id');
    }
}
