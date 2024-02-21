<?php

namespace Modules\Purchase\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\ProductPos\app\Models\ProductPos;
use Modules\Purchase\app\Models\TransactionPurchase;
use Modules\Purchase\app\Models\TransactionPurchaseItem;
use Modules\Purchase\app\Models\PurchaseCredit;
use App\Models\MethodPayment;
use App\Models\Supplier;
use App\Models\Departement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Stock\app\Models\Stock;
use Modules\UnitProduct\app\Models\UnitProduct;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Purchase\app\Http\Controllers\PurchaseExportController;

class PurchaseController extends Controller
{

    /**
     * Instantiate a new PurchaseController instance.
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-purchase|edit-purchase|delete-purchase', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-purchase', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-purchase', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-purchase', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!empty($request->search)) {
            $transaction = TransactionPurchase::with(['supplier', 'methodpayment', 'departement'])->where('code_transaction', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $transaction = TransactionPurchase::with(['supplier', 'methodpayment', 'departement'])->latest()->paginate(10);
        }

        if (!empty($request->get('from')) && !empty($request->get('to'))) {
            $transaction = TransactionPurchase::with(['supplier', 'methodpayment', 'departement'])->whereBetween('date_purchase', [$request->get('from'), $request->get('to')])->latest()->paginate(10);
            $startdate = Carbon::createFromFormat('Y-m-d', $request->get('from'))->format('d/m/Y');
            $enddate = Carbon::createFromFormat('Y-m-d', $request->get('to'))->format('d/m/Y');
        } else {
            $startdate = Carbon::now()->startOfMonth()->format('d/m/Y');
            $enddate = Carbon::now()->endOfMonth()->addDays(1)->format('d/m/Y');
        }

        $sum_transaction_pending = TransactionPurchase::where('status', '=', '0')->where('id_method_payment', '=', '3')->sum('amount');
        $sum_transaction_success = TransactionPurchase::where('status', '=', '1')->sum('amount');
        $sum_transaction_cancel = TransactionPurchase::where('status', '=', '0')->where('note', '=', 'cancel')->sum('amount');
        $sum_transaction_success_today = TransactionPurchase::where('status', '=', '1')->where('date_purchase', Carbon::now()->format('Y-m-d'))->sum('amount');
        $sum_transaction_cancel_today = TransactionPurchase::where('status', '=', '0')->where('note', '=', 'cancel')->where('date_purchase', Carbon::now()->format('Y-m-d'))->sum('amount');
        $sum_transaction_pending_today = TransactionPurchase::where('status', '=', '0')->where('id_method_payment', '=', '3')->where('date_purchase', Carbon::now()->format('Y-m-d'))->sum('amount');

        $total_success_chart = TransactionPurchase::where('status', '=', '1')->select(DB::raw("CAST(SUM(amount) as int ) as total_success"))
            ->GroupBy(DB::raw("Month(date_purchase)"))
            ->pluck('total_success');

        $total_cancel_chart = TransactionPurchase::where('status', '=', '0')->where('note', '=', 'cancel')->select(DB::raw("CAST(SUM(amount) as int )as total_failed"))
            ->GroupBy(DB::raw("Month(date_purchase)"))
            ->pluck('total_failed');

        $total_pending_chart = TransactionPurchase::where('status', '=', '0')->where('id_method_payment', '=', '3')->select(DB::raw("CAST(SUM(amount) as int )as total_pending"))
            ->GroupBy(DB::raw("Month(date_purchase)"))
            ->pluck('total_pending');

        $bulan = TransactionPurchase::select(DB::raw("MONTHNAME(date_purchase) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(date_purchase)"))
            ->pluck('bulan');

        return view('purchase::index')->with([
            'transaction' => $transaction,
            'keyword' => $request->search,
            'total_transaction_pending' => $sum_transaction_pending,
            'total_transaction_success' => $sum_transaction_success,
            'total_transaction_cancel' => $sum_transaction_cancel,
            'total_transaction' => $sum_transaction_success + $sum_transaction_cancel,
            'today_success' => $sum_transaction_success_today,
            'today_cancel' => $sum_transaction_cancel_today,
            'today_pending' => $sum_transaction_pending_today,
            'startdate' => $startdate,
            'enddate' => $enddate,
            'chart_month' => $bulan,
            'chart_success' => $total_success_chart,
            'chart_cancel' => $total_cancel_chart,
            'chart_pending' => $total_pending_chart,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $record = TransactionPurchase::latest()->first();

        if (!empty($record)) {
            $expNum = explode('-', $record->code_transaction);
            //check first day in a year
            if (date('Y-01-01') == date('Y-m-d')) {
                $nextInvoiceNumber = 'PO-' . date('Y') . '-1';
            } else {
                //increase 1 with last invoice number
                $nextInvoiceNumber = $expNum[0] . '-' . $expNum[1] . '-' . $expNum[2] + 1;
            }
        } else {
            $nextInvoiceNumber = 'PO-' . date('Y') . '-1';
        }

        $product = ProductPos::query()->get();
        $stockunit = UnitProduct::query()->get();
        $method_payment = MethodPayment::query()->get();
        $supplier = Supplier::query()->get();
        $departement = Departement::query()->get();

        return view('purchase::create')->with([
            'ponumber' => $nextInvoiceNumber,
            'product' => $product,
            'method_payment' => $method_payment,
            'supplier' => $supplier,
            'departement' => $departement,
            'unit' => $stockunit
        ]);
    }

    /** store transfer */
    public function storetransfer($id)
    {
        $purchase = TransactionPurchase::find($id);
        $transaction = TransactionPurchaseItem::where('id_transaction_purchase', $id)->get();
        if (!empty($purchase) && !empty($transaction)) {
            foreach ($transaction as $transaction) {
                $departement = Departement::where('id', '=', $purchase->id_departement)->first();
                $stock_unit = Stock::where(['id_product' => $transaction->id_product, 'id_unit' => $transaction->id_unit, 'id_location' => $departement->id_location, 'id_warehouse' => $departement->id_warehouse])->first();
                $item_qty = 0;
                if (!empty($stock_unit)) {
                    $item_qty = $stock_unit->qty_convert != $transaction->qty ? $stock_unit->qty_convert * $transaction->qty : $transaction->qty;
                } else {
                    $item_qty = $transaction->qty;
                }
                $checkStocklast = ProductPos::find($transaction->id_product);
                if (!empty($checkStocklast)) {
                    $updatelast = intval($checkStocklast->stock_last) + intval($item_qty);
                    $checkStocklast->update(['stock_last' => $updatelast, 'price_purchase' => $transaction->price_purchase]);
                }
            }
            $purchase->update(['transfer_stock' => true]);
            Session::flash('success', 'Transaction is successfully !');
            return redirect()->back();
        } else {
            Session::flash('error', 'Transaction is failed !');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        //
        $request->validate([
            'supplier' => 'required',
            'departement' => 'required',
            'methodpayment' => 'required',
            'date_due' => 'required',
            'addmore.product.*' => 'required|sometimes',
            'addmore.units.*' => 'required|sometimes',
            'addmore.unitprice.*' => 'required|sometimes',
            'addmore.qty.*' => 'required|sometimes'
        ]);

        $send_data = [
            'code_transaction' => $request->ponumber,
            'date_purchase' => Carbon::createFromFormat('d/m/Y', $request->date_transaction)->format('Y-m-d'),
            'time_purchase' => Carbon::createFromFormat('d/m/Y', $request->date_transaction)->format('H:i:s'),
            'date_due' => Carbon::createFromFormat('d/m/Y', $request->date_due)->format('Y-m-d'),
            'status' => $request->methodpayment == 3 ? false : true,
            'id_supplier' => $request->supplier,
            'id_method_payment' => $request->methodpayment,
            'id_departement' => $request->departement,
            'id_user' => Auth::user()->id,
            'discount_amount' => empty($request->discount) ? 0 : $request->discount,
            'tax_amount' => empty($request->tax) ? 0 : $request->tax,
            'amount' => $request->total,
        ];

        if (!empty($request->note_purchase)) {
            $send_data['note'] = $request->note_purchase;
        }

        if ($request->hasFile('image_purchase')) {
            $imageName = time() . '.' . $request->image_purchase->extension();
            $path = $request->file('image_purchase')->storeAs('/upload/photo/transaction', $imageName, 'public');
            $send_data['file_doc'] = $path;
        }

        $purchase = TransactionPurchase::create($send_data);

        foreach ($request->addmore['product'] as $key => $val) {
            $check = ProductPos::find($val);
            $item_purchase = [
                'id_product' => $val,
                'id_unit' => $request->addmore['units'][$key],
                'qty' => $request->addmore['qty'][$key],
                'price_purchase' => $request->addmore['unitprice'][$key],
                'price_purchase_before' => $check->price_purchase,
                'id_transaction_purchase' => $purchase->id
            ];
            $purchase_item = TransactionPurchaseItem::create($item_purchase);
        }
        if (!empty($purchase) && !empty($purchase_item)) {
            Session::flash('success', 'Transaction is successfully !');
            return redirect()->back();
        } else {
            Session::flash('error', 'Transaction is failed !');
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $information = TransactionPurchase::with(['supplier', 'methodpayment', 'departement', 'operator'])->find($id);
        $detail_information = TransactionPurchaseItem::with(['products', 'units'])->where('id_transaction_purchase', $information->id)->get();
        $credit_information = PurchaseCredit::where('id_transaction_purchase', $information->id)->get();
        $total_credit = PurchaseCredit::where('id_transaction_purchase', $information->id)->sum('amount');
        return view('purchase::show')->with(['transaction' => $information, 'detail_transaction' => $detail_information, 'credit_transaction' => $credit_information, 'total_credit' => $total_credit]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $information = TransactionPurchase::with(['supplier', 'methodpayment', 'departement', 'operator'])->find($id);
        $detail_information = TransactionPurchaseItem::with(['products', 'units'])->where('id_transaction_purchase', $information->id)->get();
        $credit_information = PurchaseCredit::where('id_transaction_purchase', $information->id)->get();
        $total_credit = PurchaseCredit::where('id_transaction_purchase', $information->id)->sum('amount');
        $product = ProductPos::query()->get();
        $stockunit = UnitProduct::query()->get();
        $method_payment = MethodPayment::query()->get();
        $supplier = Supplier::query()->get();
        $departement = Departement::query()->get();
        return view('purchase::edit')->with([
            'transaction' => $information,
            'detail_transaction' => $detail_information,
            'credit_transaction' => $credit_information,
            'total_credit' => $total_credit,
            'product' => $product,
            'method_payment' => $method_payment,
            'supplier' => $supplier,
            'departement' => $departement,
            'unit' => $stockunit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
        $request->validate([
            'supplier' => 'required',
            'departement' => 'required',
            'methodpayment' => 'required',
            'date_due' => 'required',
            'addmore.product.*' => 'required|sometimes',
            'addmore.units.*' => 'required|sometimes',
            'addmore.unitprice.*' => 'required|sometimes',
            'addmore.qty.*' => 'required|sometimes'
        ]);

        $information = TransactionPurchase::where('id', $id)->first();

        $send_data = [
            'code_transaction' => $request->ponumber,
            'date_purchase' => Carbon::createFromFormat('d/m/Y', $request->date_transaction)->format('Y-m-d'),
            'time_purchase' => Carbon::createFromFormat('d/m/Y', $request->date_transaction)->format('H:i:s'),
            'date_due' => Carbon::createFromFormat('d/m/Y', $request->date_due)->format('Y-m-d'),
            'status' => $request->methodpayment == 3 ? false : true,
            'id_supplier' => $request->supplier,
            'id_method_payment' => $request->methodpayment,
            'id_departement' => $request->departement,
            'id_user' => Auth::user()->id,
            'discount_amount' => empty($request->discount) ? 0 : $request->discount,
            'tax_amount' => empty($request->taxt) ? 0 : $request->tax,
            'amount' => $request->total,
        ];

        if (!empty($request->note_purchase)) {
            $send_data['note'] = $request->note_purchase;
        }

        if ($request->hasFile('image_product')) {
            $imageName = time() . '.' . $request->image_product->extension();
            $path = $request->file('image_purchase')->storeAs('/upload/purchase/images', $imageName, 'public');
            $send_data['file_doc'] = $path;
        }

        $purchase = $information->update($send_data);
        TransactionPurchaseItem::where('id_transaction_purchase', $id)->delete();
        PurchaseCredit::where('id_transaction_purchase', $id)->delete();

        foreach ($request->addmore['product'] as $key => $val) {
            $item_purchase = [
                'id_product' => $val,
                'id_unit' => $request->addmore['units'][$key],
                'qty' => $request->addmore['qty'][$key],
                'price_purchase' => $request->addmore['unitprice'][$key],
                'id_transaction_purchase' => $id
            ];
            $purchase_item = TransactionPurchaseItem::create($item_purchase);
        }
        if (!empty($purchase) && !empty($purchase_item)) {
            Session::flash('success', 'Transaction is successfully !');
            return redirect()->back();
        } else {
            Session::flash('error', 'Transaction is failed !');
            return redirect()->back();
        }
    }

    /** pay_credit */
    public function pay_credit(Request $request)
    {
        $information = TransactionPurchase::where('id', $request->id_trans)->first();
        if (!empty($information)) {
            $total_transaction = $information->amount;
            $total_credit = PurchaseCredit::where('id_transaction_purchase', $information->id)->sum('amount');
            // check pembayaran lebih besar dari nilai kredit 
            $replace_currency = Str::replace('.', '', $request->amount_transaction);

            if ($replace_currency == $total_transaction) {

                TransactionPurchase::where('id', $request->id_trans)->update(['status' => true, 'note' => '']);

                PurchaseCredit::create([
                    'date_credit' => Carbon::createFromFormat('d/m/Y', $request->date_transaction)->format('Y-m-d'),
                    'amount' => $replace_currency,
                    'status' => true,
                    'method_due' => true,
                    'id_transaction_purchase' => $information->id
                ]);

                Session::flash('success', 'Payment Credit for due method is successfully.');
                return redirect()->back();

            } else {

                if ($replace_currency > $total_transaction) {

                    Session::flash('error', 'the amount credit value is greater than the transaction value, please for correct it! ');
                    return redirect()->back();

                } else {

                    $create_reduce = $total_transaction - ($replace_currency + $total_credit);

                    // update lunas jika tidak ada sisa kredit tagihan 
                    if ($create_reduce == 0) {
                        TransactionPurchase::where('id', $information->id)->update(['status' => true, 'note' => '']);
                    } else if ($replace_currency > $create_reduce) {
                        Session::flash('error', 'the amount credit value is greater than the transaction value, please for correct it! ');
                        return redirect()->back();
                    }

                    PurchaseCredit::create([
                        'date_credit' => Carbon::createFromFormat('d/m/Y', $request->date_transaction)->format('Y-m-d'),
                        'amount' => $replace_currency,
                        'status' => true,
                        'method_due' => true,
                        'id_transaction_purchase' => $information->id
                    ]);
                    Session::flash('success', 'Payment Credit for due method is successfully.');

                    return redirect()->back();
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $trans = TransactionPurchase::find($id);

        $transaction = TransactionPurchaseItem::where('id_transaction_purchase', $trans->id)->get();
        if (!empty($trans) && !empty($transaction) && $trans->transfer_stock == 1) {
            foreach ($transaction as $transaction) {
                $departement = Departement::where('id', '=', $trans->id_departement)->first();
                $stock_unit = Stock::where(['id_product' => $transaction->id_product, 'id_unit' => $transaction->id_unit, 'id_location' => $departement->id_location, 'id_warehouse' => $departement->id_warehouse])->first();
                if (!empty($stock_unit)) {
                    $item_qty = $stock_unit->qty_convert != $transaction->qty ? $stock_unit->qty_convert * $transaction->qty : $transaction->qty;
                } else {
                    $item_qty = $transaction->qty;
                }
                $checkStocklast = ProductPos::find($transaction->id_product);
                if (!empty($checkStocklast)) {
                    $updatelast = intval($checkStocklast->stock_last) - intval($item_qty);
                    $checkStocklast->update(['stock_last' => $updatelast, 'price_purchase' => $transaction->price_purchase_before]);
                }
            }
        }

        $trans->note = 'cancel';
        $trans->status = false;
        $trans->save();

        Session::flash('success', ' Transaction ' . $trans->code_transaction . 'has been cancel  successfuly.');
        return redirect()->back();
    }

    /** store new supplier  */

    public function storesupplier(Request $request)
    {
        $request->validate([
            'name_input' => 'required',
            'email_input' => 'required|unique:supplier,email',
            'contact_input' => 'required',
            'address_input' => 'required',
        ]);

        Supplier::create([
            'code' => Str::random(5),
            'name' => $request->name_input,
            'email' => $request->email_input,
            'contact' => $request->contact_input,
            'address' => $request->address_input
        ]);
        Session::flash('success', ' Supplier ' . $request->name . 'is  add successfuly.');
        return redirect()->back();
    }

    /** download files export transaction sales */
    public function download_transaction(Request $request)
    {
        if (!empty($request->get('from')) && !empty($request->get('to'))) {
            $startdate = Carbon::createFromFormat('d/m/Y', $request->get('from'))->format('Y-m-d');
            $enddate = Carbon::createFromFormat('d/m/Y', $request->get('to'))->format('Y-m-d');
            $transaction = TransactionPurchase::with(['supplier', 'methodpayment', 'departement'])->whereBetween('date_purchase', [$startdate, $enddate])->get();
            return Excel::download(new PurchaseExportController($transaction), 'purchase-export.xlsx');
        }
    }
}
