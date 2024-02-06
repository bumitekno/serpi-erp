@extends('stock::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Create Stock Purchase
            </div>
            <div class="float-end">
                <a href="{{ route('stock.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
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
                            <th class="text-end">Action</th>
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@endpush
