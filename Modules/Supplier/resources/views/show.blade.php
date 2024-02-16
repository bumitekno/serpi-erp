@extends('supplier::layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-4 mb-10">

            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Supplier Information
                    </div>
                    <div class="float-end">
                        <a href="{{ route('supplier.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="mb-3 row">
                        <label for="avatar" class="col-lg-4 fw-bold text-muted text-end"><strong>Image:</strong></label>
                        <div class="col-md-8">
                            <div class="symbol-label symbol symbol-circle symbol-150px">
                                @if (!empty($supplier->image))
                                    <img src="{{ Storage::url($supplier->image) }}" alt="Supplier" class="w-100" />
                                @else
                                    <img src="https://fakeimg.pl/100x100" alt="Supplier" class="w-100" />
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Name:</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $supplier?->name }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Contact
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $supplier?->contact }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Email
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $supplier?->email }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="description"
                            class="col-lg-4 fw-bold text-muted text-end"><strong>Address:</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $supplier?->address }} </span>
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
                ajax: "{{ route('supplier.show', $supplier->id) }}",
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
