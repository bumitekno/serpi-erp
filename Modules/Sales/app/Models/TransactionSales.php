<?php

namespace Modules\Sales\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sales\Database\factories\TransactionSalesFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\Customer;
use App\Models\User;
use App\Models\Departement;
use App\Models\MethodPayment;

class TransactionSales extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'transaction_sales';

    protected $guarded = [];
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code_transaction',
        'date_sales',
        'time_sales',
        'status',
        'date_due',
        'amount',
        'tax_amount',
        'tax_percent',
        'discount_persent',
        'discount_amount',
        'id_customer',
        'id_departement',
        'id_user',
        'id_method_payment',
        'note',
        'adjustment_amount',
        'total_transaction',
        'saved_trans',
        'file',
        'fee_shipping'
    ];

    public function operator()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }

    public function methodpayment()
    {
        return $this->belongsTo(MethodPayment::class, 'id_method_payment', 'id');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement', 'id');
    }

    protected static function newFactory(): TransactionSalesFactory
    {
        //return TransactionSalesFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['code_transaction'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('TransactionSales');
    }
}
