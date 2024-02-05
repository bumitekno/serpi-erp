<?php

namespace Modules\Income\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Income\app\Models\Income;
use Modules\Income\app\Models\TransactionIncome;

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
        return view('income::index')->with(['income' => $income]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('income::create');
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
        return view('income::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('income::edit');
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
