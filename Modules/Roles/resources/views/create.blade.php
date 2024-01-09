@extends('template')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Add New Role
                    </div>
                    <div class="float-end">
                        <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="permissions"
                                class="col-md-4 col-form-label text-md-end text-start">Permissions</label>
                            <div class="col-md-6">

                                <table class="table @error('permissions') is-invalid @enderror">
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
                                                        {{ in_array($perm->id, old('permissions') ?? []) ? 'checked' : null }} />
                                                </td>
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
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Role">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
