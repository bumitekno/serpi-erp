@extends('template')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Edit Role
                    </div>
                    <div class="float-end">
                        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ $role->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-12">
                                <table class="table table-row-bordered ">
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
                                                        {{ $role->hasPermissionTo($perm->name) ? 'checked' : null }} /></td>
                                            </tr>
                                        @endforeach
                                    @endforeach

                                </table>

                                @if ($errors->has('permissions'))
                                    <span class="text-danger">{{ $errors->first('permissions') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Role">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
