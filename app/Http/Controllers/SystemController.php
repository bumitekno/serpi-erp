<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SettingApp;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
                    $btn = '<a href="' . route('log-activity.destroy', ['id' => $row->id, 'status' => 0]) . '" class="btn btn-danger btn-sm" onclick="return confirm(`Are you sure to delete  this log ?`)">Delete</a>';
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
            'description' => $request->description
        ];

        if (!empty($request->title))
            Session::put('title_web', $request->title);

        if (!empty($request->keyword))
            Session::put('keyword_web', $request->keyword);

        if (!empty($request->description))
            Session::put('description_web', $request->description);

        if ($request->hasFile('avatar')) {
            $checlogo = SettingApp::find($request->id_settings);
            if (!empty($checlogo->logo))
                if (Storage::exists($checlogo->logo)) {
                    Storage::delete($checlogo->logo);
                }
            $imageName = time() . '.' . $request->avatar->extension();
            $path = $request->file('avatar')->storeAs('/upload/icon/web', $imageName, 'public');
            $input['logo'] = $path;
            Session::put('logo', $input['logo']);
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

}
