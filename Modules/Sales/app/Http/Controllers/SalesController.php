<?php

namespace Modules\Sales\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Sales\app\Models\TransactionSales;
use Modules\Sales\app\Models\TransactionSalesItem;
use Modules\Sales\app\Models\SalesCredit;
use Modules\ProductPos\app\Models\ProductPos;
use Modules\UnitProduct\app\Models\UnitProduct;
use Modules\Stock\app\Models\Stock;
use App\Models\MethodPayment;
use App\Models\Departement;
use Modules\CategoryProduct\app\Models\CategoryProduct;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SalesController extends Controller
{


    /**
     * Instantiate a new SalesController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-sales|edit-sales|delete-sales', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-sales', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-sales', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-sales', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!empty($request->search)) {
            $transaction = TransactionSales::with(['customer', 'methodpayment', 'departement'])->where('code_transaction', 'like', '%' . $request->search . '%')->where('saved_trans', '=', '0')->latest()->paginate(10);
        } else {
            $transaction = TransactionSales::with(['customer', 'methodpayment', 'departement'])->where('saved_trans', '=', '0')->latest()->paginate(10);
        }

        return view('sales::index')->with(['transaction' => $transaction]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //filter category
        if (!empty($request->segment(2))) {
            if ($request->segment(1) == 'filter') {
                if ($request->segment(2) == 'all' || $request->segment(2) == 'create') {
                    $product = ProductPos::with('category_product')->paginate(12);
                } else {
                    $product = ProductPos::with('category_product')->where('category', '=', $request->segment(2))->paginate(12);
                }
            } else if ($request->segment(1) == 'search') {
                $keyword = Str::replace('%20', '', $request->segment(2));
                $product = ProductPos::with('category_product')->where('name', 'like', '%' . $keyword . '%')->paginate(12);
            } else if ($request->segment(1) == 'sales') {
                $product = ProductPos::with('category_product')->paginate(12);
            }

        } else {
            $product = ProductPos::with('category_product')->paginate(12);
        }

        $stockunit = UnitProduct::query()->get();
        $method_payment = MethodPayment::query()->get();
        $category_product = CategoryProduct::query()->get();

        $customer = Customer::query()->get();
        $customer_default = empty(Session::get('customer')) ? Customer::first()?->id : Session::get('customer');

        $departement = Departement::query()->get();
        $departement_default = empty(Session::get('departement')) ? Departement::first()?->id : Session::get('departement');

        $date_transaction = empty(Session::get('date_trans')) ? Carbon::now()->format('Y-m-d') : Session::get('date_trans');

        $record = TransactionSales::latest()->first();

        $cart = empty(Session::get('cart')) ? [] : Session::get('cart');
        $edit_trans = empty(Session::get('edit')) ? false : Session::get('edit');

        if (!empty($record)) {
            $expNum = explode('-', $record->code_transaction);
            //check first day in a year
            if (date('Y-01-01') == date('Y-m-d')) {
                $nextInvoiceNumber = 'SO-' . date('Y') . '-1';
            } else {
                //increase 1 with last invoice number
                $nextInvoiceNumber = $expNum[0] . '-' . $expNum[1] . '-' . $expNum[2] + 1;
            }
        } else {
            $nextInvoiceNumber = 'SO-' . date('Y') . '-1';
        }

        $discount_cart = empty(Session::get('discount')) ? 0 : Session::get('discount');
        $tax_cart = empty(Session::get('tax')) ? 0 : Session::get('tax');

        // calc total cart 
        $total_cart = 0;
        $subtotal = 0;
        if (!empty($cart)) {
            foreach ($cart as $key => $item) {
                $subtotal += $cart[$key]['subtotal'];
            }
            $total_cart = $subtotal - $discount_cart + $tax_cart;
        }

        return view('sales::create')->with([
            'ponumber' => empty(Session::get('ponumber')) ? $nextInvoiceNumber : Session::get('ponumber'),
            'product' => $product,
            'method_payment' => $method_payment,
            'customer' => $customer,
            'customer_default' => $customer_default,
            'departement' => $departement,
            'departement_default' => $departement_default,
            'date_transaction' => $date_transaction,
            'unit' => $stockunit,
            'cart' => collect($cart)->sortByDesc('code_product'),
            'subtotal_cart' => $subtotal,
            'total_cart' => $total_cart,
            'discount_cart' => $discount_cart,
            'tax_cart' => $tax_cart,
            'category_product' => $category_product,
            'keyword' => empty($keyword) ? '' : $keyword,
            'operator' => empty(Auth::user()->name) ? '-' : Auth::user()->name,
            'edit_trans' => $edit_trans
        ]);
    }

    /** change customer  */
    public function changeCust($customer)
    {
        Session::put('customer', $customer);
        Session::flash('success', 'Customer is change successfully');
        return redirect()->back();
    }

    /** change departement  */
    public function changeDepart($departement)
    {
        Session::put('departement', $departement);
        Session::flash('success', 'Departement is change successfully');
        return redirect()->back();
    }

    /** add cart */
    public function addToCart(Request $request, $id, $departement)
    {
        $product = ProductPos::with('category_product')->where('id', '=', $id)->first();
        $departement = Departement::where('id', '=', $departement)->first();
        $cart = Session::get('cart');

        if (!empty($cart[$product['id']])) {
            $cart[$product['id']]['qty'] += 1;
            $cart[$product['id']]['subtotal'] += $cart[$product['id']]['price_unit'] * 1;
        } else {
            $id_unit = UnitProduct::first();

            $cart[$product->id] = array(
                "id" => $product->id,
                "code_product" => $product->code_product,
                "name_product" => $product->name,
                "price_unit" => $product->price_sell,
                "unit_id" => $id_unit?->id,
                "unit_name" => $id_unit?->name,
                "image_product" => $product->image_product,
                "qty" => 1,
                "subtotal" => $product->price_sell * 1,
                'location' => $departement?->id_location
            );
        }

        Session::put('cart', $cart);
        Session::flash('success', 'Item successfully added to Cart!');
        return redirect()->back();
    }

    /** Edit cart */
    public function editcart($id)
    {
        $cart = Session::get('cart');
        $show = collect($cart)->where('id', $id)->first();
        return response()->json(['data' => $show]);
    }

    /** Scan Barcode */
    public function scancart(Request $request)
    {
        $product = ProductPos::with('category_product')->where('code_product', '=', $request->code)->first();
        if (!empty($product)) {
            $cart = Session::get('cart');
            if (!empty($cart[$product['id']])) {
                $cart[$product['id']]['qty'] += 1;
                $cart[$product['id']]['subtotal'] += $cart[$product['id']]['price_unit'] * 1;
            } else {
                $id_unit = UnitProduct::first();
                $cart[$product->id] = array(
                    "id" => $product->id,
                    "code_product" => $product->code_product,
                    "name_product" => $product->name,
                    "price_unit" => $product->price_sell,
                    "unit_id" => $id_unit?->id,
                    "unit_name" => $id_unit?->name,
                    "qty" => 1,
                    "subtotal" => $product->price_sell * 1
                );
            }
            Session::put('cart', $cart);
            return response()->json(['refresh' => true, 'message' => 'Scan Barcode successfull'], 200);
        } else {
            return response()->json(['refresh' => false, 'message' => 'Scan Barcode failed'], 403);
        }
    }

    /** update cart All */
    public function updateCartAll(Request $cartdata)
    {
        $cart = Session::get('cart');

        foreach ($cartdata->all() as $id => $val) {
            if ($val > 0) {
                $cart[$id]['qty'] += $val;
            } else {
                unset($cart[$id]);
            }
        }
        Session::put('cart', $cart);
        return redirect()->back();
    }

    /** edit cart by id  */
    public function updatecart(Request $request)
    {
        $cart = Session::get('cart');
        if (!empty($cart[$request->id_cart])) {
            if ($request->qty_cart > 0) {
                $unit = UnitProduct::where('id', $request->units_cart)->first();
                if (!empty($unit)) {
                    //convert satuan unit menyebabkan subtotal berubah 
                    $stock_unit = Stock::where(['id_product' => $request->id_cart, 'id_unit' => $unit?->id, 'id_location' => $cart[$request->id_cart]['location']])->first();
                    if (!empty($stock_unit)) {
                        $cart[$request->id_cart]['unit_id'] = $unit?->id;
                        $cart[$request->id_cart]['unit_name'] = $unit?->name;
                        $cart[$request->id_cart]['qty'] = $request->qty_cart;
                        $cart[$request->id_cart]['subtotal'] = $cart[$request->id_cart]['price_unit'] * $stock_unit->qty_convert;
                        $message = $cart[$request->id_cart]['name_product'] . ' has been update data successfully.';
                        $notif = 'success';
                    } else {
                        $message = ' Stock Unit ' . $cart[$request->id_cart]['name_product'] . ' ' . $unit?->name . '  not found .';
                        $notif = 'error';
                        $unitdefault = UnitProduct::first();
                        $cart[$request->id_cart]['unit_id'] = $unitdefault?->id;
                        $cart[$request->id_cart]['unit_name'] = $unitdefault?->name;
                        $cart[$request->id_cart]['qty'] = $request->qty_cart;
                    }
                } else {
                    $message = $cart[$request->id_cart]['name_product'] . ' Unit not found .';
                    $notif = 'error';
                }
            } else {
                unset($cart[$request->id_cart]);
                $message = $cart[$request->id_cart]['name_product'] . ' has been delete data successfully.';
                $notif = 'success';
            }

            Session::put('cart', $cart);
            Session::flash($notif, $message);
            return redirect()->back();
        }
    }

    /** delete cart item by id */
    public function deletecart($id)
    {
        $cart = Session::get('cart');
        foreach ($cart as $key => $value) {
            if ($value['id'] == $id) {
                unset($cart[$key]);
            }
        }
        //put back in session array without deleted item
        Session::put('cart', $cart);
        Session::flash('success', 'Item successfully remove from Cart !');
        //then you can redirect or whatever you need
        return redirect()->back();
    }

    /** clear cart */

    public function clearCart(Request $request)
    {
        Session::put('cart', []);
        Session::flash('success', 'Cart has been emptied !');
        return redirect()->back();
    }

    /** update discount cart */
    public function updateDiscount(Request $request)
    {
        Session::put('discount', empty($request->discount) ? 0 : Str::replace('.', '', $request->discount));
        Session::flash('success', 'Discount has been add successfully !');
        return redirect()->back();
    }

    /** update discount cart */
    public function updatetax(Request $request)
    {
        Session::put('tax', empty($request->tax) ? 0 : Str::replace('.', '', $request->tax));
        Session::flash('success', 'Tax has been add successfully !');
        return redirect()->back();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $discount_cart = empty(Session::get('discount')) ? 0 : Session::get('discount');
        $tax_cart = empty(Session::get('tax')) ? 0 : Session::get('tax');
        $cart = Session::get('cart');

        //check transaction saved 
        $trans = TransactionSales::where('code_transaction', $request->number_invoice);
        $transFind = $trans->first();
        if (!empty($transFind)) {

            //drop transaction sales item exist
            TransactionSalesItem::where('id_transaction_sales', $transFind->id)->delete();

            if (!empty($cart)) {
                foreach ($cart as $key => $val) {
                    $item_sales = [
                        'id_product' => $cart[$key]['id'],
                        'id_unit' => $cart[$key]['unit_id'],
                        'qty' => $cart[$key]['qty'],
                        'price_sales' => $cart[$key]['price_unit'],
                        'id_transaction_sales' => $transFind->id
                    ];
                    $create_item_sales = TransactionSalesItem::create($item_sales);
                    //update stock last product 
                    $checkStocklast = ProductPos::find($create_item_sales->id_product);
                    if (!empty($checkStocklast->stock_last) && $checkStocklast->stock_last > 0) {
                        $updatelast = intval($checkStocklast->stock_last) - intval($create_item_sales->qty);
                        $checkStocklast->update(['stock_last' => $updatelast]);
                    }
                }
            }

            $transaction = [
                'code_transaction' => $request->number_invoice,
                'date_sales' => Carbon::createFromFormat('d/m/Y', $request->date_invoice)->format('Y-m-d'),
                'time_sales' => Carbon::createFromFormat('d/m/Y', $request->date_invoice)->format('H:i:s'),
                'date_due' => Carbon::createFromFormat('d/m/Y', $request->due_date_transaction)->format('Y-m-d'),
                'total_transaction' => Str::replace('.', '', $request->total_payment),
                'amount' => Str::replace('.', '', $request->amount_payment),
                'note' => $request->notes,
                'id_method_payment' => $request->methodpayment,
                'id_departement' => $request->departement_invoice,
                'id_user' => Auth::user()->id,
                'id_customer' => $request->customer_invoice,
                'discount_amount' => $discount_cart,
                'tax_amount' => $tax_cart,
                'status' => $request->methodpayment == 3 ? false : true,
                'saved_trans' => false
            ];

            $create_transaction = $trans->update($transaction);
            $id = $transFind->id;

        } else {

            $transaction = [
                'code_transaction' => $request->number_invoice,
                'date_sales' => Carbon::createFromFormat('d/m/Y', $request->date_invoice)->format('Y-m-d'),
                'time_sales' => Carbon::createFromFormat('d/m/Y', $request->date_invoice)->format('H:i:s'),
                'date_due' => Carbon::createFromFormat('d/m/Y', $request->due_date_transaction)->format('Y-m-d'),
                'total_transaction' => Str::replace('.', '', $request->total_payment),
                'amount' => Str::replace('.', '', $request->amount_payment),
                'note' => $request->notes,
                'id_method_payment' => $request->methodpayment,
                'id_departement' => $request->departement_invoice,
                'id_user' => Auth::user()->id,
                'id_customer' => $request->customer_invoice,
                'discount_amount' => $discount_cart,
                'tax_amount' => $tax_cart,
                'status' => $request->methodpayment == 3 ? false : true,
                'saved_trans' => false
            ];

            $create_transaction = TransactionSales::create($transaction);

            if (!empty($cart) && !empty($create_transaction)) {
                foreach ($cart as $key => $val) {
                    $item_sales = [
                        'id_product' => $cart[$key]['id'],
                        'id_unit' => $cart[$key]['unit_id'],
                        'qty' => $cart[$key]['qty'],
                        'price_sales' => $cart[$key]['price_unit'],
                        'id_transaction_sales' => $create_transaction->id
                    ];
                    $create_item_sales = TransactionSalesItem::create($item_sales);
                    //update stock last product 
                    $checkStocklast = ProductPos::find($create_item_sales->id_product);
                    if (!empty($checkStocklast->stock_last) && $checkStocklast->stock_last > 0) {
                        $updatelast = intval($checkStocklast->stock_last) - intval($create_item_sales->qty);
                        $checkStocklast->update(['stock_last' => $updatelast]);
                    }
                }
            }

            $id = $create_transaction->id;
        }

        if (!empty($create_transaction) && !empty($create_item_sales)) {
            Session::put('tax', 0);
            Session::put('discount', 0);
            Session::put('cart', []);
            Session::put('edit', false);
            Session::remove('customer');
            Session::remove('departement');
            Session::remove('date_trans');
            Session::remove('ponumber');
            Session::flash('success', 'Transaction is successfully !');
            return redirect()->route('sales.printsmall', $id);
        } else {
            Session::flash('error', 'Transaction is failed !');
            return redirect()->back();
        }
    }

    /** temp save transaction  */
    public function temptransaction(Request $request)
    {

        $discount_cart = empty(Session::get('discount')) ? 0 : Session::get('discount');
        $tax_cart = empty(Session::get('tax')) ? 0 : Session::get('tax');
        $cart = Session::get('cart');

        $transaction = [
            'code_transaction' => $request->no_invoice,
            'date_sales' => Carbon::createFromFormat('d/m/Y', $request->date_invoice)->format('Y-m-d'),
            'time_sales' => Carbon::createFromFormat('d/m/Y', $request->date_invoice)->format('H:i:s'),
            'total_transaction' => Str::replace('.', '', $request->totalpayment),
            'id_departement' => $request->departement,
            'id_customer' => $request->customer,
            'id_user' => Auth::user()->id,
            'saved_trans' => true,
            'discount_amount' => $discount_cart,
            'tax_amount' => $tax_cart,
        ];

        //drop transaction sales item exist
        $trans = TransactionSales::where('code_transaction', $request->no_invoice)->first();
        if (!empty($trans)) {
            TransactionSalesItem::where('id_transaction_sales', $trans->id)->delete();
            $trans->delete();
        }

        $create_transaction = TransactionSales::create($transaction);
        if (!empty($cart) && !empty($create_transaction)) {
            foreach ($cart as $key => $val) {
                $item_sales = [
                    'id_product' => $cart[$key]['id'],
                    'id_unit' => $cart[$key]['unit_id'],
                    'qty' => $cart[$key]['qty'],
                    'price_sales' => $cart[$key]['price_unit'],
                    'id_transaction_sales' => $create_transaction->id
                ];
                $create_item_sales = TransactionSalesItem::create($item_sales);
            }
        }

        if (!empty($create_transaction) && !empty($create_item_sales)) {
            Session::put('tax', 0);
            Session::put('discount', 0);
            Session::put('cart', []);
            Session::put('edit', false);
            Session::remove('customer');
            Session::remove('departement');
            Session::remove('date_trans');
            Session::remove('ponumber');

            return response()->json(['reload' => true, 'message' => 'Transaction saved is successfully'], 200);
        } else {
            return response()->json(['reload' => false, 'message' => 'Transaction saved is failed'], 403);
        }
    }

    /** choose save transaction */
    public function choose_transaction($id)
    {
        $information = TransactionSales::where('id', $id)->first();
        $detail = TransactionSalesItem::where('id_transaction_sales', $information?->id)->get();
        $departement = Departement::where('id', '=', $information->id_departement)->first();

        if (!empty($information) && !empty($detail)) {
            Session::put('customer', $information->id_customer);
            Session::put('departement', $information->id_departement);
            Session::put('date_trans', $information->date_sales);
            Session::put('tax', $information->tax_amount);
            Session::put('discount', $information->discount_amount);
            Session::put('ponumber', $information->code_transaction);
            Session::put('edit', false);
            Session::remove('cart');
            $cart = [];
            foreach ($detail as $detail) {
                $id_unit = UnitProduct::where('id', $detail->id_unit)->first();
                $product = ProductPos::with('category_product')->where('id', '=', $detail->id_product)->first();
                $cart[$detail->id_product] = [
                    "id" => $detail->id_product,
                    "code_product" => $product->code_product,
                    "name_product" => $product->name,
                    "price_unit" => $product->price_sell,
                    "unit_id" => $id_unit?->id,
                    "unit_name" => $id_unit?->name,
                    "image_product" => $product->image_product,
                    "qty" => $detail->qty,
                    "subtotal" => $product->price_sell * $detail->qty,
                    'location' => $departement?->id_location
                ];
            }
            Session::put('cart', $cart);
            Session::flash('success', 'Transaction saved is call successfull !');
        } else {
            Session::flash('error', 'Transaction saved is call failed !');
        }
        return redirect()->back();
    }

    /** ajax transaction saved */
    public function ajax_trans_saved(Request $request)
    {
        if ($request->ajax()) {
            $data = TransactionSales::with('customer')->where('saved_trans', '=', '1')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer', function ($row) {
                    return $row->customer?->name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="choose-saved btn btn-primary btn-sm me-3 mb-2" data-transid="' . $row->id . '"> <i class="bi bi-eyedropper"></i> Choose</a>';
                    $btn .= '<a href="javascript:void(0)" class="delete-saved btn btn-danger btn-sm" data-transid="' . $row->id . '"> <i class="bi bi-x"></i>  Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /** store new customer  */

    public function storecustomer(Request $request)
    {
        $request->validate([
            'name_input' => 'required',
            'email_input' => 'required|unique:customer,email',
            'contact_input' => 'required',
            'address_input' => 'required',
        ]);

        Customer::create([
            'code' => Str::random(5),
            'name' => $request->name_input,
            'email' => $request->email_input,
            'contact' => $request->contact_input,
            'address' => $request->address_input
        ]);
        Session::flash('success', ' Customer ' . $request->name . 'is  add successfuly.');
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $information = TransactionSales::with(['customer', 'methodpayment', 'departement', 'operator'])->find($id);
        $detail_information = TransactionSalesItem::with(['products', 'units'])->where('id_transaction_sales', $information->id)->get();
        $credit_information = SalesCredit::where('id_transaction_sales', $information->id)->get();
        return view('sales::show')->with(['transaction' => $information, 'detail_transaction' => $detail_information, 'credit_transaction' => $credit_information]);
    }

    /** print struk small */
    public function printsmall($id)
    {
        $information = TransactionSales::with(['customer', 'methodpayment', 'departement', 'operator'])->find($id);
        $detail_information = TransactionSalesItem::with(['products', 'units'])->where('id_transaction_sales', $information->id)->get();
        return view('sales::printsmall')->with(['transaction' => $information, 'detail_transaction' => $detail_information]);
    }

    /** pay_credit */
    public function pay_credit(Request $request)
    {
        $information = TransactionSales::where('id', $request->id_trans)->first();
        if (!empty($information)) {
            $total_transaction = $information->total_transaction;
            $total_credit = SalesCredit::where('id_transaction_sales', $information->id)->sum('amount');
            // check pembayaran lebih besar dari nilai kredit 
            $replace_currency = Str::replace('.', '', $request->amount_transaction);

            if ($replace_currency == $total_transaction) {

                TransactionSales::where('id', $request->id_trans)->update(['amount' => $replace_currency, 'status' => true, 'note' => '']);

                SalesCredit::create([
                    'date_credit' => Carbon::createFromFormat('d/m/Y', $request->date_transaction)->format('Y-m-d'),
                    'amount' => $replace_currency,
                    'status' => true,
                    'method_due' => true,
                    'id_transaction_sales' => $information->id
                ]);

                Session::flash('success', 'Payment Credit for due method is successfully.');
                return redirect()->back();

            } else {

                if ($replace_currency > $total_transaction) {

                    Session::flash('error', 'the amount credit value is greater than the transaction value, please for correct it! ');
                    return redirect()->back();

                } else {

                    $create_reduce = $total_transaction - $total_credit;

                    // update lunas jika tidak ada sisa kredit tagihan 
                    if ($create_reduce == 0) {
                        TransactionSales::where('id', $$information->id)->update(['amount' => $total_credit, 'status' => true, 'note' => '']);
                    }

                    SalesCredit::create([
                        'date_credit' => Carbon::createFromFormat('d/m/Y', $request->date_transaction)->format('Y-m-d'),
                        'amount' => $replace_currency,
                        'status' => true,
                        'method_due' => true,
                        'id_transaction_sales' => $information->id
                    ]);
                    Session::flash('success', 'Payment Credit for due method is successfully.');
                    return redirect()->back();
                }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $information = TransactionSales::where('id', $id)->first();
        $detail = TransactionSalesItem::where('id_transaction_sales', $information?->id)->get();
        $departement = Departement::where('id', '=', $information->id_departement)->first();

        if (!empty($information) && !empty($detail)) {
            Session::put('customer', $information->id_customer);
            Session::put('departement', $information->id_departement);
            Session::put('date_trans', $information->date_sales);
            Session::put('tax', $information->tax_amount);
            Session::put('discount', $information->discount_amount);
            Session::put('ponumber', $information->code_transaction);
            Session::remove('cart');
            $cart = [];
            foreach ($detail as $detail) {
                $id_unit = UnitProduct::where('id', $detail->id_unit)->first();
                $product = ProductPos::with('category_product')->where('id', '=', $detail->id_product)->first();
                $cart[$detail->id_product] = [
                    "id" => $detail->id_product,
                    "code_product" => $product->code_product,
                    "name_product" => $product->name,
                    "price_unit" => $product->price_sell,
                    "unit_id" => $id_unit?->id,
                    "unit_name" => $id_unit?->name,
                    "image_product" => $product->image_product,
                    "qty" => $detail->qty,
                    "subtotal" => $product->price_sell * $detail->qty,
                    'location' => $departement?->id_location
                ];
            }
            Session::put('cart', $cart);
            Session::put('edit', true);
            Session::flash('success', ' Edit Transaction' . $information->code_transaction);
        } else {
            Session::flash('error', ' Edit Transaction call failed !');
        }

        return redirect()->route('sales.create');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $trans = TransactionSales::find($id);
        $trans->note = 'cancel';
        $trans->status = false;
        $trans->save();
        $departement = Departement::where('id', $trans->id_departement)->first();
        $transitem = TransactionSalesItem::where('id_transaction_sales', $trans->id)->get();
        if (!empty($transitem)) {
            foreach ($transitem as $item) {
                $checkStocklast = ProductPos::find($item->id_product);

                $unit = Stock::where(['id_product' => $item->id_product, 'id_warehouse' => $departement->id_warehouse, 'id_location' => $departement->id_location])->first();

                if (!empty($checkStocklast->stock_last) && !empty($unit)) {
                    $updatelast = intval($checkStocklast->stock_last) + intval($unit->qty_convert);
                    $checkStocklast->stock_last = $updatelast;
                    $checkStocklast->save();
                }
            }
        }

        Session::flash('success', ' Transaction ' . $trans->code_transaction . 'has been cancel  successfuly.');
        return redirect()->back();
    }

    /** remove delete trans saved */
    public function removeTrans($id)
    {
        Session::put('tax', 0);
        Session::put('discount', 0);
        Session::put('cart', []);
        Session::remove('customer');
        Session::remove('departement');
        Session::remove('date_trans');
        Session::remove('ponumber');
        $trans = TransactionSales::where('id', $id)->first();
        if (!empty($trans)) {
            TransactionSalesItem::where('id_transaction_sales', $trans->id)->delete();
            $trans->delete();

            return response()->json(['reload' => true, 'message' => 'Remove Transaction is successfully !'], 200);
        } else {
            return response()->json(['reload' => false, 'message' => 'Remove Transaction is failed !'], 403);
        }
    }
}
