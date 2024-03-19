Serpi PT.Bumi Tekno Indonesia (Development)

Serpi merupakan kumpulan layanan ERP yang dibangun untuk memenuhi kebutuhan Teknologi dalam mengelola sumber daya Manusia , Keuangan , Penjualan , Pembelian , Assegment dan lain - lain

Utility commands create new Module
module:make
Generate a new module.
php artisan module:make Blog

Use this command on the root folder:

create the only Migration file:

php artisan make:migration create_products_table --create=products
Create Migration, Model file:

php artisan make:model Product -m
For Create Migration,Model,Controller file:

php artisan make:model Product -mcr
If you want to do it manually then you may set --path as per your folder requirement.

php artisan make:migration filename --path=/app/database/migrations/relations
php artisan make:migration filename --path=/app/database/migrations/translations
If you want to migrate then:

php artisan migrate --path="/app/database/migrations/relations"

refrensi : https://laravelmodules.com/docs/v10/artisan-commands

Plugin Addons Module Custome 1. Place Folder Addons 2. create name folder assign with structure folder - NameAddons : - Controllers - Helpers - Illuminate - Migrations - Models - Routes - Seeders - Views

Contributor Developer

Mucharom
Fullstack Developer
