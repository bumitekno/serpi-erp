<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $apps = [
            [
                'name' => 'Accounting',
                'technical_name' => 'Accounting',
                'model' => 'accounting',
                'info' => 'Accounting Management ',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Human Resource',
                'technical_name' => 'hr',
                'model' => 'human_resources',
                'info' => 'Human Resource Information System ',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Survey',
                'technical_name' => 'survey',
                'model' => 'survey',
                'info' => 'Survey Management ',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        DB::table('ir_models')->insert($apps);
    }
}
