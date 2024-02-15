<?php

namespace Modules\Location\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Location\app\Models\Location;
use Modules\Location\app\Http\Requests\StoreLocationRequest;
use Modules\Location\app\Http\Requests\EditLocationRequest;

class LocationController extends Controller
{

    /**
     * Instantiate a new LocationController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-location|edit-location|delete-location', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-location', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-location', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-location', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!empty($request->search)) {
            $location = Location::where('name_location', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        } else {
            $location = Location::latest()->paginate(10);
        }

        return view('location::index')->with(['location' => $location, 'keyword' => $request->search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('location::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request): RedirectResponse
    {
        //
        $input = $request->all();
        $data_send = [
            'name_location' => $input['name'],
            'contact' => $input['contact'],
            'address' => $input['address']
        ];
        Location::create($data_send);
        return redirect()->route('location.index')
            ->withSuccess('New Location is added successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('location::show')->with(['location' => Location::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('location::edit')->with(['location' => Location::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditLocationRequest $request, $id): RedirectResponse
    {
        //
        $input = $request->all();
        $data_send = [
            'name_location' => $input['name'],
            'contact' => empty($input['contact']) ? '' : $input['contact'],
            'address' => empty($input['address']) ? '' : $input['address']
        ];
        Location::find($id)->update($data_send);
        return redirect()->route('location.index')
            ->withSuccess('New Location is Change successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $destroy = Location::find($id);
        $destroy->delete();
        return redirect()->route('location.index')
            ->withSuccess('New Location is delete successfully.');
    }
}
