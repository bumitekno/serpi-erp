<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SettingApp;

class SettingAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SettingApp::updateOrCreate([
            'title' => 'Service Enterprice Resource Planning Indonesia',
            'description' => 'Service Enterprice Resource Planning Indonesia From PT.Bumi Tekno Indonesia',
            'keywords' => 'ERP Indonesia',
            'footer' => 'PT. Bumi Tekno Indonesia '
        ]);
    }
}
