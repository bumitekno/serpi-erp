<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CardMember extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'card_member';

    protected $guarded = [];
    protected $guard_name = 'web';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['number_card', 'status', 'created_at', 'updated_at', 'id_supplier'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('CardMember');
    }
}
