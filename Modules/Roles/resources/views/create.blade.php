@extends('template')

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="float-start">
                <h3 class="fw-bolder me-5 my-1"> Add Role </h3>
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
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Insert Name Roles">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">

                            <div class="table-responsive">

                                <table class="table @error('permissions') is-invalid @enderror table-row-bordered"
                                    id="kt_table_roles">
                                    <thead>
                                        <tr>
                                            <th>Group </th>
                                            <th>Modules </th>
                                            <th>Permission </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
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
                                                    <td><input type="checkbox" name="permissions[]"
                                                            value="{{ $perm->id }}"
                                                            {{ in_array($perm->id, old('permissions') ?? []) ? 'checked' : null }} />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </table>

                                @if ($errors->has('permissions'))
                                    <span class="text-danger">{{ $errors->first('permissions') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Role">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
