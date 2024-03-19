<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\Departement;
use App\Models\User;
use App\Models\Supplier;
use App\Models\TransCardMember;
use Modules\CategoryProduct\app\Models\CategoryProduct;
use Modules\Income\app\Models\TransactionIncome;
use Modules\Expense\app\Models\TransactionExpense;
use Modules\Sales\app\Models\TransactionSales;
use Modules\Sales\app\Models\SalesCredit;
use Modules\Sales\app\Models\Shipping;
use Modules\Purchase\app\Models\PurchaseCredit;
use Modules\Purchase\app\Models\TransactionPurchase;
use Modules\Warehouse\app\Models\Warehouse;
use Modules\ProductPos\app\Models\ProductPos;
use Modules\Location\app\Models\Location;
use App\Models\Apps\ir_model;
use App\Helpers\Addons;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    //
    /**
     * Instantiate a new HomeController instance.
     */
    public function __construct()
    {
        $this->middleware('permission:statistic', ['only' => ['statistic']]);
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('home')->with([]);
    }

    /**
     * The function "checkroute" in PHP checks for a specific module and returns its routes or redirects
     * based on the module's existence.
     * 
     * @param `module The `module` parameter in the `checkroute` function is used to determine the route
     * and group modules for a specific module in the system. The function first checks if the provided
     * module exists in the permissions table. If it does, it retrieves the routes associated with that
     * module.
     * 
     * @return `The function `checkroute` is returning either a view with data (`nav_route` and
     * `group_module`) if multiple routes are found for the given module, or it is redirecting to a
     * specific route based on the module name if only one route is found. If the module is not found in
     * the database, it returns a 403 error with a message indicating that the module was not found.
     */

    public function checkroute($module)
    {
        $group_modules = Permission::select('group_modules')->distinct()->orderBy('group_modules')->where('group_modules', '=', $module)->first();
        if (!empty ($group_modules)) {
            $route = Permission::select('module', 'group_modules')->distinct()->where('group_modules', $module)->orderBy('module')->get();
            if (count($route) > 1) {
                return view('module_list')->with(['nav_route' => $route, 'group_module' => $module]);
            } else {
                $text_route = strtolower(Str::replace('_', '', $route[0]->module));
                return redirect()->route($text_route . '.index');
            }

        } else {
            return abort(403, 'Module' . $module . ' not found !');
        }
    }

    /** statistic */
    public function statistic()
    {

        //statistic sales 
        $total_success_chart_sales = TransactionSales::where('saved_trans', '=', '0')->where('status', '=', '1')->select(DB::raw("CAST(SUM(total_transaction) as int ) as total_success"))
            ->GroupBy(DB::raw("Month(date_sales)"))
            ->pluck('total_success');

        $total_cancel_chart_sales = TransactionSales::where('saved_trans', '=', '0')->where('status', '=', '0')->where('note', '=', 'cancel')->select(DB::raw("CAST(SUM(total_transaction) as int )as total_failed"))
            ->GroupBy(DB::raw("Month(date_sales)"))
            ->pluck('total_failed');

        $total_pending_chart_sales = TransactionSales::where('saved_trans', '=', '0')->where('status', '=', '0')->where('id_method_payment', '=', '3')->select(DB::raw("CAST(SUM(total_transaction) as int )as total_pending"))
            ->GroupBy(DB::raw("Month(date_sales)"))
            ->pluck('total_pending');

        $bulan_sales = TransactionSales::select(DB::raw("MONTHNAME(date_sales) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(date_sales)"))
            ->pluck('bulan');

        //satistic purchase 
        $total_success_chart_purchase = TransactionPurchase::where('status', '=', '1')->select(DB::raw("CAST(SUM(amount) as int ) as total_success"))
            ->GroupBy(DB::raw("Month(date_purchase)"))
            ->pluck('total_success');

        $total_cancel_chart_purchase = TransactionPurchase::where('status', '=', '0')->where('note', '=', 'cancel')->select(DB::raw("CAST(SUM(amount) as int )as total_failed"))
            ->GroupBy(DB::raw("Month(date_purchase)"))
            ->pluck('total_failed');

        $total_pending_chart_purchase = TransactionPurchase::where('status', '=', '0')->where('id_method_payment', '=', '3')->select(DB::raw("CAST(SUM(amount) as int )as total_pending"))
            ->GroupBy(DB::raw("Month(date_purchase)"))
            ->pluck('total_pending');

        $bulan_purchase = TransactionPurchase::select(DB::raw("MONTHNAME(date_purchase) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(date_purchase)"))
            ->pluck('bulan');

        // statistik income 

        $bulan_income = TransactionIncome::select(DB::raw("MONTHNAME(date_transaction) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(date_transaction)"))
            ->pluck('bulan');

        $total_income = TransactionIncome::select(DB::raw("CAST(SUM(amount) as int )as total_income"))
            ->GroupBy(DB::raw("Month(date_transaction)"))
            ->pluck('total_income');

        //statistik expense 

        $bulan_expense = TransactionExpense::select(DB::raw("MONTHNAME(date_transaction) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(date_transaction)"))
            ->pluck('bulan');

        $total_expense = TransactionExpense::select(DB::raw("CAST(SUM(amount) as int )as total_expense"))
            ->GroupBy(DB::raw("Month(date_transaction)"))
            ->pluck('total_expense');

        //product terlaris 
        $product_top = DB::table('product_pos')
            ->select([
                'product_pos.id',
                'product_pos.name',
                'product_pos.code_product',
                DB::raw('CAST(SUM(transaction_item_sales.qty_convert) as int ) as total_sales'),
                DB::raw('CAST(SUM(transaction_item_sales.qty_convert * product_pos.price_sell) as int) AS total_price'),
            ])
            ->join('transaction_item_sales', 'transaction_item_sales.id_product', '=', 'product_pos.id')
            ->join('transaction_sales', 'transaction_item_sales.id_transaction_sales', '=', 'transaction_sales.id')
            ->where('transaction_sales.saved_trans', '=', '0')->where('transaction_sales.status', '=', '1')
            ->groupBy('product_pos.id', 'product_pos.name', 'product_pos.code_product')
            ->orderByDesc('total_sales')
            ->get();

        $data = [
            'chart_month_sales' => $bulan_sales,
            'chart_success_sales' => $total_success_chart_sales,
            'chart_cancel_sales' => $total_cancel_chart_sales,
            'chart_pending_sales' => $total_pending_chart_sales,
            'chart_month_purchase' => $bulan_purchase,
            'chart_success_purchase' => $total_success_chart_purchase,
            'chart_cancel_purchase' => $total_cancel_chart_purchase,
            'chart_pending_purchase' => $total_pending_chart_purchase,
            'chart_month_income' => $bulan_income,
            'chart_success_income' => $total_income,
            'chart_month_expense' => $bulan_expense,
            'chart_success_expense' => $total_expense,
            'count_departement' => Departement::count(),
            'count_customer' => Customer::count(),
            'count_supplier' => Supplier::count(),
            'count_category_product' => CategoryProduct::count(),
            'count_warehouse' => Warehouse::count(),
            'count_product' => ProductPos::count(),
            'count_user' => User::count(),
            'count_location' => Location::count(),
            'top_product' => $product_top,
            'sum_trans_member' => TransCardMember::sum('nominal'),
            'sum_trans_top_up' => TransCardMember::where('type', 'topup')->sum('nominal'),
            'sum_trans_wd' => TransCardMember::where('type', 'withdraw')->sum('nominal'),
            'sales_credit' => SalesCredit::sum('amount'),
            'purchase_credit' => PurchaseCredit::sum('amount'),
            'tracking_shipment' => Shipping::with('sales')->latest()->limit(10)->get()
        ];

        return view('statistic')->with($data);
    }

    /** Addons */
    public function Addons(Request $request)
    {

        if (!empty ($request->filter)) {
            $data = ir_model::where('state', 'base')->where('technical_name', 'like', '%' . $request->filter . '%')->orWhere('instalation', '=', $request->installed)->orderBy('name', 'ASC')->paginate(12);
        } else if (!empty ($request->installed)) {
            $data = ir_model::where('state', 'base')->Where('instalation', '=', $request->installed)->orderBy('instalation', 'ASC')->paginate(12);
        } else {
            $data = ir_model::where('state', 'base')->orderBy('name', 'ASC')->paginate(12);
        }

        return view('addons')->with(['data' => $data, 'filter' => $request->filter, 'installation' => $request->installed]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function install($id)
    {
        $data = ir_model::where('model', $id)->first();

        try {
            if (class_exists($data->technical_name)) {
                $data->technical_name::installed();
                $data->update([
                    'instalation' => True,
                ]);
                Session::flash('success', 'Addons ' . $data->name . ' successfully installed');
                return redirect()->back();
            } else {
                throw new \Exception(" , " . $data->technical_name . ' Not Found, Under Maintance Development  !', 1);
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Addons ' . $data->name . ' failed installed  ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uninstall($id)
    {
        try {
            $data = ir_model::where('model', $id)->first();
            $data->technical_name::uninstalled();
            $data->update([
                'instalation' => false,
            ]);
            Session::flash('success', 'Addons ' . $data->name . ' successfully uninstall');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('error', 'Addons ' . $data->name . ' failed uninstall' . $e->getMessage() . 'Something Wrong');
            return redirect()->back();
        }
    }


    /**
     * The function "check_installed" checks if modules are installed and returns a JSON response with
     * the result.
     * 
     * @param $request The `check_installed` function appears to be a part of a PHP Laravel application.
     * It takes a `` parameter and calls the `cek_install_modules` method from the `Addons`
     * class with this parameter.
     * 
     * @return ` JSON response with a status of 'success' and the result of the
     * Addons::cek_install_modules() function call, returned as the 'result' field.
     */

    public function check_installed($request)
    {
        $response = Addons::cek_install_modules($request);

        return response()->json([
            'status' => 'success',
            'result' => $response,
        ], 200);
    }

}
