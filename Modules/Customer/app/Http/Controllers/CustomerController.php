<?php

namespace Modules\Customer\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Modules\Sales\app\Models\TransactionSales;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\CardMember;
use App\Models\TransCardMember;
use App\Models\Departement;
use Modules\Income\app\Models\TransactionIncome;
use Modules\Expense\app\Models\TransactionExpense;

class CustomerController extends Controller
{

    /**
     * Instantiate a new SupplierController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-customer|edit-customer|delete-customer', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-customer', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-customer', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-customer', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!empty($request->search)) {
            $customer = Customer::where('name', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $customer = Customer::latest()->paginate(10);
        }
        return view('customer::index')->with(['customer' => $customer, 'keyword' => $request->search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $request->validate([
            'name_input' => 'required',
            'email_input' => 'required|unique:customer,email',
            'contact_input' => 'required',
            'address_input' => 'required',
        ]);


        $input = [
            'code' => Str::random(5),
            'name' => $request->name_input,
            'email' => $request->email_input,
            'contact' => $request->contact_input,
            'address' => $request->address_input
        ];

        if ($request->hasFile('avatar')) {
            $imageName = time() . '.' . $request->avatar->extension();
            $path = $request->file('avatar')->storeAs('/upload/photo/profiles', $imageName, 'public');
            $input['image'] = $path;
        }

        Customer::create($input);
        Session::flash('success', ' Customer ' . $request->name . 'is  add successfuly.');
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     */
    public function show($id, Request $request)
    {
        $customer = Customer::find($id);

        if ($request->ajax()) {
            $transaction = TransactionSales::with(['departement', 'methodpayment', 'operator'])->where('id_customer', $customer->id)->get();
            return DataTables::of($transaction)
                ->addIndexColumn()
                ->editColumn('total_transaction', function ($row) {
                    return empty($row->total_transaction) ? 0 : number_format($row->total_transaction, 0, ',', '.');
                })
                ->editColumn('amount', function ($row) {
                    return empty($row->amount) ? 0 : number_format($row->amount, 0, ',', '.');
                })
                ->editColumn('date_transaction', function ($row) {
                    return empty($row->date_sales) ? '-' : Carbon::parse($row->date_sales)->translatedFormat('d F Y');
                })
                ->editColumn('departement', function ($row) {
                    return empty($row->departement) ? '-' : $row->departement->name;
                })
                ->editColumn('methodpayment', function ($row) {
                    return empty($row->methodpayment) ? '-' : $row->methodpayment->name;
                })
                ->addColumn('code_transaction', function ($row) {
                    $btn = '<a href="' . route('sales.show', $row->id) . '">' . $row->code_transaction . '</a>';
                    return $btn;
                })->rawColumns(['code_transaction'])->make();
        }

        $total_transaction = TransactionSales::where('id_customer', $customer->id)->sum('total_transaction');
        return view('customer::show')->with(['customer' => $customer, 'total_transaction' => $total_transaction]);
    }

