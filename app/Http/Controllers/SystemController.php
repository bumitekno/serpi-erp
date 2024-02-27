<?php

namespace App\Http\Controllers;

use App\Models\TransCardMember;
use App\Models\User;
use App\Models\SettingApp;
use Illuminate\Http\Request;
use Modules\Expense\app\Models\TransactionExpense;
use Modules\Income\app\Models\TransactionIncome;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Console\Commands\DatabaseBackup;
use App\Jobs\DatabaseRestore;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Modules\Sales\app\Models\BalanceSales;
use Modules\Sales\app\Models\SalesCredit;
use Modules\Sales\app\Models\TransactionSales;
use Modules\Sales\app\Models\TransactionSalesItem;
use Modules\Purchase\app\Models\PurchaseCredit;
use Modules\Purchase\app\Models\TransactionPurchase;
use Modules\Purchase\app\Models\TransactionPurchaseItem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;


class SystemController extends Controller
{
    //
    /**
     * Instantiate a new SalesController instance.
     */
    public function __construct()
    {
        $this->middleware('permission:log-activity', ['only' => ['index', 'destroy']]);
        $this->middleware('permission:setting-aplication', ['only' => ['settingApps']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data_log = Activity::query()->latest()->get();
            return DataTables::of($data_log)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return empty($row->created_at) ? '-' : Carbon::parse($row->created_at)->translatedFormat('d F Y');
                })
                ->editColumn('updated_at', function ($row) {
                    return empty($row->updated_at) ? '-' : Carbon::parse($row->updated_at)->translatedFormat('d F Y');
                })
                ->editColumn('properties', function ($row) {
                    return empty($row->properties) ? '-' : json_encode($row->properties);
                })
                ->editColumn('causer_id', function ($row) {
                    return empty($row->causer_id) ? '-' : User::find($row->causer_id)?->name;
                })
                ->editColumn('action', function ($row) {
                    $btn = '<a href="' . route('log-activity.destroy', ['id' => $row->id, 'status' => 0]) . '" class="btn btn-danger btn-sm" onclick="return confirm(`Are you sure to delete  this log ?`)"> <i class="bi bi-trash"></i>  Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('log_activty');
    }

    /** remove log activity */
    public function destroy($id)
    {
        Activity::find($id)->delete();
        Session::flash('success', 'Log delete is successfully');
        return redirect()->back();
    }

    /** remove all log activity */
    public function removeAllActivity()
    {
        Activity::query()->delete();
        Session::flash('success', 'Log delete is successfully');
        return redirect()->back();
    }

    /** public function Setting  */

    public function settingApps()
    {
        $setting = SettingApp::latest()->first();
        return view('settingapp')->with(['settings' => $setting]);
    }

    /** store app */
    public function settingStore(Request $request)
    {

        $input = [
            'title' => $request->title,
            'keywords' => $request->keyword,
            'description' => $request->description,
            'footer' => $request->footer
        ];

        if ($request->hasFile('avatar')) {
            $checlogo = SettingApp::find($request->id_settings);
            if (!empty($checlogo->logo))
                if (Storage::exists($checlogo->logo)) {
                    Storage::delete($checlogo->logo);
                }
            $imageName = time() . '.' . $request->avatar->extension();
            $path = $request->file('avatar')->storeAs('/upload/icon/web', $imageName, 'public');
            $input['logo'] = $path;
        }

        SettingApp::updateOrCreate(
            [
                'id' => $request->id_settings,
            ],
            $input
        );
        Session::flash('success', 'Setting Apps  is change successfully');
        return redirect()->back();
    }

    public function backupdatabase(Dispatcher $dispatcher)
    {
        // Artisan::call('db:backup');
        $backup = new DatabaseBackup();
        $dispatcher->dispatchNow($backup);

        $userModel = Auth::user()->id;
        $user = User::find($userModel);
        activity()
            ->causedBy($userModel)
            ->performedOn($user)
            ->tap(function (Activity $activity) use ($user) {
                $activity->log_name = ' User ' . $user->name . ' backup  file database ';
            })
            ->withProperties(['name' => $user->name])
            ->event('backup')
            ->log('backup');

        Session::flash('info', $backup->getResponse());
        return redirect()->back();
    }

    public function restoredatabase(Request $request, Dispatcher $dispatcher)
    {
        if ($request->hasFile('file')) {
            $filename = time() . '.' . $request->file->extension();
            $path = $request->file('file')->storeAs('restore', $filename);
            $storage_path = storage_path() . "/app/" . $path;
            $restore = new DatabaseRestore($storage_path);
            $dispatcher->dispatchNow($restore);
            if ($dispatcher) {
                File::delete($storage_path);
            }
            Session::flash('info', $restore->getResponse());
            return redirect()->back();
        }
    }

    /** download backup */
    public function download($storage)
    {
        return response()->download(storage_path('/app/backup/' . $storage));
    }

    /** reset Transaction  */

    public function reset_trans()
    {

        if (Schema::hasTable('balance_sales')) {
            BalanceSales::truncate();
        }

        if (Schema::hasTable('transaction_sales_credit')) {
            SalesCredit::truncate();
        }

        if (Schema::hasTable('transaction_sales')) {
            TransactionSales::truncate();
        }

        if (Schema::hasTable('transaction_item_sales')) {
            TransactionSalesItem::truncate();
        }

        if (Schema::hasTable('transaction_purchase')) {
            TransactionPurchase::truncate();
        }

        if (Schema::hasTable('transaction_item_purchase')) {
            TransactionPurchaseItem::truncate();
        }

        if (Schema::hasTable('transaction_purchase_credit')) {
            TransCardMember::truncate();
        }

        if (Schema::hasTable('transaction_card_member')) {
            PurchaseCredit::truncate();
        }

        if (Schema::hasTable('transaction_income')) {
            TransactionIncome::truncate();
        }

        if (Schema::hasTable('transaction_expense')) {
            TransactionExpense::truncate();
        }


        Session::flash('info', "Reset Transaction is successfully.");
        return redirect()->back();
    }

    /** reset data  master */
    public function reset_datamaster()
    {
        Artisan::call('migrate:fresh --seed');
        Artisan::call('config:clear');
        Session::flash('info', "Reset Data is successfully.");
        return redirect()->back();
    }

}
