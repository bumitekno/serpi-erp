@extends('template')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Role Information
                    </div>
                    <div class="float-end">
                        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name"
                            class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $role->name }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <table class="table table-row-bordered">
                                <thead>
                                    <tr>
                                        <th>Permission Module</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($modules as $module)
                                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                        <td>
                                            <h3>{{ Str::title(Str::replace('_', ' ', $module['module'])) }}</h3>
                                        </td>
                                    </tr>
                                    @foreach (\Spatie\Permission\Models\Permission::where('module', $module['module'])->get() as $perm)
                                        <tr>
                                            <td><span class="p-3">
                                                    {{ Str::title(Str::replace('-', ' ', $perm->name)) }} </span></td>
                                            <td><input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                                                    {{ $role->hasPermissionTo($perm->name) ? 'checked' : null }} disabled />
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
