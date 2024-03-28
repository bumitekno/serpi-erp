<?php

namespace App\Addons\Accounting\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Addons\Accounting\Models\account_account;
use App\Addons\Accounting\Models\account_payment;
use App\Addons\Accounting\Models\account_move;
use App\Addons\Accounting\Models\account_move_line;
use App\Addons\Accounting\Models\account_journal;
use App\Addons\Accounting\Models\res_customer;
use App\Addons\Accounting\Models\res_partner;
use App\Addons\Accounting\Models\res_company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountMovesController extends Controller
{

    public function payment($id)
    {
        try {
            $payment = account_payment::find($id);
            $journal = account_journal::find($payment->journal_id);
            $payment_account = account_account::where('code', $journal->default_debit_account_id)->first();
            if ($payment->partner_type == "customer") {
                $partner = res_customer::find($payment->partner_id);
                $name = $partner->name;
                $type = "Customer Payment";
                $debit = $payment->amount;
                $credit = 0;
                $balance = $payment->amount - 0;
                $debit1 = 0;
                $credit1 = $payment->amount;
                $balance1 = 0 - $payment->amount;
            } else {
                $partner = res_partner::find($payment->partner_id);
                $name = $partner->partner_name;
                $type = "Vendor Payment";
                $debit = 0;
                $credit = $payment->amount;
                $balance = 0 - $payment->amount;
                $debit1 = $payment->amount;
                $credit1 = 0;
                $balance1 = $payment->amount - 0;
            }
            $account = account_account::find($partner->receivable_account);
            if (!empty($account)) {
                $account_move = account_move::insertGetId([
                    'name' => $payment->name,
                    'date' => date('Y-m-d H:i:s'),
                    'state' => 'Posted',
                    'type' => 'entry',
                    'journal_id' => $payment->journal_id,
                    'company_id' => $partner->company_id,
                    'currency_id' => $partner->currency_id,
                    'partner_id' => $payment->partner_id,
                    'amount_untaxed' => 0,
                    'amount_tax' => 0,
                    'amount_total' => $payment->amount,
                    'amount_residual' => 0,
                    'amount_untaxed_signed' => 0,
                    'amount_tax_signed' => 0,
                    'amount_total_signed' => 0,
                    'amount_residual_signed' => $payment->amount,
                    'fiscal_position_id' => 0,
                    'invoice_partner_display_name' => $name,
                    'create_uid' => Auth::id(),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                account_move_line::create([
                    'account_move_id' => $account_move,
                    'account_move_name' => $payment->name,
                    'date' => date('Y-m-d H:i:s'),
                    'parent_state' => "Posted",
                    'journal_id' => $payment->journal_id,
                    'company_id' => $partner->company_id,
                    'company_currency_id' => res_company::where('id', $partner->company_id)->first()?->currency_id,
                    'account_id' => $partner->receivable_account,
                    'account_internal_type' => $account->internal_type,
                    'name' => $type,
                    'quantity' => 1,
                    'price_unit' => "0",
                    'price_total' => "0",
                    'debit' => $debit1,
                    'credit' => $credit1,
                    'balance' => $balance1,
                    'currency_id' => $partner->currency_id,
                    'partner_id' => $payment->partner_id,
                    'payment_id' => $id,
                    'create_uid' => Auth::id(),
                ]);
                account_move_line::create([
                    'account_move_id' => $account_move,
                    'account_move_name' => $payment->name,
                    'date' => date('Y-m-d H:i:s'),
                    'parent_state' => "Posted",
                    'journal_id' => $payment->journal_id,
                    'company_id' => $partner->company_id,
                    'company_currency_id' => res_company::where('id', $partner->company_id)->first()?->currency_id,
                    'account_id' => $payment_account->id,
                    'account_internal_type' => $payment_account->internal_type,
                    'name' => $payment->name,
                    'quantity' => 1,
                    'price_unit' => "0",
                    'price_total' => "0",
                    'debit' => $debit,
                    'credit' => $credit,
                    'balance' => $balance,
                    'currency_id' => $partner->currency_id,
                    'partner_id' => $payment->partner_id,
                    'payment_id' => $id,
                    'create_uid' => Auth::id(),
                ]);
            }

            Session::flash('success', 'Confirm Payment Successfully');
            return redirect(route('account.payment.view', $id));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back();
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
