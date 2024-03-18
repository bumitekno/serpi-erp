<?php

namespace App\Addons\Accounting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class res_company extends Model
{
    use HasFactory;

    protected $table = 'res_companies';
    protected $fill = [];
}
