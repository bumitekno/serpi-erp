<?php

namespace Modules\Departement\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Departement;
use Modules\Location\app\Models\Location;
use Modules\Warehouse\app\Models\Warehouse;
use Modules\Sales\app\Models\TransactionSales;
use Modules\Purchase\app\Models\TransactionPurchase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DepartementController extends Controller
{

    /**
     * Instantiate a new DepartementController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-departement|edit-departement|delete-departement', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-departement', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-departement', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-departement', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!empty($request->search)) {
            $departement = Departement::with(['warehouse', 'location'])->where('name', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $departement = Departement::with(['warehouse', 'location'])->latest()->paginate(10);
        }

        $warehouse = Warehouse::query()->get();
        $location = Location::query()->get();

        return view('departement::index')->with(['departement' => $departement, 'keyword' => $request->search, 'warehouse' => $warehouse, 'location' => $location]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warehouse = Warehouse::query()->get();
        $location = Location::query()->get();
        return view('departement::create')->with(['warehouse' => $warehouse, 'location' => $location]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name_input' => 'required',
            'contact_input' => 'required',
            'email_input' => 'required|unique:departement,email',
            'id_warehouse' => 'required',
            'id_location' => 'required'
        ]);

        $input = [
            'code' => str::random(5),
            'name' => $request->name_input,
            'contact' => $request->contact_input,
            'email' => $request->email_input,
            'address' => $request->address_input,
            'id_warehouse' => $request->id_warehouse,
            'id_location' => $request->id_location
        ];

        if ($request->hasFile('avatar')) {

            $imageName = time() . '.' . $request->avatar->extension();
            $path = $request->file('avatar')->storeAs('/upload/photo/profiles', $imageName, 'public');
            $input['image'] = $path;
        }

        $create = Departement::create($input);

        Session::flash('success', ' Departement ' . $request->name_input . 'is  add successfuly.');
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $edit = Departement::with(['warehouse', 'location'])->find($id);
        $warehouse = Warehouse::query()->get();
        $location = Location::query()->get();
        return view('departement::show')->with(['warehouse' => $warehouse, 'location' => $location, 'departement' => $edit]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Departement::find($id);
        $warehouse = Warehouse::query()->get();
        $location = Location::query()->get();
        return view('departement::edit')->with(['warehouse' => $warehouse, 'location' => $location, 'departement' => $edit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
        $request->validate([
            'name_input' => 'required',
            'contact_input' => 'required',
            'email_input' => 'required|unique:departement,email,' . $id,
            'id_warehouse' => 'required',
            'id_location' => 'required'
        ]);

        $update = Departement::find($id);

        $input = [
            'name' => $request->name_input,
            'contact' => $request->contact_input,
            'email' => $request->email_input,
            'address' => $request->address_input,
            'id_warehouse' => $request->id_warehouse,
            'id_location' => $request->id_location
        ];

        if ($request->hasFile('avatar')) {
            if (!empty($update->image)) {
                if (Storage::exists($update->image))
                    Storage::delete($update->image);
            }
            $imageName = time() . '.' . $request->avatar->extension();
            $path = $request->file('avatar')->storeAs('/upload/photo/profiles', $imageName, 'public');
            $input['image'] = $path;
        }

        $update = $update->update($input);

        Session::flash('success', ' Departement ' . $request->name_input . 'is  change successfuly.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $departement = Departement::find($id);
        $check_transaction = TransactionSales::where('id_departement', $id)->first();
        $check_transaction2 = TransactionPurchase::where('id_departement', $id)->first();
        if (!empty($check_transaction) && !empty($check_transaction2)) {
            Session::flash('error', ' Departement ' . $departement->name . 'is can`t delete , because referense transaction sales and purchase .');
            return redirect()->back();
        } else {
            Session::flash('success', ' Departement ' . $departement->name . 'has been delete it .');
            $departement->delete();
            return redirect()->back();
        }
    }
}
