<?php

namespace Modules\Purchase\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Purchase\Database\factories\PurchaseCreditFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PurchaseCredit extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'transaction_purchase_credit';

    protected $guarded = [];
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): PurchaseCreditFactory
    {
        //return PurchaseCreditFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id_transaction_purchase', 'date_credit'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('TransactionSalesCredit');
    }
}
