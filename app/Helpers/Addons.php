<?php
namespace App\Helpers;

use App\Models\Apps\ir_model;

class Addons
{
    /**
     * This PHP function checks if a specific module is installed and returns its installation status.
     * 
     * @param `technical The `cek_install_modules` function appears to be a static method that takes a
     * parameter named ``. This function retrieves a record from the `ir_model` table where
     * the `technical_name` column matches the provided `` value and then returns the value of
     * the `instalation` column
     * 
     * @return `The function `cek_install_modules` is returning the value of the `instalation` property
     * of the `ir_model` object where the `technical_name` matches the input parameter ``.
     */
    public static function cek_install_modules($technical)
    {
        $apps = ir_model::where('technical_name', $technical)->first();
        return $apps->instalation;
    }
}