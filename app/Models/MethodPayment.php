<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class MethodPayment extends Model
{
    use HasFactory, LogsActivity;


    protected $table = 'method_payment';

    protected $guarded = [];
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'enabled'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('MethodPayment');
    }

}
