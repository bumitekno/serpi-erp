@extends('customer::layouts.master')

@push('modals')
    <div class="modal fade" tabindex="-1" id="kt_modal_customer">
        <form id="kt_docs_formvalidation_text" class="form" action="{{ route('customer.cardstore') }}" autocomplete="off"
            method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id_customer" value="{{ $customer->id }}" />

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add Card Member </h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Number Card</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="number" name="number_card_input"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Insert Number Card  "
                                required />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="kt_docs_formvalidation_text_submit">Save changes
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endpush

@push('modals')
    <div class="modal fade" tabindex="-1" id="kt_modal_topup_withdraw">
        <form id="kt_docs_formvalidation_text" class="form" action="{{ route('customer.storetranscard') }}"
            autocomplete="off" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Top Up / Withdraw Card Member </h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">

                        <div class="fv-row mb-10">
                            <select class="form-select form-select-sm form-select-solid" data-control="select2"
                                data-placeholder="Select Departement " name="departement" required
                                data-dropdown-parent="#kt_modal_topup_withdraw">
                                <option></option>
                                @forelse($departement as $departements)
                                    <option value="{{ $departements->id }}">{{ $departements->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>

                        <div class="fv-row mb-10">
                            <select class="form-select form-select-sm form-select-solid" data-control="select2"
                                data-placeholder="Select Type" name="typetrans" required
                                data-dropdown-parent="#kt_modal_topup_withdraw">
                                <option></option>
                                <option value="topup">Top Up</option>
                                <option value="withdraw">Withdraw</option>
                            </select>
                        </div>

                        <div class="fv-row mb-10">
                            <select class="form-select form-select-sm form-select-solid" data-control="select2"
                                data-placeholder="Select Card Member " name="cardmember" required
                                data-dropdown-parent="#kt_modal_topup_withdraw">
                                <option></option>
                                @forelse($card_active as $card_actives)
                                    <option value="{{ $card_actives->id }}">{{ $card_actives->number_card }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nominal</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="nominal_card_input"
                                class="form-control form-control-solid mb-3 mb-lg-0 kt_inputmask" placeholder="0"
                                required />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="kt_docs_formvalidation_text_submit">Save changes
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endpush

@section('content')
    <div class="d-flex flex-column flex-xl-row">
        <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
            <!--begin::Card-->
            <div class="card mb-5 mb-xl-8">
                <div class="card-header mt-3">
                    <div class="float-start">
                        <a href="{{ route('customer.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                    <div class="float-end">
                        Customer Information
                    </div>
                </div>
                <!--begin::Card body-->
                <div class="card-body pt-15">
                    <!--begin::Summary-->
                    <div class="d-flex flex-center flex-column mb-5">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            @if (!empty($customer->image))
                                <img src="{{ Storage::url($customer->image) }}" alt="Customer" class="w-80" />
                            @else
                                <img src="https://fakeimg.pl/100x100" alt="Customer" class="w-80" />
                            @endif
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#"
                            class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">{{ $customer->name }}</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fs-5 fw-bold text-muted mb-6">{{ $customer?->contact }}</div>
                        <!--end::Position-->
                    </div>
                    <!--end::Summary-->
                    <!--begin::Details toggle-->
                    <div class="d-flex flex-stack fs-4 py-3">
                        <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse"
                            href="#kt_customer_view_details" role="button" aria-expanded="false"
                            aria-controls="kt_customer_view_details">Details
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
                            <div class="text-gray-600">{{ $customer?->code }}</div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bolder mt-5">Billing Email</div>
                            <div class="text-gray-600">
                                <a href="#" class="text-gray-600 text-hover-primary">{{ $customer?->email }}</a>
                            </div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bolder mt-5">Billing Address</div>
                            <div class="text-gray-600"> {{ $customer?->address }}
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
            <div class="card mb-3">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Information Card Member
                    </div>
                    <div class="float-end text-info">
                        <a href="javascript:;" class="btn btn-bg-light btn-icon-info btn-text-info mb-2"
                            data-bs-toggle="modal" data-bs-target="#kt_modal_customer">

                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table">
                            <thead>
                                <th>#</th>
                                <th> Number Card </th>
                                <th> Date</th>
                                <th> Balance</th>
                                <th> Status</th>
                                <th> Action</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Information Transaction Card Member
                    </div>
                    <div class="float-end text-info">
                        <a href="javascript:;" class="btn btn-bg-light btn-icon-info btn-text-info mb-2"
                            data-bs-toggle="modal" data-bs-target="#kt_modal_topup_withdraw">

                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table-trans">
                            <thead>
                                <th>#</th>
                                <th> Number Card </th>
                                <th> Date</th>
                                <th> Nominal</th>
                                <th> Type</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
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
                ajax: "{{ route('customer.cardview', $customer->id) }}",
                order: [],
                columnDefs: [{
                    "targets": [0]
                }],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'number_card',
                        name: 'number_card'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'balance',
                        name: 'balance'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });


            // Currency
            Inputmask({
                "numericInput": true,
                "clearMaskOnLostFocus": true,
                "removeMaskOnSubmit": true,
                "placeholder": "",
                "autoUnmask": true,
                'digits': 0,
                'rightAlign': false,
                'allowMinus': false,
                'alias': 'currency',
                'groupSeparator': '.'
            }).mask(".kt_inputmask");

            var table2 = $('.data-table-trans').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customer.ajax_trans_viewcard', ['customerid' => $customer->id]) }}",
                order: [],
                columnDefs: [{
                    "targets": [0]
                }],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'number_card',
                        name: 'number_card'
                    },
                    {
                        data: 'date_trans',
                        name: 'date_trans'
                    },
                    {
                        data: 'nominal',
                        name: 'nominal'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                ]
            });

        });
    </script>
@endpush
