@extends('supplier::layouts.master')

@section('content')
    <div class="d-flex flex-column flex-xl-row">
        <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
            <!--begin::Card-->
            <div class="card mb-5 mb-xl-8">
                <div class="card-header mt-3">
                    <div class="float-start">
                        <a href="{{ route('supplier.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                    <div class="float-end">
                        Supplier Information
                    </div>
                </div>
                <!--begin::Card body-->
                <div class="card-body pt-15">
                    <!--begin::Summary-->
                    <div class="d-flex flex-center flex-column mb-5">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            @if (!empty($supplier->image))
                                <img src="{{ Storage::url($supplier->image) }}" alt="Customer" class="w-80" />
                            @else
                                <img src="https://fakeimg.pl/100x100" alt="Customer" class="w-80" />
                            @endif
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#"
                            class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">{{ $supplier->name }}</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fs-5 fw-bold text-muted mb-6">{{ $supplier?->contact }}</div>
                        <!--end::Position-->

                    </div>
                    <!--end::Summary-->
                    <!--begin::Details toggle-->
                    <div class="d-flex flex-stack fs-4 py-3">
                        <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_customer_view_details"
                            role="button" aria-expanded="false" aria-controls="kt_customer_view_details">Details
                            <span class="ms-2 rotate-180">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                    </div>
                    <!--end::Details toggle-->
                    <div class="separator separator-dashed my-3"></div>
                    <!--begin::Details content-->
                    <div id="kt_customer_view_details" class="collapse show">
                        <div class="py-5 fs-6">

                            <div class="fw-bolder mt-5">Account ID</div>
                            <div class="text-gray-600">{{ $supplier?->code }}</div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bolder mt-5">Billing Email</div>
                            <div class="text-gray-600">
                                <a href="#" class="text-gray-600 text-hover-primary">{{ $supplier?->email }}</a>
                            </div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bolder mt-5">Billing Address</div>
                            <div class="text-gray-600"> {{ $supplier?->address }}
                            </div>

                            <!--begin::Details item-->
                        </div>
                    </div>
                    <!--end::Details content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <div class="flex-lg-row-fluid ms-lg-15">
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
