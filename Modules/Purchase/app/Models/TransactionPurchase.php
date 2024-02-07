<?php

namespace Modules\Purchase\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Purchase\Database\factories\TransactionPurchaseFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\Supplier;
use App\Models\Departement;
use App\Models\MethodPayment;
use App\Models\User;

class TransactionPurchase extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'transaction_purchase';

    protected $guarded = [];
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code_transaction',
        'date_purchase',
        'time_purchase',
        'status',
        'date_due',
        'amount',
        'tax_amount',
        'tax_percent',
        'discount_persent',
        'discount_amount',
        'id_supplier',
        'id_departement',
        'id_user',
        'id_method_payment',
        'note',
        'adjustment_amount',
        'file_doc',
        'transfer_stock'
    ];

    public function operator()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id');
    }

    public function methodpayment()
    {
        return $this->belongsTo(MethodPayment::class, 'id_method_payment', 'id');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement', 'id');
    }

    protected static function newFactory(): TransactionPurchaseFactory
    {
        //return TransactionPurchaseFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['code_transaction'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('TransactionPurchase');
    }
}
