@extends('purchase::layouts.master')
@push('styles')
    <style>
        .fs-large {
            font-size: 3.75rem !important;
        }

        div.scrollmoney {
            overflow-x: auto;
            white-space: nowrap;
        }

        div.scrollmenu {
            white-space: nowrap;
            overflow-x: auto;
        }

        div.scrollmenu a {
            display: inline-block;
            color: white;
            text-align: center;
            text-decoration: none;
        }

        div.scrollmenu a:hover {
            background-color: #777;
        }
    </style>
@endpush

@push('modals')
    <div class="modal fade" tabindex="-1" id="kt_modal_openbalance">
        <div class="modal-dialog">
            <form id="kt_docs_formvalidation_text_t" class="form" action="{{ route('sales.storeopenbal') }}"
                autocomplete="off" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal Open Balance</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">

                        <div class="fv-row mb-10">
                            <label for="name" class="required fw-semibold fs-6 mb-2">Departement</label>
                            <select class="form-select" data-control="select2" data-placeholder="Select Departement"
                                name="departement_balance">
                                <option></option>
                                @foreach ($departement as $departementx)
                                    <option value="{{ $departementx->id }}"
                                        @if ($departement_default == $departementx->id) selected="selected" @endif>
                                        {{ $departementx->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-10">
                            <label for="name" class="required fw-semibold fs-6 mb-2">
                                Date</label>
                            <input type="date" class="form-control kt_datepicker" id="date" name="date_trans">
                        </div>

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Amount</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="amount_balance"
                                class="form-control form-control-solid mb-3 mb-lg-0 kt_inputmask"
                                placeholder="Insert Amount Balance " data-type="currency" required="required" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endpush

@push('modals')
    <div class="modal fade" tabindex="-1" id="kt_modal_customer">
        <form id="kt_docs_formvalidation_text" class="form" action="{{ route('sales.storecustomer') }}" autocomplete="off"
            method="POST">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add Customer </h3>

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
                            <label class="required fw-semibold fs-6 mb-2">Name</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="name_input" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Insert Name " />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="email" name="email_input" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="insert Email" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Contact</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="number" name="contact_input" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Insert Contact " />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Address</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <textarea name="address_input" class="form-control form-control-solid" placeholder="Insert Address"></textarea>
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
    <div class="modal fade" tabindex="-1" id="kt_modal_discount">
        <div class="modal-dialog">
            <form id="kt_docs_formvalidation_text_d" class="form" action="{{ route('sales.updateDiscount') }}"
                autocomplete="off" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal Discount</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Discount</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="discount" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Insert Discount " value="{{ number_format($discount_cart, 0, ',', '.') }}"
                                data-type="currency" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endpush

@push('modals')
    <div class="modal fade" tabindex="-1" id="kt_modal_tax">
        <div class="modal-dialog">
            <form id="kt_docs_formvalidation_text_t" class="form" action="{{ route('sales.updatetax') }}"
                autocomplete="off" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal Tax</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Tax</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="tax" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Insert tax " value="{{ number_format($tax_cart, 0, ',', '.') }}"
                                data-type="currency" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endpush

@push('modals')
    <div class="modal fade" tabindex="-1" id="kt_modal_edit_cart">
        <div class="modal-dialog">
            <form id="kt_docs_formvalidation_text_c" class="form" action="{{ route('sales.updatecart') }}"
                autocomplete="off" method="POST">
                @csrf

                <input type="hidden" name="id_cart" class="form-control form-control-solid mb-3 mb-lg-0" readonly />

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal Edit Cart Product </h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <!--begin::Input group-->
                        <div class="fv-row mb-3 row">
                            <!--begin::Label-->
                            <label class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <!--end::Label-->
                            <div class="col-md-8">
                                <!--begin::Input-->
                                <input type="text" name="name_cart"
                                    class="form-control form-control-solid mb-3 mb-lg-0" readonly />
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Input group-->

                        <div class="fv-row mb-3 row ">
                            <!--begin::Label-->
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Price
                                Unit</label>
                            <!--end::Label-->
                            <div class="col-md-8">
                                <!--begin::Input-->
                                <input type="text" name="price_cart"
                                    class="form-control form-control-solid mb-3 mb-lg-0" readonly />
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Input group-->

                        <div class="mb-3 row fv-row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Unit</label>
                            <div class="col-md-8">
                                <select class="form-select" data-control="select2" data-placeholder="Select Unit"
                                    name="units_cart" required="required">
                                    <option></option>
                                    @foreach ($unit as $units)
                                        <option value="{{ $units->id }}">
                                            {{ $units->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="fv-row mb-3 row ">
                            <!--begin::Label-->
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">QTY
                            </label>
                            <!--end::Label-->
                            <div class="col-md-8">
                                <!--begin::Input-->
                                <input type="number" name="qty_cart" class="form-control  mb-3 mb-lg-0" required />
                                <!--end::Input-->
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endpush

@push('modals')
    <div class="modal fade" tabindex="-1" id="kt_modal_payment">
        <div class="modal-dialog" id="modallg-append">
            <form id="kt_docs_formvalidation_text_p" class="form" action="{{ route('sales.store') }}"
                autocomplete="off" method="POST">
                @csrf

                <input type="hidden" name="number_invoice">
                <input type="hidden" name="date_invoice">
                <input type="hidden" name="customer_invoice">
                <input type="hidden" name="departement_invoice">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal Payment </h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <!--begin::Input group-->
                        <div class="mb-3 row fv-row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Method
                                Payment</label>
                            <div class="col-md-8">
                                <select class="form-select" data-control="select2" data-placeholder="Select Method"
                                    name="methodpayment">
                                    <option></option>
                                    @foreach ($method_payment as $method_payments)
                                        <option value="{{ $method_payments->id }}"> {{ $method_payments->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row fv-row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Due
                                Date</label>
                            <div class="col-md-6">
                                <input type="date" name="due_date_transaction"
                                    class="form-control  kt_datepicker text-start">
                            </div>
                        </div>

                        <div class="mb-3 row fv-row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Total
                                Payment
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="total_payment"
                                    class="form-control  mb-3 mb-lg-0 form-control-solid" placeholder="0 "
                                    data-type="currency" readonly="readonly" data-currency="{{ $total_cart }}"
                                    value="{{ number_format($total_cart, 0, ',', '.') }}" />
                            </div>
                        </div>

                        <div class="mb-3 row fv-row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Amount
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="amount_payment" class="form-control  mb-3 mb-lg-0"
                                    placeholder="0 " data-type="currency" />
                            </div>
                        </div>

                        <div class="m-grid-row mb-3 scrollmoney d-none " id="list-nominal">
                            <div class="d-flex align-items-center ">
                                @if (!empty($nominal_opsi_cash))
                                    @foreach ($nominal_opsi_cash as $nominal)
                                        <a href="javascript:;" class="btn btn-light-dark me-3 m-3 list-moneys"
                                            data-currency="{{ $nominal }}">{{ number_format($nominal, 0, ',', '.') }}</a>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row fv-row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Changes
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="change" class="form-control form-control-solid mb-3 mb-lg-0"
                                    placeholder="0" data-type="currency" readonly="readonly" />
                            </div>
                        </div>

                        <div class="mb-3 row fv-row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Notes
                            </label>
                            <div class="col-md-8">
                                <textarea name="notes" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"
                            id="kt_docs_formvalidation_text_submit_payment">Save changes <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endpush

@push('modals')
    <div class="modal face" tabindex="-1" id="kt_modal_call">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Transaction Saved </h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <!--begin::Input group-->
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1 mb-3 ">
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="black"></path>
                            </svg>
                        </span>
                        <input type="text" data-kt-docs-table-filter="search"
                            class="form-control form-control-solid w-250px ps-15" placeholder="Search Trans Saved " />
                    </div>
                    <!--end::Search-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="table-saved">
                        <thead>
                            <th>Invoice</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Customer</th>
                            <th>Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@section('content')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-12">
            <!--begin::Tables Widget 5-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body py-3">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">S.O
                                    Number</label>
                                <div class="col-md-8">
                                    <input type="text" name="ponumber" class="form-control form-control-solid"
                                        value="{{ $ponumber }}" readonly="readonly">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end text-start">Customer</label>
                                <div class="col-md-8">
                                    <div class="float-start">
                                        <select class="form-select @error('customer') is-invalid @enderror"
                                            data-control="select2" data-placeholder="Select customer" name="customer">
                                            <option></option>
                                            @foreach ($customer as $customers)
                                                <option value="{{ $customers->id }}"
                                                    @if ($customer_default == $customers->id) selected="selected" @endif>
                                                    {{ $customers->name }} </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('customer'))
                                            <span class="text-danger">{{ $errors->first('customer') }}</span>
                                        @endif
                                    </div>
                                    <div class="float-end">
                                        <a href="javascript:;" class="btn btn-bg-light btn-icon-info btn-text-info mb-2"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_customer">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen006.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-person-fill-add"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                    <path
                                                        d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Date</label>
                                <div class="col-md-4">
                                    <input type="date" name="date_transaction"
                                        class="form-control @error('date_transaction') is-invalid @enderror kt_datepicker text-start">
                                    @if ($errors->has('date_transaction'))
                                        <span class="text-danger">{{ $errors->first('date_transaction') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end text-start">Departement</label>
                                <div class="col-md-8">
                                    <select class="form-select @error('departement') is-invalid @enderror"
                                        data-control="select2" data-placeholder="Select Departement" name="departement">
                                        <option></option>
                                        @foreach ($departement as $departements)
                                            <option value="{{ $departements->id }}"
                                                @if ($departement_default == $departements->id) selected="selected" @endif>
                                                {{ $departements->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('departement'))
                                        <span class="text-danger">{{ $errors->first('departement') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end text-start">Operator</label>
                                <div class="col-md-8">
                                    <input type="text" name="operator" class="form-control form-control-solid"
                                        value="{{ $operator }}" readonly="readonly">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Tables Widget 5-->
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-lg-6">
            <div class="scrollmenu g-5 gx-xxl-8">
                <a class="btn btn-color-gray-600 btn-active-white btn-active-color-primary fw-boldest fs-8 fs-lg-base nav-link px-3 px-lg-8 mx-1 text-uppercase @if (request()->segment(3) == 'all') active @endif"
                    href="{{ route('sales.filter', ['filter' => 'all']) }}">All</a>
                <!--end::Nav item-->
                @forelse($category_product as $categorys)
                    <a class="btn btn-color-gray-600 btn-active-white btn-active-color-primary m-2 fw-boldest fs-8 fs-lg-base nav-link px-3 px-lg-8 mx-1 text-uppercase @if (request()->segment(3) == $categorys->id) active @endif"
                        href="{{ route('sales.filter', ['filter' => $categorys->id]) }}">
                        {{ Str::title($categorys->name) }}</a>
                @empty
                @endforelse
            </div>
        </div>
        <div class="col-lg-6">
            <div class="g-5 gx-xxl-8 text-end">
                @if ($edit_trans == false)
                    <a href="javascript:;" class="btn btn-info py-6 " data-bs-toggle="modal"
                        data-bs-target="#kt_modal_call" id="buttoncall"> <i class="bi bi-arrow-down-up"></i> Call
                    </a>
                @endif

                @if (!empty($cart) && count($cart) > 0)
                    @if ($edit_trans == false)
                        <a href="javascript:;" class="btn btn-danger py-6 " id="savedtrans"> <i
                                class="bi bi-save2-fill"></i>
                            Save
                        </a>
                    @endif
                    <a href="javascript:;" class="btn btn-warning py-6" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_discount">
                        <i class="bi bi-cash-stack"></i> Discount
                    </a>
                    <a href="javascript:;" class="btn btn-dark  py-6" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_tax">
                        <i class="bi bi-cash-stack"></i> Tax
                    </a>
                    <a href="javascrip:;" class="btn btn-primary  py-6 " data-bs-toggle="modal"
                        data-bs-target="#kt_modal_payment" id="buttonpayment">
                        <i class="bi bi-credit-card"></i> Pay
                        Now</a>
                    @if ($edit_trans == true)
                        <a href="{{ route('sales.canceledit') }}" class="btn btn-danger py-6"> <i
                                class="bi bi-arrow-left"></i>
                            Cancel Edit </a>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <div class="row g-3 g-xl-8">
        <div class="col-xl-8">
            <div class="d-flex align-items-center position-relative my-1 mb-3 ">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
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
                <input type="text" data-kt-product-table-filter="search" class="form-control w-250px ps-15 me-3"
                    placeholder="Search Product" value="{{ $keyword }}">

                @if (!empty($keyword))
                    <a href="{{ route('sales.create') }}"
                        class="btn btn-danger btn-icon-white btn-text-white ps-5 w-200px">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x" viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg>
                        </span>
                        Reset
                    </a>
                @endif
            </div>
            <div class="scroll h-600px px-0">
                <div class="row g-4 g-xl-4 mb-6 mb-xl-4">
                    @forelse ($product as $products)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <!--begin::Card-->
                            <a href="javascript:;" data-id="{{ $products->id }}" id="addcart">
                                <div class="card h-100">
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <!--begin::Name-->
                                        <div class="text-gray-800 text-hover-primary d-flex flex-column">
                                            <!--begin::Image-->
                                            <div class="symbol symbol-100px mb-5">
                                                @if (!empty($products->image_product))
                                                    <img src="{{ Storage::url($products->image_product) }}"
                                                        alt="Product" class="w-100 h-150px" />
                                                @else
                                                    <img src="https://fakeimg.pl/100x150" alt="Product"
                                                        class="w-100 h-150px" />
                                                @endif
                                            </div>
                                            <!--end::Image-->
                                            <!--begin::Title-->
                                            <div class="fs-5 fw-bolder mb-2">{{ $products->name ?? '' }}</div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Name-->

                                        <div class="fs-7 fw-bold mb-3 badge badge-light-success">
                                            {{ empty($products->price_sell) ? 0 : number_format($products->price_sell, 0, ',', '.') }}
                                        </div>

                                        <!--begin::Description-->
                                        <div class="fs-7 fw-bold badge badge-info mb-3  ">
                                            {{ $products->category_product?->name }}
                                        </div>
                                        <!--end::Description-->

                                        <div class="fs-7 fw-bold badge badge-light-primary">
                                            {{ empty($products->stock_last) ? 0 : $products->stock_last }}
                                        </div>

                                    </div>
                                    <!--end::Card body-->
                                </div>
                            </a>
                            <!--end::Card-->
                        </div>
                    @empty
                        <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/communication/com003.svg-->
                            <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3"
                                        d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z"
                                        fill="black"></path>
                                    <path
                                        d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z"
                                        fill="black"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Content-->
                            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                <h4 class="mb-2 text-light">This is an alert</h4>
                                <span>Product Not Found .</span>
                            </div>
                            <!--end::Content-->
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="mb-3 mt-10 row">
                {{ empty($product->links()) ? '' : $product->links() }}
            </div>
        </div>
        <!--begin::Col-->
        <div class="col-xl-4">
            <div class="mb-3 row">
                <div class="card card-xl-stretch mb-5 mb-xl-8">
                    <div class="card-header align-items-center border-0 mt-4">
                        <div class="d-flex align-items-center position-relative my-1 mb-3 p-0 ">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                                    <path
                                        d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-scan-table-filter="search" class="form-control w-350px ps-15"
                                placeholder="Scan Barcode " id="scanbarcode">
                        </div>

                        <h3 class="card-title align-items-start flex-column">
                            <span class="fw-bolder text-dark">Latest Cart</span>
                            <span class="text-muted mt-1 fw-bold fs-7"> {{ count($cart) }} Item </span>
                        </h3>
                        @if (!empty($cart) && count($cart) > 0)
                            <div class="card-toolbar">
                                <a href="{{ route('sales.clearcart') }}"
                                    class="btn btn-danger btn-icon-white btn-text-white  mb-3"
                                    onclick ="return confirm('Do you want to delete All this list item cart ?')">
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                        </svg>
                                    </span>
                                    Clear
                                </a>
                            </div>
                        @endif
                    </div>
                    <!--end::Header-->
                    <div class="card-body pt-3">
                        <div class="scroll @if (!empty($cart) && count($cart) > 0) h-200px @endif">
                            @forelse($cart as $key => $cart_item)
                                <div class="d-flex align-items-sm-center mb-7">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-60px symbol-2by3 me-4">
                                        @if (!empty($cart[$key]['image_product']))
                                            <div class="symbol-label"
                                                style="background-image: url({{ Storage::url($cart[$key]['image_product']) }})">
                                            </div>
                                        @else
                                            <div class="symbol-label"
                                                style="background-image: url('https://fakeimg.pl/100x100')">
                                            </div>
                                        @endif
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Content-->
                                    <div class="d-flex flex-row-fluid align-items-center flex-wrap my-lg-0 me-2">
                                        <!--begin::Title-->
                                        <div class="flex-grow-1 my-lg-0 my-2 me-2">
                                            <a href="javascript:;" id="editcart" data-id="{{ $cart[$key]['id'] }}"
                                                class="text-gray-800 fw-bolder text-hover-primary fs-6"> <i
                                                    class="bi bi-pencil-square text-warning"></i>
                                                {{ Str::title($cart[$key]['name_product']) }}</a>
                                            <span
                                                class="text-muted fw-bold d-block pt-1">{{ empty($cart[$key]['price_unit']) ? 0 : number_format($cart[$key]['price_unit'], 0, ',', '.') }}</span>
                                            <span class="text-gray-800 fw-bolder">x</span>
                                            <span class="text-gray-800 fw-bolder me-2">{{ $cart[$key]['qty'] }}</span>
                                            @if ($cart[$key]['check_convert'] == false)
                                                <span class="text-gray-800 "> ( {{ $cart[$key]['unit_name'] }} ) </span>
                                            @else
                                                <span class="text-gray-800 me-2 "> ( {{ $cart[$key]['unit_name'] }}
                                                    )</span>
                                                <br>
                                                @if ($cart[$key]['qty_convert'] > 1)
                                                    <span class="text-gray-800"> (fill :
                                                        {{ $cart[$key]['qty_convert'] }}) </span>
                                                @endif
                                            @endif
                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center">

                                            <div class="me-6">
                                                <span
                                                    class="text-gray-800 fw-bolder">{{ number_format($cart[$key]['subtotal'], 0, ',', '.') }}</span>
                                            </div>

                                            <a href="{{ route('sales.deletecart', $cart[$key]['id']) }}"
                                                class="btn btn-icon btn-danger btn-sm border-0">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-x-circle-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Content-->
                                </div>

                            @empty

                                <center><img src="{{ asset('assets/media/illustrations/cashir.jpg') }}"
                                        class="h-200px text-center w-200px mb-3" /></center>

                                <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                    <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                                            <path
                                                d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="d-flex flex-column">
                                        <h4 class="mb-1 text-danger">Cart is Empty.</h4>
                                        <span>Add something to make happy. </span>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    @if (!empty($cart) && count($cart) > 0)
                        <div class="card-footer">
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label text-md-end text-start">Subtotal</label>
                                <div class="col-md-8">
                                    <input type="text" name="subtotal" class="form-control form-control-solid"
                                        value="{{ number_format($subtotal_cart, 0, ',', '.') }}" readonly="readonly">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label text-md-end text-start">Discount</label>
                                <div class="col-md-8">
                                    <input type="text" name="discount" class="form-control form-control-solid"
                                        value="{{ number_format($discount_cart, 0, ',', '.') }}" readonly="readonly">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label text-md-end text-start">Tax</label>
                                <div class="col-md-8">
                                    <input type="text" name="tax" class="form-control form-control-solid"
                                        value="{{ number_format($tax_cart, 0, ',', '.') }}" readonly="readonly">
                                </div>
                            </div>

                            <div class="mb-3 row ">
                                <label for="name" class="col-md-4 col-form-label text-md-start text-start">Total
                                    Payment
                                </label>
                                <div
                                    class="col-md-12 @if ($total_cart > 0) bg-primary @else bg-danger @endif text-end text-md-end">
                                    <span class="fs-large text-white" data-currency="{{ $total_cart }}"
                                        id="totalpayment">
                                        {{ number_format($total_cart, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
        <!--end::Col-->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#kt_body').attr('data-kt-aside-minimize', 'on');

        $(".kt_datepicker").flatpickr({
            dateFormat: "d/m/Y",
            defaultDate: "{{ $date_transaction }}"
        });

        $('input[data-kt-product-table-filter="search"]').on('keydown', function(event) {
            if (event.keyCode == 13) {
                if ($(this).val().length == 0) {
                    alert('Enter Keyword Product ');
                } else {
                    var url = "{{ route('sales.search', ['keyword' => ':keyword']) }}";
                    url = url.replace(':keyword', $(this).val());
                    window.location.href = url;
                }
            }
        });

        $('input[data-kt-scan-table-filter="search"]').on('keyup', function(event) {
            if ($(this).val().length > 0) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('sales.scancart') }}",
                    // The key needs to match your method's input parameter (case-sensitive).
                    data: JSON.stringify({
                        code: $(this).val()
                    }),
                    contentType: "application/json;",
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        if (data.refresh == true) {
                            window.location.reload();
                        }
                    },
                    error: function(errMsg) {
                        console.log(errMsg);
                    }
                });
            }
        });

        SetFocus('scanbarcode');

        function SetFocus(InputID) {
            document.getElementById(InputID).focus();
        }

        // Define form element
        const form = document.getElementById('kt_docs_formvalidation_text');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'name_input': {
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            }
                        }
                    },
                    'email_input': {
                        validators: {
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            },
                            notEmpty: {
                                message: 'Email address is required'
                            }
                        }
                    },
                    'address_input': {
                        validators: {
                            notEmpty: {
                                message: 'Address is required'
                            }
                        }
                    },
                    'contact_input': {
                        validators: {
                            notEmpty: {
                                message: 'Contact is required'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Submit button handler
        const submitButton = document.getElementById('kt_docs_formvalidation_text_submit');
        submitButton.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function(status) {

                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable button to avoid multiple click
                        submitButton.disabled = true;

                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        setTimeout(function() {
                            // Remove loading indication
                            submitButton.removeAttribute('data-kt-indicator');

                            // Enable button
                            submitButton.disabled = false;

                            // Show popup confirmation
                            Swal.fire({
                                text: "Form has been successfully submitted!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });

                            form.submit(); // Submit form
                        }, 2000);
                    }
                });
            }
        });

        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }

        function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.

            // get input value
            var input_val = input.val();

            // don't validate empty input
            if (input_val === "") {
                return;
            }

            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");

            // check for decimal
            if (input_val.indexOf(",") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(",");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);

                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                    right_side += "00";
                }

                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = left_side + "," + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = input_val;
            }

            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            }
        });

        /** inject payment  **/
        $('body').on('click', '#buttonpayment', function() {
            var no_invoive = $('input[name=ponumber]').val();
            var customer_invoce = $('select[name=customer] option:selected').val();
            var date_invoice = $('input[name=date_transaction]').val();
            var departement_invoice = $('select[name=departement] option:selected').val();
            $('input[name=number_invoice]').val(no_invoive);
            $('input[name=date_invoice]').val(date_invoice);
            $('input[name=customer_invoice]').val(customer_invoce);
            $('input[name=departement_invoice]').val(departement_invoice);
        });



        const formpaymenet = document.getElementById('kt_docs_formvalidation_text_p');
        const validatorpayment = FormValidation.formValidation(
            formpaymenet, {
                fields: {
                    'methodpayment': {
                        validators: {
                            notEmpty: {
                                message: 'Method Payment is required'
                            }
                        }
                    },
                    'amount_payment': {
                        validators: {
                            notEmpty: {
                                message: 'Amount Payment is required'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        //method payment 

        $('body').on('change', 'select[name=methodpayment]', function(e) {
            if (e.target.value > 1) {
                $('#list-nominal').addClass('d-none');
            } else {
                $('#list-nominal').removeClass('d-none');
            }
        });

        $('body').on('click', '.list-moneys', function() {
            var money = $(this).data('currency');
            $('input[name=amount_payment]').attr('data-currency', money);
            $('input[name=amount_payment]').val(formatNumber(money.toString()));
            var total_payment = $('input[name=total_payment]').data('currency');
            var change = parseInt(money) - parseInt(total_payment);
            console.log(change);
            if (change > 0) {
                var dfc = formatNumber(change.toString());
                $('input[name="change"]').attr('data-currency', change.toString());
                $('input[name="change"]').val(dfc);
            } else {
                $('input[name="change"]').attr('data-currency', 0);
                $('input[name="change"]').val(0);
            }
        });

        // submit payment 

        const submitButtonpay = document.getElementById('kt_docs_formvalidation_text_submit_payment');
        submitButtonpay.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
            if (validatorpayment) {
                validatorpayment.validate().then(function(status) {

                    if (status == 'Valid') {
                        // Show loading indication
                        submitButtonpay.setAttribute('data-kt-indicator', 'on');

                        // Disable button to avoid multiple click
                        submitButtonpay.disabled = true;

                        var methodpaymentid = $('select[name=methodpayment] option:selected').val();
                        var replace_currency = $('input[name=amount_payment]').val().replace(/\D/g, "");
                        var total_payment = $('input[name=total_payment]').data('currency');
                        var change = parseInt(replace_currency) - parseInt(total_payment);


                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        setTimeout(function() {
                            // Remove loading indication
                            submitButtonpay.removeAttribute('data-kt-indicator');

                            // Enable button
                            submitButtonpay.disabled = false;

                            if (change < 0) {

                                if (methodpaymentid == 3) {

                                    // Show popup confirmation
                                    Swal.fire({
                                        text: "Form has been successfully submitted!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    });
                                    formpaymenet.submit(); // Submit form

                                } else {
                                    Swal.fire({
                                        text: "Form has been failed submitted, Check Amount Payment uncorrect !",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    });
                                }

                            } else {

                                // Show popup confirmation
                                Swal.fire({
                                    text: "Form has been successfully submitted!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                                formpaymenet.submit(); // Submit form
                            }

                        }, 2000);
                    }
                });
            }
        });


        //change customer 

        $('body').on('change', 'select[name=customer]', function(e) {
            var urld = "{{ route('sales.changecust', ['customer' => ':id']) }}";
            urld = urld.replace(':id', e.target.value);
            window.location.href = urld;
        });

        //change departement 
        $('body').on('change', 'select[name=departement]', function(e) {
            var urld = "{{ route('sales.changedepart', ['departement' => ':id']) }}";
            urld = urld.replace(':id', e.target.value);
            window.location.href = urld;
        });

        //add cart 
        $('body').on('click', 'a#addcart', function() {
            var id_product = $(this).data('id');
            var id_departement = $('select[name="departement"] option:selected').val();

            var urld = "{{ route('sales.addcart', ['id' => ':id', 'departement' => ':departement']) }}";
            urld = urld.replace(':id', id_product).replace(':departement', id_departement);
            window.location.href = urld;
        });

        // ajax show Edit Cart 
        $('body').on('click', 'a#editcart', function() {
            var id_cart = $(this).data('id');
            var urld = "{{ route('sales.editcart', ['id' => ':id']) }}";
            urld = urld.replace(':id', id_cart);
            $.ajax({
                type: "GET",
                url: urld,
                contentType: "application/json;",
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {

                    let df = formatNumber(data.data.price_unit);

                    $('input[name="name_cart"]').val(data.data.name_product);
                    $('input[name="price_cart"]').val(df);
                    $('select[name="units_cart"]').select2();
                    $('select[name="units_cart"]').val(data.data.unit_id).trigger("change");
                    $('input[name="qty_cart"]').val(data.data.qty);
                    $('input[name="id_cart"]').val(data.data.id);

                    $('#kt_modal_edit_cart').modal('show');

                },
                error: function(errMsg) {
                    console.log(errMsg);
                }
            });
        });

        //charge 
        $('body').on('keyup', 'input[name=amount_payment]', function(e) {
            if (e.target.value.length > 0) {
                var replace_currency = e.target.value.replace(/\D/g, "");
                var total_payment = $('input[name=total_payment]').data('currency');
                var change = parseInt(replace_currency) - parseInt(total_payment);
                if (change > 0) {
                    var dfc = formatNumber(change.toString());
                    $('input[name="change"]').attr('data-currency', change.toString());
                    $('input[name="change"]').val(dfc);
                }
            } else {
                $('input[name="change"]').val(0);
                $('input[name="change"]').attr('data-currency', 0);
            }
        });

        //saved transaction 
        $("body").on('click', '#savedtrans', function(e) {

            var no_invoive = $('input[name=ponumber]').val();
            var customer_invoce = $('select[name=customer] option:selected').val();
            var date_invoice = $('input[name=date_transaction]').val();
            var departement_invoice = $('select[name=departement] option:selected').val();
            var totalpayment = $('#totalpayment').data('currency');

            Swal.fire({
                title: "Are you sure?",
                text: "you want to save this transaction!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Save it!"
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('sales.temptransaction') }}",
                        contentType: "application/json;",
                        cache: false,
                        processData: false,
                        dataType: "json",
                        data: JSON.stringify({
                            "no_invoice": no_invoive,
                            "customer": customer_invoce,
                            "departement": departement_invoice,
                            "date_invoice": date_invoice,
                            "total_payment": totalpayment
                        }),
                        success: function(data) {
                            if (data.reload == true) {
                                Swal.fire("", data.message, "success").then(function(e) {
                                    window.location.reload();
                                });
                            }
                        },
                        error: function(errMsg) {

                            Swal.fire("", errMsg.message, "error");
                        }
                    });

                }
            });
        });


        var table = $('#table-saved').DataTable({
            processing: true,
            responsive: true,
            info: !1,
            bDestroy: true,
            serverSide: true,
            order: [
                [0, 'desc']
            ],
            ajax: "{{ route('sales.list-saved') }}",
            columns: [{
                    data: 'code_transaction',
                    name: 'code_transaction'
                },
                {
                    data: 'date_sales',
                    name: 'date_sales'
                },
                {
                    data: 'time_sales',
                    name: 'time_sales'
                },
                {
                    data: 'customer',
                    name: 'customer'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        //list transaction saved 
        $('body').on('click', '#buttoncall', function() {


            var handleSearchDatatable = function() {
                const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
                filterSearch.addEventListener('keyup', function(e) {
                    table.search(e.target.value).draw();
                });
            }

            handleSearchDatatable();
        });

        //call transid
        $('body').on('click', '.choose-saved', function() {
            var transd = $(this).data('transid');
            var urld = "{{ route('sales.choose_transaction', ['id' => ':id']) }}";
            urld = urld.replace(':id', transd);
            window.location.href = urld;
        });

        //delete trans save delete
        $('body').on('click', '.delete-saved', function() {
            var transd = $(this).data('transid');
            var urld = "{{ route('sales.removeTrans', ['id' => ':id']) }}";
            urld = urld.replace(':id', transd);
            Swal.fire({
                title: "Are you sure?",
                text: "you want to delete this transaction!",
                icon: "danger",
                showCancelButton: true,
                confirmButtonText: "Yes, Delete it!"
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: urld,
                        contentType: "application/json;",
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data.reload == true) {
                                Swal.fire("", data.message, "success").then(function(e) {
                                    window.location.reload();
                                });
                            }
                        },
                        error: function(errMsg) {

                            Swal.fire("", errMsg.message, "error");
                        }
                    });
                }
            })
        });

        //open balance 
        @if ($open_balance == true)
            $(function() {
                $('#kt_modal_openbalance').modal('show');
            });
        @endif
    </script>
@endpush
