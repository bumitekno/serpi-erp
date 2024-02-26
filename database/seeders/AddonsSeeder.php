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
                'name' => 'Point of sale',
                'technical_name' => 'Pointofsale',
                'model' => 'pointofsale',
                'info' => ' Point Of Sales, statistic, Inventory, Master Data , Purchase , Sales , Income, Expense  ',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Accounting',
                'technical_name' => 'Accounting',
                'model' => 'account',
                'info' => 'Accounting Management ',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Human Resource',
                'technical_name' => 'Hr',
                'model' => 'hr',
                'info' => 'Human Resource Information System ',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Survey',
                'technical_name' => 'Survey',
                'model' => 'survey',
                'info' => 'Survey Management ',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Assets',
                'technical_name' => 'Assets',
                'model' => 'assets',
                'info' => 'Assets Management ',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Assessment',
                'technical_name' => 'assessment',
                'model' => 'assessment',
                'info' => 'Assessment Management ',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Contact',
                'technical_name' => 'Contact',
                'model' => 'contact',
                'info' => 'Contact Management ',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Project',
                'technical_name' => 'Project',
                'model' => 'project',
                'info' => 'Project Management ',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Manufacture',
                'technical_name' => 'mrp',
                'model' => 'manufacture',
                'info' => 'Manufacturing Orders & BOMs',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];
        DB::table('ir_models')->insert($apps);
    }
}
