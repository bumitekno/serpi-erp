@extends('stock::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                <a href="{{ route('stock.index') }}" class="btn btn-primary btn-sm me-2">&larr; Back</a> Create Stock Purchase
            </div>
            <div class="float-end">

                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-3 position-absolute ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
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
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table-datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> Code </th>
                            <th> Date</th>
                            <th> Transfer</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(function() {

            var table = $('#table-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('stock.createstockp') }}",
                order: [],
                columnDefs: [{
                    "targets": [0]
                }],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'code_transaction',
                        name: 'code_transaction'
                    },
                    {
                        data: 'date_purchase',
                        name: 'date_purchase'
                    },
                    {
                        data: 'transfer_stock',
                        name: 'transfer_stock'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
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
