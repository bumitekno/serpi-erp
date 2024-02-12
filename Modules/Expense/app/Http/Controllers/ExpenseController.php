<?php

namespace Modules\Expense\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Expense\app\Models\Expense;
use Modules\Expense\app\Models\TransactionExpense;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\Departement;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!empty($request->search)) {
            $expense = Expense::where('name', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $expense = Expense::latest()->paginate(10);
        }
        $total_trans = TransactionExpense::query()->sum('amount');
        return view('expense::index')->with(['expense' => $expense, 'total_trans' => $total_trans]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function createtrans($id, Request $request)
    {
        $expense = Expense::find($id);

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

        if ($request->ajax()) {
            $data_trans = TransactionExpense::where('id_expense', '=', $id)->latest()->get();
            return DataTables::of($data_trans)
                ->addIndexColumn()
                ->editColumn('amount', function ($row) {
                    return empty($row->amount) ? 0 : number_format($row->amount, 0, ',', '.');
                })
                ->editColumn('date_transaction', function ($row) {
                    return empty($row->date_transaction) ? '-' : Carbon::parse($row->date_transaction)->translatedFormat('d F Y');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('expense.edittrans', $row->id) . '" class="edit btn btn-warning btn-sm me-2">Edit</a>';
                    $btn .= '<a href="' . route('expense.destroytrans', $row->id) . '" class="remove btn btn-danger btn-sm" onclick="return confirm(`Are you sure delete it ?`)">Delete</a>';
                    return $btn;
                })->rawColumns(['action'])->make();
        }

        $departement = Departement::query()->get();
        return view('expense::create_trans')->with(['expense' => $expense, 'no_trans' => $nextInvoiceNumber, 'list_departement' => $departement]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expense::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $request->validate([
            'name_input' => 'required|unique:expense,name'
        ]);

        Expense::create(['name' => $request->name_input]);
        Session::flash('success', ' Expense ' . $request->name_input . 'is  add successfuly.');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storetrans(Request $request): RedirectResponse
    {
        //
        TransactionExpense::create([
            'code_transaction' => $request->no_trans,
            'name_transaction' => $request->name_trans,
            'date_transaction' => Carbon::createFromFormat('d/m/Y', $request->date_trans)->format('Y-m-d'),
            'time_transaction' => Carbon::createFromFormat('d/m/Y', $request->date_trans)->format('H:i:s'),
            'id_expense' => $request->id_expense,
            'amount' => $request->amount_trans,
            'id_user' => Auth::user()->id,
            'id_departement' => $request->departement
        ]);
        Session::flash('success', ' Transaction ' . $request->name_trans . 'is  add successfuly.');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edittrans($id)
    {
        $edit = TransactionExpense::find($id);
        $departement = Departement::query()->get();
        return view('expense::edit_trans')->with(['expense' => $edit, 'list_departement' => $departement]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatetrans(Request $request, $id): RedirectResponse
    {
        //
        TransactionExpense::find($id)->update([
            'name_transaction' => $request->name_trans,
            'code_transaction' => $request->no_trans,
            'date_transaction' => Carbon::createFromFormat('d/m/Y', $request->date_trans)->format('Y-m-d'),
            'time_transaction' => Carbon::createFromFormat('d/m/Y', $request->date_trans)->format('H:i:s'),
            'amount' => $request->amount_trans,
            'id_departement' => $request->departement
        ]);
        Session::flash('success', ' Transaction Expense ' . $request->name_iname_transnput . 'is  change successfuly.');
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $expense = Expense::find($id);
        return view('expense::show')->with(['expense' => $expense]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $expense = Expense::find($id);
        return view('expense::edit')->with(['expense' => $expense]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
        $request->validate([
            'name_input' => 'required|unique:expense,name,' . $id
        ]);

        Expense::find($id)->update(['name' => $request->name_input]);
        Session::flash('success', ' Expense ' . $request->name_input . 'is  add successfuly.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $expense = Expense::find($id);
        $data_trans = TransactionExpense::where('id_expense', '=', $id)->first();
        if (!empty($data_trans)) {
            Session::flash('error', ' Cant`t delete. because referense trans');
            return redirect()->back();
        } else {
            Session::flash('success', ' Delete ' . $expense->name . ' is , successfully .');
            $expense->delete();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroytrans($id)
    {
        $data_trans = TransactionExpense::find($id);
        if (empty($data_trans)) {
            Session::flash('error', ' Cant`t delete ');
            return redirect()->back();
        } else {
            Session::flash('success', ' Delete ' . $data_trans->name_transaction . ' is , successfully .');
            $data_trans->delete();
            return redirect()->back();
        }
    }
}
