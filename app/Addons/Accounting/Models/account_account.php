<?php

namespace App\Addons\Accounting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class account_account extends Model
{
    use softDeletes, LogsActivity;

    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'currency_id',
        'code',
        'deprecated ',
        'type',
        'internal_type',
        'internal_group',
        'reconcile',
        'note',
        'company_id',
        'root_id'
    ];
    public function company()
    {
        return $this->hasOne('App\Addons\Accounting\Models\res_company', 'id', 'company_id');
    }

    public function account_type()
    {
        return $this->hasOne(account_account_type::class, 'id', 'type');
    }
    public function move_lines()
    {
        return $this->hasMany(account_move_line::class, 'account_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['code', 'name'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('AccountingAccount');
    }
}
