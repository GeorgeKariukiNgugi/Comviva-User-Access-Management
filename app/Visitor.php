<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $guarded = ['id'];

    public function vivitorsHasManyAccessLog()
    {
        return $this->hasMany('App\AccessLog', 'visitorId', 'id');
    }
}
