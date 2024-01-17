<?php

namespace Modules\Stock\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Stock\Database\factories\StockFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Modules\Location\app\Models\Location;
use Modules\ProductPos\app\Models\ProductPos;
use Modules\Warehouse\app\Models\Warehouse;
use Modules\UnitProduct\app\Models\UnitProduct;


class Stock extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'stock';

    protected $guarded = [];
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id_product',
        'id_unit',
        'id_warehouse',
        'id_location',
        'stock_min',
        'stock_last',
        'date_expired',
        'sold_out'
    ];

    public function products()
    {
        return $this->belongsTo(ProductPos::class, 'id_product', 'id');
    }

    public function units()
    {
        return $this->belongsTo(UnitProduct::class, 'id_unit', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location', 'id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'id_warehouse', 'id');
    }

    protected static function newFactory(): StockFactory
    {
        //return StockFactory::new();
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('Stock');
    }
}
