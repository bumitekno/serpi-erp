@extends('template')

@section('content')
    <form action="{{ route('roles.store') }}" method="post">
        @csrf
        <div class="card mb-3">
            <div class="card-body">
                <div class="float-start">
                    <h3 class="fw-bolder me-5 my-1"> Add Role </h3>
                </div>
                <div class="float-end">
                    <div class="d-flex">
                        <a href="{{ route('roles.index') }}" class="btn btn-dark btn-sm me-3">&larr; Back</a>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

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
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="" id="checkedAll" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    All Permission
                                </label>
                            </div>
                        </div>

                        <div class="mb-3 row">

                            <div class="table-responsive">

                                <table class="table @error('permissions') is-invalid @enderror table-row-bordered"
                                    id="kt_table_roles">
                                    <thead>
                                        <tr>
                                            <th>Group </th>
                                            <th>Modules</th>
                                            <th>Permission </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($group_modules as $groups)
                                            @php
                                                $l = \Spatie\Permission\Models\Permission::select(
                                                    'module',
                                                    'group_modules',
                                                )
                                                    ->distinct()
                                                    ->where('group_modules', $groups['group_modules'])
                                                    ->orderBy('group_modules')
                                                    ->get();
                                            @endphp

                                            @foreach ($l as $module)
                                                @php
                                                    $x = \Spatie\Permission\Models\Permission::where(
                                                        'module',
                                                        $module['module'],
                                                    )->get();
                                                @endphp

                                                @foreach ($x as $perm)
                                                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                                        <td> <span class="p-3">
                                                                {{ Str::title(Str::replace('-', ' ', $perm->group_modules)) }}
                                                            </span>
                                                        </td>
                                                        <td> <span class="p-3">
                                                                {{ Str::title(Str::replace('-', ' ', $perm->module)) }}
                                                            </span>
                                                        </td>
                                                        <td> <span class="p-3">
                                                                {{ Str::title(Str::replace('-', ' ', $perm->name)) }}
                                                            </span>
                                                        </td>
                                                        <td><input type="checkbox" name="permissions[]" class="checkSingle"
                                                                value="{{ $perm->id }}"
                                                                {{ in_array($perm->id, old('permissions') ?? []) ? 'checked' : null }} />
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach

                                        @empty
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($errors->has('permissions'))
                            <span class="text-danger">{{ $errors->first('permissions') }}</span>
                        @endif
                        <div class="mb-3 row">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(function() {
            $('.table').DataTable();
            $("#checkedAll").change(function() {
                if (this.checked) {
                    $(".checkSingle").each(function() {
                        this.checked = true;
                    });
                } else {
                    $(".checkSingle").each(function() {
                        this.checked = false;
                    });
                }
            });
        });
    </script>
@endpush
