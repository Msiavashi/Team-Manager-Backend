<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    public function members()
    {
        return $this->belongsToMany('App\Member', 'team_member', 'team_id', 'member_id');
    }
}
