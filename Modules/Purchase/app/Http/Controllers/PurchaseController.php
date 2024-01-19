<?php

namespace Modules\Purchase\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Purchase\app\Models\TransactionPurchase;
use Modules\Purchase\app\Models\TransactionPurchaseItem;
use Modules\Stock\app\Models\Stock;

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
            $transaction = TransactionPurchase::where('code_transaction', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $transaction = TransactionPurchase::latest()->paginate(10);
        }

        return view('purchase::index')->with(['transaction' => $transaction]);
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
            if (date('l', strtotime(date('Y-01-01')))) {
                $nextInvoiceNumber = 'PO-' . date('Y') . '-0001';
            } else {
                //increase 1 with last invoice number
                $nextInvoiceNumber = $expNum[0] . '-' . $expNum[1] . '-' . $expNum[2] + 1;
            }
        } else {
            $nextInvoiceNumber = 'PO-' . date('Y') . '-0001';
        }

        $stock_product = Stock::with(['products', 'location', 'warehouse', 'units'])->get();

        return view('purchase::create')->with([
            'ponumber' => $nextInvoiceNumber,
            'stockproduct' => $stock_product
        ]);
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
        return view('purchase::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('purchase::edit');
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
