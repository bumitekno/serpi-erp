<?php

namespace Modules\Stock\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Stock\Database\factories\StockOpnameFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Modules\Location\app\Models\Location;
use Modules\ProductPos\app\Models\ProductPos;
use Modules\Warehouse\app\Models\Warehouse;
use Modules\UnitProduct\app\Models\UnitProduct;

class StockOpname extends Model
{
    use HasFactory;

    protected $table = 'stock_opname_trans';

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

    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location', 'id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'id_warehouse', 'id');
    }

    protected static function newFactory(): StockOpnameFactory
    {
        //return StockOpnameFactory::new();
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['date_opname'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('StockOpname');
    }
}
