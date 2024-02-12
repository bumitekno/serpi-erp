@extends('sales::layouts.master')

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

@section('content')

    @can('dashboard-sales')
        <div class="row g-5 g-xl-8">
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <div class="card bg-body-white hoverable card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                        <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z"
                                    fill="black"></path>
                                <path opacity="0.3"
                                    d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z"
                                    fill="black"></path>
                                <path opacity="0.3"
                                    d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z"
                                    fill="black"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">Total Transaction </div>
                        <div class="fw-bold text-gray-400">{{ number_format($total_transaction, 0, ',', '.') }}</div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Statistics Widget 5-->
            </div>
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <div class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen008.svg-->
                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z"
                                    fill="black"></path>
                                <path opacity="0.3"
                                    d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z"
                                    fill="black"></path>
                                <path opacity="0.3"
                                    d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z"
                                    fill="black"></path>
                                <path opacity="0.3"
                                    d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z"
                                    fill="black"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-white fw-bolder fs-2 mb-2 mt-5">Sales Success</div>
                        <div class="fw-bold text-white">{{ number_format($total_transaction_success, 0, ',', '.') }}</div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Statistics Widget 5-->
            </div>
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <div class="card bg-danger hoverable card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr070.svg-->
                        <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"></rect>
                                <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black">
                                </rect>
                                <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"></rect>
                                <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">Sales Cancel </div>
                        <div class="fw-bold text-gray-100">{{ number_format($total_transaction_cancel, 0, ',', '.') }}</div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Statistics Widget 5-->
            </div>
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <div class="card bg-warning hoverable card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr070.svg-->
                        <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"></rect>
                                <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5"
                                    fill="black">
                                </rect>
                                <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"></rect>
                                <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">Sales Pending </div>
                        <div class="fw-bold text-gray-100">{{ number_format($total_transaction_pending, 0, ',', '.') }}</div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Statistics Widget 5-->
            </div>
        </div>
        <div class="row g-5 g-xl-8">
            <div class="col-xl-4">
                <div class="card card-xl-stretch mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder text-dark">Overview Today </span>
                        </h3>
                        <div class="card-toolbar">

                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-5">

                        <div class="row">
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-7">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-50px me-5">
                                    <span class="symbol-label bg-light-success">
                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                        <span class="svg-icon svg-icon-2x svg-icon-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                                    fill="black"></path>
                                                <path
                                                    d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                                    fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Text-->
                                <div class="d-flex flex-column">
                                    <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bolder">Sales
                                        Success</a>
                                    <span class="text-muted fw-bold">Income Transaction Sales Success</span>
                                    <span class="text-muted fw-bold">{{ number_format($today_success, 0, ',', '.') }}</span>
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-7">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-50px me-5">
                                    <span class="symbol-label bg-light-danger">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <span class="svg-icon svg-icon-2x svg-icon-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                    fill="black"></path>
                                                <path
                                                    d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                    fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Text-->
                                <div class="d-flex flex-column">
                                    <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bolder">Sales
                                        Cancel</a>
                                    <span class="text-muted fw-bold">Income Transaction Sales Cancel</span>
                                    <span class="text-muted fw-bold">{{ number_format($today_cancel, 0, ',', '.') }}</span>
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-7">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-50px me-5">
                                    <span class="symbol-label bg-light-warning">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <span class="svg-icon svg-icon-2x svg-icon-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                    fill="black"></path>
                                                <path
                                                    d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                    fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Text-->
                                <div class="d-flex flex-column">
                                    <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bolder">Sales
                                        Pending </a>
                                    <span class="text-muted fw-bold">Income Transaction Sales Pending</span>
                                    <span class="text-muted fw-bold">{{ number_format($today_pending, 0, ',', '.') }}</span>
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-7">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-50px me-5">
                                    <span class="symbol-label bg-light-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <span class="svg-icon svg-icon-2x svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                    fill="black"></path>
                                                <path
                                                    d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                    fill="black"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Text-->
                                <div class="d-flex flex-column">
                                    <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bolder">Open
                                        Balance </a>
                                    <span class="text-muted fw-bold">Open Balance Amount </span>
                                    <span class="text-muted fw-bold">{{ $open_balance }}</span>
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Item-->
                        </div>

                        <div class="row">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark"> Top Sales Product </span>
                            </h3>
                            <div class="scroll h-200px px-5">
                                @forelse($top_product as $product)
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-7">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-50px me-5">
                                            <span class="symbol-label bg-light-success">
                                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                                <span class="svg-icon svg-icon-2x svg-icon-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                            d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                                            fill="black"></path>
                                                        <path
                                                            d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                                            fill="black"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column">
                                            <a href="javascript:;"
                                                class="text-dark text-hover-primary fs-6 fw-bolder">{{ Str::title($product->name) }}

                                                <span class="text-muted fw-bold">{{ $product?->code_product }}</span>
                                            </a>
                                            <span class="text-muted fw-bold">{{ $product?->total_sales }}</span>
                                            <span
                                                class="text-muted fw-bold">{{ number_format($product->total_price, 0, ',', '.') }}</span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Item-->
                                @empty
                                @endforelse
                            </div>
                        </div>

                    </div>
                    <!--end::Body-->
                </div>

            </div>
            <div class="col-xl-8">
                <div class="card card-xl-stretch mb-5 mb-xl-8">
                    <div class="card-header border-0 pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Recent Statistics</span>
                            <span class="text-muted fw-bold fs-7">Sales </span>
                        </h3>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="kt_charts_widget_1_chart" style="height: 350px"></div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>
    @endcan

    <div class="card">

        <div class="card-header mt-3">
            <div class="float-start">
                <div class="d-flex">

                    <form name="filtersale" method="POST" action="{{ route('sales.filter-history') }}">
                        @csrf
                        <div class="d-flex align-items-center position-relative my-1">
                            <input type="text" data-kt-subscription-table-filter="search"
                                class="form-control form-control-solid w-250px ps-14 me-3 " id="keyword"
                                placeholder="Search Code" name="search" value="{{ empty($keyword) ? '' : $keyword }}">

                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black"></path>
                                </svg>
                            </span>
                            @if (!empty($keyword))
                                <div class="ml-3 me-3">
                                    <a href="{{ route('sales.index') }}"
                                        class="btn btn-danger btn-icon-white btn-text-white ps-5 w-120px">
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </span>
                                        Reset
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>
                    <div class="position-relative my-1">
                        <input class="form-control form-control-solid w-250px ps-3 text-center  me-3 " name="datefilter"
                            placeholder="Pick date range " id="kt_daterangepicker_1" data-stardate="{{ $startdate }}"
                            data-enddate="{{ $enddate }}" value="{{ $startdate }} - {{ $enddate }}" />
                    </div>
                    @can('download-sales')
                        <a href="javascript:;" class="btn btn-info btn-sm my-2 download-files"><i
                                class="bi bi-arrow-down"></i>
                            Export </a>
                    @endcan
                </div>
            </div>
            <div class="float-end">
                @can('create-sales')
                    <a href="javascript:;" class="btn btn-dark btn-sm my-2" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_openbalance"><i class="bi bi-plus-circle"></i>
                        Input Balance </a>

                    <a href="{{ route('sales.create') }}" class="btn btn-success btn-sm my-2"><i
                            class="bi bi-plus-circle"></i>
                        New Sales </a>
                @endcan

                @can('create-income')
                    <a href="{{ route('income.index') }}" class="btn btn-primary btn-sm my-2"><i
                            class="bi bi-plus-circle"></i>
                        Income </a>
                @endcan

                @can('create-expense')
                    <a href="{{ route('expense.index') }}" class="btn btn-danger btn-sm my-2"><i
                            class="bi bi-plus-circle"></i>
                        Expense </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> Code </th>
                            <th> Date</th>
                            <th> Total</th>
                            <th> Amount</th>
                            <th> Customer </th>
                            <th> Departement </th>
                            <th> Method</th>
                            <th> Status </th>
                            <th> Due Date </th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                        @forelse ($transaction as $transactions)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ empty($transactions->code_transaction) ? '-' : $transactions->code_transaction }}
                                </td>
                                <td>{{ empty($transactions->date_sales) ? '-' : \Carbon\Carbon::parse($transactions->date_sales)->translatedFormat('d F Y') }}
                                    {{ empty($transactions->time_sales) ? '-' : \Carbon\Carbon::parse($transactions->time_sales)->translatedFormat('H:i:s') }}
                                </td>
                                <td>{{ empty($transactions->total_transaction) ? 0 : number_format($transactions->total_transaction, 0, ',', '.') }}
                                </td>
                                <td>{{ empty($transactions->amount) ? 0 : number_format($transactions->amount, 0, ',', '.') }}
                                </td>
                                <td>{{ empty($transactions->customer) ? '-' : $transactions->customer?->name }}</td>
                                <td>{{ empty($transactions->departement) ? '-' : $transactions->departement?->name }}
                                </td>

                                <td>{{ empty($transactions->methodpayment) ? '-' : $transactions->methodpayment?->name }}
                                </td>
                                @if ($transactions->status == 1)
                                    <td>
                                        <span class="badge badge-light-success">Paid</span>
                                    </td>
                                @else
                                    @if ($transactions->note == 'cancel')
                                        <td><span class="badge badge-light-danger">Cancel</span></td>
                                    @else
                                        <td><span class="badge badge-light-warning">Pending</span></td>
                                    @endif
                                @endif
                                <td>{{ empty($transactions->date_due) ? '-' : \Carbon\Carbon::parse($transactions->date_due)->translatedFormat('d F Y') }}
                                </td>
                                <td class="text-end ">
                                    <form action="{{ route('sales.destroy', $transactions->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="py-5">
                                            <a href="{{ route('sales.show', $transactions->id) }}"
                                                class="btn btn-default btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </a>

                                            @can('edit-sales')
                                                @if ($transactions->note != 'cancel')
                                                    <a href="{{ route('sales.edit', $transactions->id) }}"
                                                        class="btn btn-default btn-warning btn-icon-split">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-edit"></i>
                                                        </span>
                                                    </a>
                                                @endif
                                            @endcan

                                            @can('delete-sales')
                                                @if ($transactions->note != 'cancel')
                                                    <button type="submit"
                                                        onclick ="return confirm('Do you want to cancel this Sales?')"
                                                        class="btn btn-default btn-danger btn-icon-split">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-trash"></i>
                                                        </span>
                                                    </button>
                                                @endif
                                            @endcan
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13">
                                    <span class="text-danger text-center">
                                        <strong>No Sales Found!</strong>
                                    </span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ empty($transaction->links) ? '' : $transaction->links }}
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#kt_daterangepicker_1").daterangepicker({
            minYear: 1901,
            autoUpdateInput: false,
            showDropdowns: true,
            locale: {
                format: 'MM/DD/YYYY'
            }
        }, function(start, end, label) {
            window.location.href = "{{ route('sales.filter-history') }}?from=" + start.format(
                'YYYY-MM-DD') + "&to=" + end.format('YYYY-MM-DD');
        });

        $('body').on('click', '.download-files', function() {
            var start = $('input[name=datefilter]').attr('data-stardate');
            var end = $('input[name=datefilter]').attr('data-enddate');
            window.location.href = "{{ route('sales.download_transaction') }}?from=" + start + "&to=" + end;
        });

        $(".kt_datepicker").flatpickr({
            dateFormat: "d/m/Y",
            defaultDate: new Date()
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
    </script>
@endpush

@can('dashboard-sales')
    @push('scripts')
        <script type="text/javascript">
            var a = document.getElementById("kt_charts_widget_1_chart");
            var o = parseInt(KTUtil.css(a, "height"));
            var s = KTUtil.getCssVariableValue("--bs-gray-500");
            var r = KTUtil.getCssVariableValue("--bs-gray-200");
            var i = KTUtil.getCssVariableValue("--bs-primary");
            var x = KTUtil.getCssVariableValue("--bs-warning");
            var l = KTUtil.getCssVariableValue("--bs-danger");
            new ApexCharts(a, {
                series: [{
                    name: "Sales Success ",
                    data: @json($chart_success)
                }, {
                    name: "Sales Cancel",
                    data: @json($chart_cancel)
                }, {
                    name: "Sales Pending",
                    data: @json($chart_pending)
                }],
                chart: {
                    fontFamily: "inherit",
                    type: "bar",
                    height: o,
                    toolbar: {
                        show: !1
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: ["30%"],
                        borderRadius: 4
                    }
                },
                legend: {
                    show: !1
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    show: !0,
                    width: 2,
                    colors: ["transparent"]
                },
                xaxis: {
                    categories: @json($chart_month),
                    axisBorder: {
                        show: !1
                    },
                    axisTicks: {
                        show: !1
                    },
                    labels: {
                        style: {
                            colors: s,
                            fontSize: "12px"
                        },
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: s,
                            fontSize: "12px"
                        },
                        formatter: function(e) {
                            return e.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");;
                        },
                    },
                },
                fill: {
                    opacity: 1
                },
                states: {
                    normal: {
                        filter: {
                            type: "none",
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: "none",
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: !1,
                        filter: {
                            type: "none",
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: "12px"
                    },
                    y: {
                        formatter: function(e) {
                            return e.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");;
                        },
                    }
                },
                colors: [i, l, x],
                grid: {
                    borderColor: r,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: !0
                        }
                    }
                },
            }).render()
        </script>
    @endpush
@endcan
