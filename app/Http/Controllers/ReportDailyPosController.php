<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Purchase\app\Models\TransactionPurchase;
use Modules\Sales\app\Models\TransactionSales;
use Modules\Sales\app\Models\BalanceSales;
use Modules\Expense\app\Models\TransactionExpense;
use Modules\Income\app\Models\TransactionIncome;
use Carbon\Carbon;
use App\Models\Departement;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportDaily;

class ReportDailyPosController extends Controller
{

    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
        $this->middleware('permission:report-daily-pos', ['only' => ['index']]);
    }

    //show index report
    public function index(Request $request)
    {

        if (!empty($request->get('from')) && !empty($request->get('to'))) {
            $startdate = Carbon::createFromFormat('Y-m-d', $request->get('from'))->format('Y-m-d');
            $enddate = Carbon::createFromFormat('Y-m-d', $request->get('to'))->format('Y-m-d');
        } else {
            $startdate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $enddate = Carbon::now()->endOfMonth()->format('Y-m-d');
        }

        if (!empty($request->get('departement'))) {

            if ($request->get('departement') == 'all') {
                //saldo awal bulan 
                $saldo_awal = BalanceSales::whereBetween('date_balance', [$startdate, $enddate])->sum('amount');
                $income = TransactionIncome::whereBetween('date_transaction', [$startdate, $enddate])->sum('amount');
                $expense = TransactionExpense::whereBetween('date_transaction', [$startdate, $enddate])->sum('amount');
                $sum_transaction_purchase_success_today = TransactionPurchase::where('status', '=', '1')->whereBetween('date_purchase', [$startdate, $enddate])->sum('amount');
                $sum_transaction_sales_success_today = TransactionSales::where('saved_trans', '=', '0')->where('status', '=', '1')->whereBetween('date_sales', [$startdate, $enddate])->sum('total_transaction');
            } else {
                //saldo awal bulan 
                $saldo_awal = BalanceSales::whereBetween('date_balance', [$startdate, $enddate])->where('id_departement', $request->get('departement'))->sum('amount');
                $income = TransactionIncome::whereBetween('date_transaction', [$startdate, $enddate])->where('id_departement', $request->get('departement'))->sum('amount');
                $expense = TransactionExpense::whereBetween('date_transaction', [$startdate, $enddate])->where('id_departement', $request->get('departement'))->sum('amount');
                $sum_transaction_purchase_success_today = TransactionPurchase::where('status', '=', '1')->whereBetween('date_purchase', [$startdate, $enddate])->where('id_departement', $request->get('departement'))->sum('amount');
                $sum_transaction_sales_success_today = TransactionSales::where('saved_trans', '=', '0')->where('status', '=', '1')->whereBetween('date_sales', [$startdate, $enddate])->where('id_departement', $request->get('departement'))->sum('total_transaction');
            }
        } else {
            //saldo awal bulan 
            $saldo_awal = 0;
            $income = 0;
            $expense = 0;
            $sum_transaction_purchase_success_today = 0;
            $sum_transaction_sales_success_today = 0;
        }

        $departement = Departement::query()->get();
        $departement_default = empty(Session::get('departement')) ? Departement::first()?->id : Session::get('departement');

        return view('reportdaily')->with([
            'open_balance' => empty($saldo_awal) ? 0 : number_format($saldo_awal, 0, ',', '.'),
            'daily_income' => empty($income) ? 0 : number_format($income, 0, ',', '.'),
            'daily_expense' => empty($expense) ? 0 : number_format($expense, 0, ',', '.'),
            'daily_sales' => empty($sum_transaction_sales_success_today) ? 0 : number_format($sum_transaction_sales_success_today, 0, ',', '.'),
            'daily_purchase' => empty($sum_transaction_purchase_success_today) ? 0 : number_format($sum_transaction_purchase_success_today, 0, ',', '.'),
            'close_balance' => number_format($saldo_awal + $income + $sum_transaction_sales_success_today - $sum_transaction_purchase_success_today - $expense, 0, ',', '.'),
            'list_departement' => $departement,
            'departement_default' => $departement_default,
            'startdate' => $startdate,
            'enddate' => $enddate
        ]);
    }

    /** export excel */
    public function downloadreportD(Request $request)
    {
        if (!empty($request->get('from')) && !empty($request->get('to'))) {
            $startdate = Carbon::createFromFormat('Y-m-d', $request->get('from'))->format('Y-m-d');
            $enddate = Carbon::createFromFormat('Y-m-d', $request->get('to'))->format('Y-m-d');
        } else {
            $startdate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $enddate = Carbon::now()->endOfMonth()->format('Y-m-d');
        }

        if (!empty($request->get('departement'))) {

            if ($request->get('departement') == 'all') {
                $departement_default = 'all';
                //saldo awal bulan 
                $saldo_awal = BalanceSales::whereBetween('date_balance', [$startdate, $enddate])->sum('amount');
                $income = TransactionIncome::whereBetween('date_transaction', [$startdate, $enddate])->sum('amount');
                $expense = TransactionExpense::whereBetween('date_transaction', [$startdate, $enddate])->sum('amount');
                $sum_transaction_purchase_success_today = TransactionPurchase::where('status', '=', '1')->whereBetween('date_purchase', [$startdate, $enddate])->sum('amount');
                $sum_transaction_sales_success_today = TransactionSales::where('saved_trans', '=', '0')->where('status', '=', '1')->whereBetween('date_sales', [$startdate, $enddate])->sum('total_transaction');
            } else {
                //saldo awal bulan 
                $saldo_awal = BalanceSales::whereBetween('date_balance', [$startdate, $enddate])->where('id_departement', $request->get('departement'))->sum('amount');
                $income = TransactionIncome::whereBetween('date_transaction', [$startdate, $enddate])->where('id_departement', $request->get('departement'))->sum('amount');
                $expense = TransactionExpense::whereBetween('date_transaction', [$startdate, $enddate])->where('id_departement', $request->get('departement'))->sum('amount');
                $sum_transaction_purchase_success_today = TransactionPurchase::where('status', '=', '1')->whereBetween('date_purchase', [$startdate, $enddate])->where('id_departement', $request->get('departement'))->sum('amount');
                $sum_transaction_sales_success_today = TransactionSales::where('saved_trans', '=', '0')->where('status', '=', '1')->whereBetween('date_sales', [$startdate, $enddate])->where('id_departement', $request->get('departement'))->sum('total_transaction');
                $departement_default = empty(Session::get('departement')) ? Departement::first()?->name : Session::get('departement');
            }
        } else {
            //saldo awal bulan 
            $saldo_awal = 0;
            $income = 0;
            $expense = 0;
            $sum_transaction_purchase_success_today = 0;
            $sum_transaction_sales_success_today = 0;
        }

        $report = [
            'open_balance' => empty($saldo_awal) ? 0 : number_format($saldo_awal, 0, '.', ','),
            'daily_income' => empty($income) ? 0 : number_format($income, 0, '.', ','),
            'daily_expense' => empty($expense) ? 0 : number_format($expense, 0, '.', ','),
            'daily_sales' => empty($sum_transaction_sales_success_today) ? 0 : number_format($sum_transaction_sales_success_today, 0, '.', ','),
            'daily_purchase' => empty($sum_transaction_purchase_success_today) ? 0 : number_format($sum_transaction_purchase_success_today, 0, '.', ','),
            'close_balance' => number_format($saldo_awal + $income + $sum_transaction_sales_success_today - $sum_transaction_purchase_success_today - $expense, 0, '.', ','),
            'departement_default' => $departement_default,
            'startdate' => $startdate,
            'enddate' => $enddate
        ];
        return Excel::download(new ReportDaily($report), 'report_daily_pos.xls');
    }

}
