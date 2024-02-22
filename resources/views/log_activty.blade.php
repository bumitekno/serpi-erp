@extends('template')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-3 position-absolute ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" id="kt_filter_search" data-kt-table-filter="search"
                        class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Search Code">
                </div>
            </div>
            <div class="float-end">
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm me-3 ">&larr; Back</a>
                <a href="{{ route('log-activity.removeAllActivity') }}" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure to empty all log activity?')"> <i class="bi bi-trash"></i> Empty
                    All</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <h3 class="text-dark">Log Activity</h3>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Log</th>
                            <th>Description</th>
                            <th> Event </th>
                            <th> Couser ID </th>
                            <th> Couser Type </th>
                            <th> Properties </th>
                            <th> Created </th>
                            <th> Update </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('log-activity.index') }}",
                order: [],
                columnDefs: [{
                    "targets": [0]
                }],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'log_name',
                        name: 'log_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'event',
                        name: 'event'
                    },
                    {
                        data: 'causer_id',
                        name: 'causer_id'
                    },
                    {
                        data: 'causer_type',
                        name: 'causer_type'
                    },
                    {
                        data: 'properties',
                        name: 'properties'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });

            document.querySelector('[data-kt-table-filter="search"]').addEventListener(
                "keyup",
                function(t) {
                    table.search(t.target.value).draw();
                });

        });
    </script>
@endpush
