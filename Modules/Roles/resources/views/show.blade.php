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
                                                    {{ Str::title(Str::replace('-', ' ', $perm->group_modules)) }} </span>
                                            </td>
                                            <td> <span class="p-3">
                                                    {{ Str::title(Str::replace('-', ' ', $perm->module)) }} </span>
                                            </td>
                                            <td> <span class="p-3">
                                                    {{ Str::title(Str::replace('-', ' ', $perm->name)) }} </span>
                                            </td>
                                            <td><input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                                                    {{ $role->hasPermissionTo($perm->name) ? 'checked' : null }} disabled />
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
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
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
                                        '<tr class="group fw-bolder "><td colspan="4">' +
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
    </script>
@endpush
