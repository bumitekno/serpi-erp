@extends('customer::layouts.master')

@section('content')
    <div class="row g-5 g-xl-8 justify-content-center">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        <a href="{{ route('customer.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                    <div class="float-end">
                        Customer Information
                    </div>
                </div>
                <div class="card-body">

                    <div class="mb-3 row">
                        <div class="symbol-label symbol symbol-circle symbol-100px text-center">
                            @if (!empty($customer->image))
                                <img src="{{ Storage::url($customer->image) }}" alt="Customer" class="w-80" />
                            @else
                                <img src="https://fakeimg.pl/100x100" alt="Customer" class="w-80" />
                            @endif
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Name:</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $customer->name }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Contact
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $customer?->contact }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Email
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $customer?->email }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="description"
                            class="col-lg-4 fw-bold text-muted text-end"><strong>Address:</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $customer?->address }} </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Information Transaction
                    </div>
                    <div class="float-end text-info">
                        {{ number_format($total_transaction, 0, ',', '.') }}
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered data-table">
                        <thead>
                            <th>#</th>
                            <th> Code </th>
                            <th> Date</th>
                            <th> Total</th>
                            <th> Amount</th>
                            <th> Departement </th>
                            <th> Method</th>
                        </thead>
                        <tbody>
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
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customer.show', $customer->id) }}",
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
                        data: 'date_transaction',
                        name: 'date_transaction'
                    },
                    {
                        data: 'total_transaction',
                        name: 'total_transaction'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'departement',
                        name: 'departement'
                    },
                    {
                        data: 'methodpayment',
                        name: 'methodpayment'
                    }
                ]
            });

        });
    </script>
@endpush
