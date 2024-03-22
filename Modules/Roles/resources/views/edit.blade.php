@extends('template')
@section('content')
    <form action="{{ route('roles.update', $role->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="card mb-3">
            <div class="card-body">
                <div class="float-start">
                    <h3 class="fw-bolder me-5 my-1"> Role Information </h3>
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
                                    id="name" name="name" value="{{ $role->name }}">
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
                                            $l = \Spatie\Permission\Models\Permission::select('module', 'group_modules')
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
                                                            {{ $role->hasPermissionTo($perm->name) ? 'checked' : null }} />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach

                                    @empty
                                    @endforelse

                                </tbody>
                            </table>

                            @if ($errors->has('permissions'))
                                <span class="text-danger">{{ $errors->first('permissions') }}</span>
                            @endif
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
            $(function() {
                var groupColumn = 0;
                var table = $('.table').DataTable({
                    columnDefs: [{
                        visible: false,
                        targets: groupColumn
                    }],
                    order: [
                        [groupColumn, 'asc']
                    ],
                    displayLength: 25,
                    drawCallback: function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;

                        api.column(groupColumn, {
                                page: 'current'
                            })
                            .data()
                            .each(function(group, i) {
                                if (last !== group) {
                                    $(rows)
                                        .eq(i)
                                        .before(
                                            '<tr class="group fw-bolder"><td colspan="4">' +
                                            group +
                                            '</td></tr>'
                                        );

                                    last = group;
                                }
                            });
                    }
                });
            });

            // Order by the grouping
            $('.table tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                    table.order([groupColumn, 'desc']).draw();
                } else {
                    table.order([groupColumn, 'asc']).draw();
                }
            });
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
