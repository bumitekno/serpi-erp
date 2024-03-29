<?php

namespace App\Addons\Accounting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class account_journal extends Model
{
    use softDeletes, LogsActivity;

    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'code',
        'active',
        'type',
        'default_credit_account_id',
        'default_debit_account_id',
        'restrict_mode_hash_table',
        'sequence_id',
        'refund_sequence_id',
        'invoice_reference_type',
        'invoice_reference_model',
        'currency_id',
        'company_id',
        'refund_sequence',
        'at_least_one_inbound',
        'at_least_one_outbound',
        'profit_account_id',
        'loss_account_id',
        'bank_account_id',
        'bank_statements_source',
        'post_at',
        'alias_id',
        'secure_sequence_id',
        'show_on_dashboard',
        'account_type_allowed',
        'account_allowed',
        'bank'
    ];
    public function company()
    {
        return $this->hasOne('App\Addons\Accounting\Models\res_company', 'id', 'company_id');
    }
    public function currency()
    {
        return $this->hasOne('App\Addons\Accounting\Models\res_currency', 'id', 'currency_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['code', 'name'])
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('AccountingJournal');
    }
}
