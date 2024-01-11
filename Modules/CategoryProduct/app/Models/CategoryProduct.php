<?php

namespace Modules\CategoryProduct\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\CategoryProduct\Database\factories\CategoryProductFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CategoryProduct extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'category_product';

    protected $guarded = [];
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'image_category'
    ];

    protected static function newFactory(): CategoryProductFactory
    {
        //return CategoryProductFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('CategoryProduct');
    }
}
