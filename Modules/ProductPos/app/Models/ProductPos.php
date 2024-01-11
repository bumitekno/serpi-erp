<?php

namespace Modules\ProductPos\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ProductPos\Database\factories\ProductPosFactory;
use Modules\CategoryProduct\app\Models\CategoryProduct;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductPos extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'product_pos';

    protected $guarded = [];
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'code_product',
        'name',
        'description',
        'category',
        'image_product',
        'price_sell',
        'price_purchase',
        'stock_qty',
    ];

    /** with category */

    public function category_product()
    {
        return $this->belongsTo(CategoryProduct::class, 'category', 'id');
    }

    protected static function newFactory(): ProductPosFactory
    {
        //return ProductPosFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['code_product', 'name'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('ProductPos');
    }
}
