<?php

namespace App\Addons\Accounting\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Addons\Accounting\Models\res_company;
use App\Addons\Accounting\Models\res_currency;
use App\Addons\Accounting\Models\res_country;
use App\Addons\Accounting\Models\res_country_state;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class AccountCompanyController extends Controller
{

    /**
     * The above function is a PHP constructor that adds a custom view location for an accounting addon
     * in a Laravel application.
     */
    public function __construct()
    {
        $this->middleware('auth');
        View::addLocation(app_path() . '/Addons/Accounting/Views');
    }




    /**
     * This PHP function retrieves and paginates company data based on search query and sorting
     * criteria.
     * 
     * @param Request request The `index` function in the code snippet is a controller method that
     * handles the logic for displaying a list of companies. Let me explain the parameters used in this
     * function:
     * 
     * @return ` function `index` is returning a view called 'company.index' with an array of data
     * containing the paginated list of companies based on the search query and sorting criteria. The
     * data being passed to the view includes the paginated list of companies (``), the search
     * query (``), and the sorting order (``).
     */

    public function index(Request $request)
    {
        $sortby = empty ($request->sortby) ? 'asc' : $request->sortby;

        if (!empty ($request->q)) {
            $company = res_company::with('parent')->where('company_name', 'like', '%' . $request->q . '%')->orderBy('code', $sortby)->paginate(25)->appends(['sortby' => Str::lower($sortby)]);
        } else {
            $company = res_company::with('parent')->orderBy('code', $sortby)->paginate(25)->appends(['sortby' => Str::lower($sortby)]);
        }
        return view('company.index')->with(['company' => $company, 'q' => $request->q, 'sort' => Str::lower($sortby)]);
    }

    /** 
     *  * Display a listing of the resource.
     */
    public function create()
    {
        $res_currency = res_currency::orderBy('id', 'ASC')->get();
        $res_country = res_country::orderBy('country_name', 'ASC')->get();
        $res_country_state = res_country_state::orderBy('state_name', 'ASC')->get();
        $res_parent_company = res_company::with('currency')->get();
        return view('company.create')->with(['res_currency' => $res_currency, 'res_country' => $res_country, 'res_country_state' => $res_country_state, 'parent_company' => $res_parent_company]);
    }

    /**
     * The function stores company data including a photo, validates input, uploads the photo if
     * provided, and handles exceptions.
     * 
     * @param Request request The `store` function you provided is a method that handles the storing of
     * a new company record based on the data received in the request. Let's break down the parameters
     * used in this function:
     * 
     * @return `The` store function is returning a redirect back to the previous page after attempting to
     * create a new company record in the res_company table. If the creation is successful, a success
     * message is flashed with the company name, and if there is an error, an error message with the
     * exception message is flashed.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required|string|max:50',
            'currency_id' => 'required'
        ]);

        $image_64 = $request->photo;
        $imageName = null;
        $path = null;
        $display_name = $request->company_name;
        if ($image_64 != null) {
            $imageName = time() . '.' . $request->photo->extension();
            $path = $request->file('photo')->storeAs('/upload/company', $imageName, 'public');
        }

        try {
            $data = $request->all();
            $data['display_name'] = $display_name;
            $data['photo'] = $path;

            res_company::create($data);
            Session::flash('success', "Company $request->company_name Created Successfully");
            return redirect()->back();

        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . 'Something Wrong');
            return redirect()->back();
        }
    }


    /**
     * The edit function retrieves data for editing a company record and passes it to the edit view in a
     * Laravel application.
     * 
     * @param $id The `edit` function you provided is used to retrieve data necessary for editing a
     * company with the given `id`. The function fetches information such as currencies, countries,
     * states, parent companies, and the specific company with the provided `id`.
     * 
     * @return `The `edit` function is returning a view called `company.edit` along with several
     * variables passed to the view. These variables are:
     * - `res_currency`: A collection of currencies ordered by ID in ascending order.
     * - `res_country`: A collection of countries ordered by country name in ascending order.
     * - `res_country_state`: A collection of country states ordered by state name in ascending order.
     * -
     */
    public function edit($id)
    {
        $res_currency = res_currency::orderBy('id', 'ASC')->get();
        $res_country = res_country::orderBy('country_name', 'ASC')->get();
        $res_country_state = res_country_state::orderBy('state_name', 'ASC')->get();
        $res_parent_company = res_company::with('currency')->get();
        $company = res_company::findOrFail($id);
        return view('company.edit')->with([
            'res_currency' => $res_currency,
            'res_country' => $res_country,
            'res_country_state' => $res_country_state,
            'parent_company' => $res_parent_company,
            'company' => $company
        ]);
    }

    /**
     * The function stores company data including a photo, validates input, uploads the photo if
     * provided, and handles exceptions.
     * @param mixed $id
     * @param Request request The `edit` function you provided is a method that handles the storing of
     * a new company record based on the data received in the request. Let's break down the parameters
     * used in this function:
     * 
     * @return `The` edit function is returning a redirect back to the previous page after attempting to
     * create a new company record in the res_company table. If the creation is successful, a success
     * message is flashed with the company name, and if there is an error, an error message with the
     * exception message is flashed.
     */
    public function update(Request $request, $id)
    {

        $company = res_company::find($id);

        $this->validate($request, [
            'company_name' => 'required|string|max:50',
            'currency_id' => 'required'
        ]);

        $image_64 = $request->photo;
        $imageName = null;
        $path = null;
        $display_name = $request->company_name;
        if ($image_64 != null) {

            if (!empty ($company->photo))
                if (Storage::exists($company->photo)) {
                    Storage::delete($company->photo);
                }

            $imageName = time() . '.' . $request->photo->extension();
            $path = $request->file('photo')->storeAs('/upload/company', $imageName, 'public');
        }

        try {
            $data = $request->all();
            $data['display_name'] = $display_name;
            $data['photo'] = $path;

            $company->update($data);

            Session::flash('success', "Company $request->company_name Updated Successfully");
            return redirect()->back();

        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage() . 'Something Wrong');
            return redirect()->back();
        }
    }

}
