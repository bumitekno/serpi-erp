@extends('template')

@section('content')
    <div class="card mb-3">
        <div class="card-header mt-3">
            <div class="d-flex flex-wrap flex-stack pb-7">
                <div class="d-flex flex-wrap align-items-center my-1">
                    <h3 class="fw-bolder me-5 my-1"> Role Information </h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="float-start">
                {{ $role->name }}
            </div>
            <div class="float-end">
                <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table @error('permissions') is-invalid @enderror table-row-bordered" id="kt_table_roles">
                        <thead>
                            <tr>
                                <th>Group </th>
                                <th>Modules </th>
                                <th>Permission </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($group_modules as $groups)
                                <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                    <td colspan="3">
                                        <h3>{{ Str::title(Str::replace('_', ' ', $groups['group_modules'])) }}</h3>
                                    </td>
                                </tr>
                                @php
                                    $l = \Spatie\Permission\Models\Permission::select('module', 'group_modules')
                                        ->distinct()
                                        ->where('group_modules', $groups['group_modules'])
                                        ->orderBy('group_modules')
                                        ->get();
                                @endphp
                                @foreach ($l as $module)
                                    @if (count($l) > 1)
                                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                            <td></td>
                                            <td colspan="2">
                                                <h3>{{ Str::title(Str::replace('_', ' ', $module['module'])) }}
                                                </h3>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                            <td colspan="3"></td>
                                        </tr>
                                    @endif
                                    @php
                                        $x = \Spatie\Permission\Models\Permission::where('module', $module['module'])->get();
                                    @endphp
                                    @foreach ($x as $perm)
                                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                            <td colspan="2"></td>
                                            <td> <span class="p-3">
                                                    {{ Str::title(Str::replace('-', ' ', $perm->name)) }} </span>
                                            </td>
                                            <td><input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                                                    {{ $role->hasPermissionTo($perm->name) ? 'checked' : null }} disabled />
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
