<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SettingApp extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'setting_app';

    protected $guarded = [];
    protected $guard_name = 'web';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['logo', 'title', 'description', 'keyword'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('SettingApps');
    }
}
