<?php
namespace App\Helpers;

use App\Models\Apps\ir_model;

class Addons
{
    public static function cek_install_modules($technical)
    {
        $apps = ir_model::where('technical_name', $technical)->first();
        return $apps->instalation;
    }
}