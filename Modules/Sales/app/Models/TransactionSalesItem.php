<?php

namespace Modules\Sales\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sales\Database\factories\TransactionSalesItemFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class TransactionSalesItem extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'transaction_item_sales';

    protected $guarded = [];
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): TransactionSalesItemFactory
    {
        //return TransactionSalesItemFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['code_transaction'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('TransactionPurchase');
    }
}
