<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyEmployee extends Model
{

    protected $guarded = ['id'];

    //! adding the relationship to the Company. 
    public function companyEmployeeBelongsToCompany()
    {
        return $this->belongsTo('App\Company', 'companyId', 'id');
    }
}
