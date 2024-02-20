<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class TransCardMember extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'transaction_card_member';

    protected $guarded = [];
    protected $guard_name = 'web';


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id_member', 'nominal', 'type', 'date_trans'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('TransCardMember');
    }
}
