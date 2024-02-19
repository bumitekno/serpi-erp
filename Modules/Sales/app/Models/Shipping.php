<?php

namespace Modules\Sales\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sales\Database\factories\ShippingFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Modules\Sales\app\Models\TransactionSales;

class Shipping extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'shipping';

    protected $guarded = [];
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): ShippingFactory
    {
        //return ShippingFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id_transaction', 'type_transaction', 'phone'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('Shipping');
    }

    public function sales()
    {
        return $this->belongsTo(TransactionSales::class, 'id_transaction', 'id');
    }
}
