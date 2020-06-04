<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = ['id'];

    public function companyHasManyRecordsInAccessLog()
    {
        return $this->hasMany('App\AccessLog', 'companyId', 'id');
    }
}
