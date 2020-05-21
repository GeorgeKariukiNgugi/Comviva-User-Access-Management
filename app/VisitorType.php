<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitorType extends Model
{
    protected $guarded = ['id'];

    public function visitorTypeHasManyVisitorsInLog()
    {
        return $this->hasMany('App\approvedById', 'visitorId', 'id');
    }
}
