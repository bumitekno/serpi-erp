<?php

namespace Modules\Sales\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Sales\app\Models\TransactionSales;
use Modules\Sales\app\Models\TransactionSalesItem;
use Modules\ProductPos\app\Models\ProductPos;
use Modules\UnitProduct\app\Models\UnitProduct;
use App\Models\MethodPayment;
use App\Models\Departement;
use Illuminate\Support\Facades\Session;

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
            $transaction = TransactionSales::where('code_transaction', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $transaction = TransactionSales::latest()->paginate(10);
        }

        return view('sales::index')->with(['transaction' => $transaction]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = ProductPos::with('category_product')->paginate(10);
        $stockunit = UnitProduct::query()->get();
        $method_payment = MethodPayment::query()->get();
        $customer = Customer::query()->get();
        $departement = Departement::query()->get();
        $record = TransactionSales::latest()->first();
        $cart = empty(Session::get('cart')) ? [] : Session::get('cart');

        if (!empty($record)) {
            $expNum = explode('-', $record->code_transaction);
            //check first day in a year
            if (date('l', strtotime(date('Y-01-01')))) {
                $nextInvoiceNumber = 'SO-' . date('Y') . '-0001';
            } else {
                //increase 1 with last invoice number
                $nextInvoiceNumber = $expNum[0] . '-' . $expNum[1] . '-' . $expNum[2] + 1;
            }
        } else {
            $nextInvoiceNumber = 'SO-' . date('Y') . '-0001';
        }

        return view('sales::create')->with([
            'ponumber' => $nextInvoiceNumber,
            'product' => $product,
            'method_payment' => $method_payment,
            'customer' => $customer,
            'departement' => $departement,
            'unit' => $stockunit,
            'cart' => $cart
        ]);
    }

    /** add cart */
    public function addToCart(Request $request, $id)
    {
        $product = ProductPos::with('category_product')->where('id', '=', $id)->first();
        $cart = Session::get('cart');
        $cart[$product->id] = array(
            "id" => $product->id,
            "code_product" => $product->code_product,
            "name_product" => $product->name,
            "price_unit" => $product->price_sell,
            "unit_id" => UnitProduct::first()?->id,
            "qty" => 1,
        );

        Session::put('cart', $cart);
        Session::flash('success', 'barang berhasil ditambah ke keranjang!');
        return redirect()->back();
    }

    /** update cart */
    public function updateCart(Request $cartdata)
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

    /** clear cart */

    public function clearCart(Request $carddata)
    {
        Session::put('cart', []);
        Session::flash('success', 'Keranjang telah di kosongkan !');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('sales::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('sales::edit');
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
    }
}
