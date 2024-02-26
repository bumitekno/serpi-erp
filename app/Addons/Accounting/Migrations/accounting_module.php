<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Permission::create(['name' => 'account', 'guard_name' => 'web', 'module' => 'account', 'group_modules' => 'accounting']);
        Permission::create(['name' => 'account_type', 'guard_name' => 'web', 'module' => 'account_type', 'group_modules' => 'accounting']);
        Permission::create(['name' => 'account_jurnal', 'guard_name' => 'web', 'module' => 'account_jurnal', 'group_modules' => 'accounting']);

        $roles_superadmin = Role::where(['name' => 'Superadmin', 'guard_name' => 'web'])->first();
        $permissions = Permission::all()->pluck('id')->toArray();
        $roles_superadmin->syncPermissions($permissions);

        $this->mDropColumnIfExists('product_pos', 'income_account');
        $this->mDropColumnIfExists('product_pos', 'expense_account');
        $this->mDropColumnIfExists('product_pos', 'stock_input_account');
        $this->mDropColumnIfExists('product_pos', 'stock_output_account');
        $this->mDropColumnIfExists('product_pos', 'stock_valuation_account');
        $this->mDropColumnIfExists('product_pos', 'stock_journal');


        Schema::table('product_pos', function (Blueprint $table) {
            $table->integer('income_account')->nullable();
            $table->integer('expense_account')->nullable();
            $table->integer('stock_input_account')->nullable();
            $table->integer('stock_output_account')->nullable();
            $table->integer('stock_valuation_account')->nullable();
            $table->integer('stock_journal')->nullable();
        });

        Schema::create('account_account_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->boolean('include_initial_balance')->nullable();
            $table->string('type')->nullable();
            $table->string('internal_group')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('account_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('currency_id')->index()->nullable();
            $table->string('code')->nullable();
            $table->boolean('deprecated')->nullable();
            $table->integer('type')->index()->nullable();
            $table->string('internal_type')->nullable();
            $table->string('internal_group')->nullable();
            $table->boolean('reconcile')->nullable();
            $table->string('note')->nullable();
            $table->integer('company_id')->index()->nullable();
            $table->integer('root_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('account_journals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->boolean('active')->nullable();
            $table->string('type')->nullable();
            $table->integer('default_credit_account_id')->index()->nullable();
            $table->integer('default_debit_account_id')->index()->nullable();
            $table->boolean('restrict_mode_hash_table')->nullable();
            $table->integer('sequence_id')->index()->nullable();
            $table->integer('refund_sequence_id')->index()->nullable();
            $table->string('invoice_reference_type')->nullable();
            $table->string('invoice_reference_model')->nullable();
            $table->integer('currency_id')->index()->nullable();
            $table->integer('company_id')->index()->nullable();
            $table->boolean('refund_sequence')->nullable();
            $table->boolean('at_least_one_inbound')->nullable();
            $table->boolean('at_least_one_outbound')->nullable();
            $table->integer('profit_account_id')->index()->nullable();
            $table->integer('loss_account_id')->index()->nullable();
            $table->integer('bank_account_id')->index()->nullable();
            $table->string('bank_statements_source')->nullable();
            $table->string('post_at')->nullable();
            $table->integer('alias_id')->index()->nullable();
            $table->integer('secure_sequence_id')->index()->nullable();
            $table->integer('show_on_dashboard')->index()->nullable();
            $table->integer('account_type_allowed')->index()->nullable();
            $table->integer('account_allowed')->index()->nullable();
            $table->integer('bank')->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    function mDropColumnIfExists($myTable, $column)
    {
        if (Schema::hasColumn($myTable, $column)) //check the column
        {
            Schema::table($myTable, function (Blueprint $table) use ($column) {
                $table->dropColumn($column); //drop it
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Permission::where('group_modules', 'accounting')->delete();

        Schema::dropIfExists('account_account_type');
        Schema::dropIfExists('account_accounts');
        Schema::dropIfExists('account_journals');

        $this->mDropColumnIfExists('product_pos', 'income_account');
        $this->mDropColumnIfExists('product_pos', 'expense_account');
        $this->mDropColumnIfExists('product_pos', 'stock_input_account');
        $this->mDropColumnIfExists('product_pos', 'stock_output_account');
        $this->mDropColumnIfExists('product_pos', 'stock_valuation_account');
        $this->mDropColumnIfExists('product_pos', 'stock_journal');
    }


};
