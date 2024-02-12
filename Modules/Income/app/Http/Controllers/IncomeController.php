<?php

namespace Modules\Income\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Departement;
use Modules\Income\app\Models\Income;
use Modules\Income\app\Models\TransactionIncome;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class IncomeController extends Controller
{

    /**
     * Instantiate a new IncomeController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-income|edit-income|delete-income|create-transaction-income|edit-transaction-income|delete-transaction-income', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-income', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-income', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-income', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!empty($request->search)) {
            $income = Income::where('name', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $income = Income::latest()->paginate(10);
        }
        $total_trans = TransactionIncome::query()->sum('amount');
        return view('income::index')->with(['income' => $income, 'total_trans' => $total_trans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('income::create');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function createtrans($id, Request $request)
    {
        $income = Income::find($id);

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

        if ($request->ajax()) {
            $data_trans = TransactionIncome::where('id_income', '=', $id)->latest()->get();
            return DataTables::of($data_trans)
                ->addIndexColumn()
                ->editColumn('amount', function ($row) {
                    return empty($row->amount) ? 0 : number_format($row->amount, 0, ',', '.');
                })
                ->editColumn('date_transaction', function ($row) {
                    return empty($row->date_transaction) ? '-' : Carbon::parse($row->date_transaction)->translatedFormat('d F Y');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('income.edittrans', $row->id) . '" class="edit btn btn-warning btn-sm me-2">Edit</a>';
                    $btn .= '<a href="' . route('income.destroytrans', $row->id) . '" class="remove btn btn-danger btn-sm" onclick="return confirm(`Are you sure delete it ?`)">Delete</a>';
                    return $btn;
                })->rawColumns(['action'])->make();
        }

        $departement = Departement::query()->get();

        return view('income::create_trans')->with(['income' => $income, 'no_trans' => $nextInvoiceNumber, 'list_departement' => $departement]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name_input' => 'required|unique:income,name'
        ]);

        Income::create(['name' => $request->name_input]);
        Session::flash('success', ' Income ' . $request->name_input . 'is  add successfuly.');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storetrans(Request $request): RedirectResponse
    {
        //
        TransactionIncome::create([
            'code_transaction' => $request->no_trans,
            'name_transaction' => $request->name_trans,
            'date_transaction' => Carbon::createFromFormat('d/m/Y', $request->date_trans)->format('Y-m-d'),
            'time_transaction' => Carbon::createFromFormat('d/m/Y', $request->date_trans)->format('H:i:s'),
            'id_income' => $request->id_income,
            'amount' => $request->amount_trans,
            'id_user' => Auth::user()->id,
            'id_departement' => $request->departement
        ]);
        Session::flash('success', ' Transaction ' . $request->name_trans . 'is  add successfuly.');
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $edit = Income::find($id);
        return view('income::show')->with(['income' => $edit]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Income::find($id);
        return view('income::edit')->with(['income' => $edit]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edittrans($id)
    {
        $edit = TransactionIncome::find($id);
        $departement = Departement::query()->get();
        return view('income::edit_trans')->with(['income' => $edit, 'list_departement' => $departement]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
        $request->validate([
            'name_input' => 'required|unique:income,name,' . $id
        ]);

        Income::find($id)->update(['name' => $request->name_input]);
        Session::flash('success', ' Income ' . $request->name_input . 'is  change successfuly.');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatetrans(Request $request, $id): RedirectResponse
    {
        TransactionIncome::find($id)->update([
            'name_transaction' => $request->name_trans,
            'code_transaction' => $request->no_trans,
            'date_transaction' => Carbon::createFromFormat('d/m/Y', $request->date_trans)->format('Y-m-d'),
            'time_transaction' => Carbon::createFromFormat('d/m/Y', $request->date_trans)->format('H:i:s'),
            'amount' => $request->amount_trans,
            'id_departement' => $request->departement
        ]);
        Session::flash('success', ' Transaction Income ' . $request->name_iname_transnput . 'is  change successfuly.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $income = Income::find($id);
        $data_trans = TransactionIncome::where('id_income', '=', $id)->first();
        if (!empty($data_trans)) {
            Session::flash('error', ' Cant`t delete , because reference transaction .');
            return redirect()->back();
        } else {
            Session::flash('success', ' Delete ' . $income->name . ' is , successfully .');
            $income->delete();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroytrans($id)
    {
        $data_trans = TransactionIncome::find($id);
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