    /**
     * Show the specified resource.
     */
    public function cardview($id, Request $request)
    {
        $customer = Customer::find($id);
        if ($request->ajax()) {
            $card = CardMember::where('id_customer', '=', $id)->latest()->get();
            return DataTables::of($card)
                ->addIndexColumn()
                ->editColumn('balance', function ($row) {
                    return empty($row->balance) ? 0 : number_format($row->balance, 0, ',', '.');
                })
                ->editColumn('created_at', function ($row) {
                    return empty($row->created_at) ? '-' : Carbon::parse($row->created_at)->translatedFormat('d F Y');
                })
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? '<span class="text-success">Active</span>' : '<span class="text-danger">Deactive</span>';
                })
                ->addColumn('action', function ($row) {
                    $btn = $row->status == 1 ? '<a href="' . route('customer.updatecard', ['id' => $row->id, 'status' => 0]) . '" class="btn btn-danger btn-sm" onclick="return confirm(`Are you sure to deactive this Card ?`)">Deactive</a>' : '<a href="' . route('customer.updatecard', ['id' => $row->id, 'status' => 1]) . '" class="btn btn-success btn-sm" onclick="return confirm(`Are you sure to Active this Card ?`)">Active</a>';
                    return $btn;
                })->rawColumns(['action', 'status'])->make();
        }

        $card_active = CardMember::where('id_customer', $customer->id)->where('status', '=', '1')->select(['id', 'number_card'])->get();
        $departement = Departement::query()->get();
        return view("customer::cardmember")->with(['customer' => $customer, 'card_active' => $card_active, 'departement' => $departement]);
    }

    /** Store add Card */
    public function cardstore(Request $request): RedirectResponse
    {
        $check = CardMember::where('id_customer', $request->id_customer)->where('number_card', $request->number_card_input)->first();
        if (!empty($check)) {
            Session::flash('error', 'Card Number' . $request->number_card_input . ' is exist !');
            return redirect()->back();
        } else {
            CardMember::create([
                'number_card' => $request->number_card_input,
                'id_customer' => $request->id_customer,
                'status' => 1
            ]);

            Session::flash('success', 'Card Number' . $request->number_card_input . ' is add successfully !');
            return redirect()->back();
        }
    }

    /** update card  */
    public function updatecard($id, $status)
    {
        CardMember::find($id)->update(['status' => $status]);
        Session::flash('success', 'Card Number  is change successfully !');
        return redirect()->back();
    }

    /** ajax view transaction card  */
    public function ajax_trans_viewcard($customerid, Request $request)
    {
        if ($request->ajax()) {

            $card = CardMember::where('id_customer', $customerid)->pluck('id');
            $transaction = TransCardMember::whereIn('id_member', collect($card))->latest();
            return DataTables::of($transaction)
                ->addIndexColumn()
                ->editColumn('number_card', function ($row) {
                    return CardMember::find($row->id_member)?->number_card;
                })
                ->editColumn('nominal', function ($row) {
                    return empty($row->nominal) ? 0 : number_format($row->nominal, 0, ',', '.');
                })
                ->editColumn('date_trans', function ($row) {
                    return $row->date_trans;
                })
                ->editColumn('type', function ($row) {
                    return $row->type == 'topup' ? '<span class="text-success">Top Up</span>' : '<span class="text-danger">Withdraw</span>';
                })
                ->rawColumns(['type'])->make();
        }
    }

    /** store trans card */
    public function storetranscard(Request $request)
    {

        $number = CardMember::find($request->cardmember);

        if ($request->typetrans == 'topup') {

            $topup = TransCardMember::create([
                'id_member' => $request->cardmember,
                'nominal' => $request->nominal_card_input,
                'type' => 'topup',
                'date_trans' => Carbon::now()
            ]);

            if (!empty($topup)) {

                $number->update(['balance' => intval($number->balance + $topup->nominal)]); // update balance top up

                $record = TransactionIncome::latest()->first();
                if (!empty($record)) {
                    $expNum = explode('-', $record->code_transaction);
                    //check first day in a year
                    if (date('Y-01-01') == date('Y-m-d')) {
                        $nextInvoiceNumber = 'IN-' . date('Y') . '-1';
                    } else {
                        //increase 1 with last invoice number
                        $nextInvoiceNumber = $expNum[0] . '-' . $expNum[1] . '-' . $expNum[2] + 1;
                    }
                } else {
                    $nextInvoiceNumber = 'IN-' . date('Y') . '-1';
                }

                TransactionIncome::create([
                    'code_transaction' => $nextInvoiceNumber,
                    'name_transaction' => 'Top Up Card Member ' . $number->number_card . '',
                    'date_transaction' => Carbon::parse($topup->datetrans)->format('Y-m-d'),
                    'time_transaction' => Carbon::parse($topup->datetrans)->format('H:i:s'),
                    'id_user' => Auth::user()->id,
                    'id_income' => 1,
                    'amount' => $topup->nominal,
                    'id_departement' => $request->departement,
                    'note' => 'Top Up Card Member ' . $number->number_card . ''
                ]);
            }

            Session::flash('success', ' Top Up  Card Number ' . $number->number_card . ' is successfully !');
            return redirect()->back();

        } else if ($request->typetrans == 'withdraw') {
            $balance = $number->balance;
            if ($balance < $request->nominal_card_input) {
                Session::flash('error', ' Withdraw  Card Number ' . $number->number_card . ' is failed, the balance is not sufficient  !');
                return redirect()->back();
            } else {

                $withdraw = TransCardMember::create([
                    'id_member' => $request->cardmember,
                    'nominal' => $request->nominal_card_input,
                    'type' => 'withdraw',
                    'date_trans' => Carbon::now()
                ]);

                if (!empty($withdraw)) {


                    $number->update(['balance' => intval($number->balance - $withdraw->nominal)]); // update balance withdraw

                    $record = TransactionExpense::latest()->first();
                    if (!empty($record)) {
                        $expNum = explode('-', $record->code_transaction);
                        //check first day in a year
                        if (date('Y-01-01') == date('Y-m-d')) {
                            $nextInvoiceNumber = 'EX-' . date('Y') . '-1';
                        } else {
                            //increase 1 with last invoice number
                            $nextInvoiceNumber = $expNum[0] . '-' . $expNum[1] . '-' . $expNum[2] + 1;
                        }
                    } else {
                        $nextInvoiceNumber = 'EX-' . date('Y') . '-1';
                    }

                    TransactionExpense::create([
                        'code_transaction' => $nextInvoiceNumber,
                        'name_transaction' => 'Withdraw Card Member' . $number->number_card . '',
                        'date_transaction' => Carbon::parse($withdraw->datetrans)->format('Y-m-d'),
                        'time_transaction' => Carbon::parse($withdraw->datetrans)->format('H:i:s'),
                        'id_user' => Auth::user()->id,
                        'id_expense' => 1,
                        'amount' => $withdraw->nominal,
                        'id_departement' => $request->departement,
                        'note' => 'Withdraw Card Member ' . $number->number_card . ''
                    ]);

                    Session::flash('success', ' Withdraw Card Member' . $number->number_card . ' is successfully !');
                    return redirect()->back();

                } else {
                    Session::flash('error', ' Withdraw  Card Number ' . $number->number_card . ' is failed !');
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
        $customer = Customer::find($id);
        return view('customer::edit')->with(['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
        $request->validate([
            'name_input' => 'required',
            'email_input' => 'required|unique:customer,email,' . $id,
            'contact_input' => 'required',
            'address_input' => 'required',
        ]);

        $customer = Customer::find($id);

        $input = [
            'name' => $request->name_input,
            'email' => $request->email_input,
            'contact' => $request->contact_input,
            'address' => $request->address_input
        ];

        if ($request->hasFile('avatar')) {

            if (!empty($customer->image))
                if (Storage::exists($customer->image)) {
                    Storage::delete($customer->image);
                }


            $imageName = time() . '.' . $request->avatar->extension();
            $path = $request->file('avatar')->storeAs('/upload/photo/profiles', $imageName, 'public');
            $input['image'] = $path;
        }

        $customer->update($input);
        Session::flash('success', ' Customer ' . $request->name_input . 'is  Change successfuly.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $customer = Customer::find($id);
        $check_transaction = TransactionSales::where('id_customer', $id)->first();
        if (!empty($check_transaction)) {
            Session::flash('error', ' Customer ' . $customer->name . 'is can`t delete , because referense transaction sales .');
            return redirect()->back();
        } else {
            Session::flash('success', ' Customer ' . $customer->name . 'has been delete it .');
            $customer->delete();
            return redirect()->back();
        }
    }
}
