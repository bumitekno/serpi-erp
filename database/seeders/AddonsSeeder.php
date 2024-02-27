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
                'info' => 'Manage financial and analytic accounting ',
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
                'info' => 'Send your surveys or share them live',
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
                'info' => 'Centralize your address book',
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
                'info' => 'Organize and plan your projects',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Planning',
                'technical_name' => 'planning',
                'model' => 'planning',
                'info' => 'Manage your employees schedule',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Event',
                'technical_name' => 'event',
                'model' => 'event',
                'info' => 'Publish events, sell tickets',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Appointments',
                'technical_name' => 'appointments',
                'model' => 'appointments',
                'info' => 'Allow people to book meetings in your agenda',
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
            ],
            [
                'name' => 'Todo',
                'technical_name' => 'todo',
                'model' => 'todo',
                'info' => 'Todos',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Skills Management',
                'technical_name' => 'skill_management',
                'model' => 'skill_management',
                'info' => 'Manage skills, knowledge and resume of your employees',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Email Marketing',
                'technical_name' => 'email_marketing',
                'model' => 'email_marketing',
                'info' => 'Design, send and track emails',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Calendar',
                'technical_name' => 'calendar',
                'model' => 'calendar',
                'info' => 'Schedule employees`meetings',
                'state' => 'base',
                'icon' => 'module.svg',
                'instalation' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'CRM',
                'technical_name' => 'crm',
                'model' => 'crm',
                'info' => 'Track leads and close opportunities',
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
