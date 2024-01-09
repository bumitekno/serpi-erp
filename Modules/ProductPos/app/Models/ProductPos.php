<?php

namespace Modules\ProductPos\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ProductPos\Database\factories\ProductPosFactory;
use Spatie\Activitylog\LogOptions;

class ProductPos extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code_product',
        'name',
        'description',
        'category',
        'avatar',
        'price_sell',
        'price_purchase',
        'stock_qty',
    ];

    protected static function newFactory(): ProductPosFactory
    {
        //return ProductPosFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['code_product', 'name'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('Product');
    }
}
