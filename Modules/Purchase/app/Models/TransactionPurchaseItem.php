<?php

namespace Modules\Purchase\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Purchase\Database\factories\TransactionPurchaseItemFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Modules\ProductPos\app\Models\ProductPos;
use Modules\UnitProduct\app\Models\UnitProduct;

class TransactionPurchaseItem extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'transaction_item_purchase';

    protected $guarded = [];
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    public function products()
    {
        return $this->belongsTo(ProductPos::class, 'id_product', 'id');
    }

    public function units()
    {
        return $this->belongsTo(UnitProduct::class, 'id_unit', 'id');
    }

    protected static function newFactory(): TransactionPurchaseItemFactory
    {
        //return TransactionPurchaseItemFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['code_transaction'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('TransactionPurchase');
    }

}
