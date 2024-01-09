@extends('template')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                        <label for="roles"
                            class="col-md-4 col-form-label text-md-end text-start"><strong>Permissions:</strong></label>
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Permission Module</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($modules as $module)
                                    <tr>
                                        <td>
                                            <h3>{{ Str::title($module['module']) }}</h3>
                                        </td>
                                    </tr>
                                    @foreach (\Spatie\Permission\Models\Permission::where('module', $module['module'])->get() as $perm)
                                        <tr>
                                            <td>{{ Str::title(Str::replace('-', ' ', $perm->name)) }}</td>
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
