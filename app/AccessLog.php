<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $guarded = ['id'];

    public function accessLogBelongsToVisitor()
    {
        return $this->belongsTo('App\Visitor', 'visitorId', 'id');
    }

    public function accessLogBelongsToAtypeOfVisitor()
    {
        return $this->belongsTo('App\VisitorType', 'typeOfVisitorId', 'id');
    }

    public function accessLogBelongsToCompany()
    {
        return $this->belongsTo('App\Company', 'companyId', 'id');
    }

    public function accessLogHasOneApprover()
    {
        return $this->hasOne('App\User', 'id', 'approvedById');
    }
    public function accessLogHasOneCheckOutApprover()
    {
        return $this->hasOne('App\User', 'id', 'checkedOutById');
    }  
    public function visitorBelongsToCompanyAttache()
    {
        return $this->belongsTo('App\CompanyEmployee', 'employeeAttachedToId', 'id');
    }  
}
