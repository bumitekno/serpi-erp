@extends('template')
@push('menu-tops')
    @include('menu-top-pos')
@endpush
@section('content')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-3">
            <!--begin::Statistics Widget 1-->
            <div class="card bgi-no-repeat card-xl-stretch mb-xl-8"
                style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('assets/media/svg/shapes/abstract-4.svg') }})">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="javascript:;" class="card-title fw-bolder text-muted text-hover-primary fs-4">Users</a>
                    <div class="fw-bolder text-primary my-6 fs-1">{{ $count_user }}</div>
                    <p class="text-dark-75 fw-bold fs-5 m-0"> List Users
                    </p>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Statistics Widget 1-->
        </div>

        <div class="col-xl-3">
            <!--begin::Statistics Widget 1-->
            <div class="card bgi-no-repeat card-xl-stretch mb-xl-8"
                style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('assets/media/svg/shapes/abstract-4.svg') }})">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="javascript:;" class="card-title fw-bolder text-muted text-hover-primary fs-4">Departement</a>
                    <div class="fw-bolder text-primary my-6 fs-1">{{ $count_departement }}</div>
                    <p class="text-dark-75 fw-bold fs-5 m-0"> List Departement store
                    </p>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Statistics Widget 1-->
        </div>

        <div class="col-xl-3">
            <!--begin::Statistics Widget 1-->
            <div class="card bgi-no-repeat card-xl-stretch mb-xl-8"
                style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('assets/media/svg/shapes/abstract-2.svg') }})">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="javascript:;" class="card-title fw-bolder text-muted text-hover-primary fs-4">Customers</a>
                    <div class="fw-bolder text-primary my-6 fs-1">{{ $count_customer }}</div>
                    <p class="text-dark-75 fw-bold fs-5 m-0">List Customers</p>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Statistics Widget 1-->
        </div>
        <div class="col-xl-3">
            <!--begin::Statistics Widget 1-->
            <div class="card bgi-no-repeat card-xl-stretch mb-5 mb-xl-8"
                style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('assets/media/svg/shapes/abstract-1.svg') }})">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="javascript:;" class="card-title fw-bolder text-muted text-hover-primary fs-4">Supplier</a>
                    <div class="fw-bolder text-primary fs-1 my-6">{{ $count_supplier }}</div>
                    <p class="text-dark-75 fw-bold fs-5 m-0">List Supplier / Vendor Product
                    </p>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Statistics Widget 1-->
        </div>
    </div>

    <div class="row g-5 g-xl-8">
        <div class="col-xl-3">
            <!--begin::Statistics Widget 1-->
            <div class="card bgi-no-repeat card-xl-stretch mb-xl-8"
                style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('assets/media/svg/shapes/abstract-4.svg') }})">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="javascript:;" class="card-title fw-bolder text-muted text-hover-primary fs-4">Category
                        Product</a>
                    <div class="fw-bolder text-primary my-6 fs-1">{{ $count_category_product }}</div>
                    <p class="text-dark-75 fw-bold fs-5 m-0"> List Category Product
                    </p>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Statistics Widget 1-->
        </div>

        <div class="col-xl-3">
            <!--begin::Statistics Widget 1-->
            <div class="card bgi-no-repeat card-xl-stretch mb-xl-8"
                style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('assets/media/svg/shapes/abstract-2.svg') }})">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="javascript:;" class="card-title fw-bolder text-muted text-hover-primary fs-4">Warehouse</a>
                    <div class="fw-bolder text-primary my-6 fs-1">{{ $count_warehouse }}</div>
                    <p class="text-dark-75 fw-bold fs-5 m-0">List Warehouse</p>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Statistics Widget 1-->
        </div>

        <div class="col-xl-3">
            <!--begin::Statistics Widget 1-->
            <div class="card bgi-no-repeat card-xl-stretch mb-xl-8"
                style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('assets/media/svg/shapes/abstract-2.svg') }})">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="javascript:;" class="card-title fw-bolder text-muted text-hover-primary fs-4">Location</a>
                    <div class="fw-bolder text-primary my-6 fs-1">{{ $count_location }}</div>
                    <p class="text-dark-75 fw-bold fs-5 m-0">List Location Warehouse</p>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Statistics Widget 1-->
        </div>
        <div class="col-xl-3">
            <!--begin::Statistics Widget 1-->
            <div class="card bgi-no-repeat card-xl-stretch mb-5 mb-xl-8"
                style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('assets/media/svg/shapes/abstract-1.svg') }})">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="javascript:;" class="card-title fw-bolder text-muted text-hover-primary fs-4">Product</a>
                    <div class="fw-bolder text-primary my-6 fs-1">{{ $count_product }}</div>
                    <p class="text-dark-75 fw-bold fs-5 m-0">List Product
                    </p>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Statistics Widget 1-->
        </div>
    </div>

    <div class="row g-5 g-xl-8">
        <div class="col-lg-4 ">
            <div class="card card-xl-stretch mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Recent Top Latest</span>
                        <span class="text-muted fw-bold fs-7">Sales Product</span>
                    </h3>
                </div>
                <div class="card-body">
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
                            <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"
                                            d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                            fill="black"></path>
                                        <path
                                            d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-danger">This is an alert</h4>
                                    <span>Product Sales No Found.</span>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-xl-stretch mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <p class="text-dark-75 fw-bold fs-5 m-0"> Transaction Other
                    </p>
                </div>
                <div class="card-body">
                    <!--begin::Item-->
                    <div class="d-flex align-items-center mb-6">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45px w-40px me-5">
                            <span class="symbol-label bg-lighten">
                                <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"
                                            d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z"
                                            fill="black"></path>
                                        <path
                                            d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Description-->
                        <div class="d-flex align-items-center flex-wrap w-100">
                            <!--begin::Title-->
                            <div class="mb-1 pe-3 flex-grow-1">
                                <a href="javascript:;" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Top Up</a>
                                <div class="text-gray-400 fw-bold fs-7">Member Card Top UP</div>
                            </div>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <div class="d-flex align-items-center">
                                <div class="fw-bolder fs-5 text-gray-800 pe-1">
                                    {{ number_format($sum_trans_top_up, 0, ',', '.') }}</div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Description-->

                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="d-flex align-items-center mb-6">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45px w-40px me-5">
                            <span class="symbol-label bg-lighten">
                                <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"
                                            d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z"
                                            fill="black"></path>
                                        <path
                                            d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Description-->
                        <div class="d-flex align-items-center flex-wrap w-100">
                            <!--begin::Title-->
                            <div class="mb-1 pe-3 flex-grow-1">
                                <a href="javascript:;"
                                    class="fs-5 text-gray-800 text-hover-primary fw-bolder">Withdraw</a>
                                <div class="text-gray-400 fw-bold fs-7">Member Card Withdraw</div>
                            </div>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <div class="d-flex align-items-center">
                                <div class="fw-bolder fs-5 text-gray-800 pe-1">
                                    {{ number_format($sum_trans_wd, 0, ',', '.') }}</div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Description-->

                    </div>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <div class="d-flex align-items-center mb-6">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45px w-40px me-5">
                            <span class="symbol-label bg-lighten">
                                <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"
                                            d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z"
                                            fill="black"></path>
                                        <path
                                            d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Description-->
                        <div class="d-flex align-items-center flex-wrap w-100">
                            <!--begin::Title-->
                            <div class="mb-1 pe-3 flex-grow-1">
                                <a href="javascript:;" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Credit
                                    Sales</a>
                                <div class="text-gray-400 fw-bold fs-7">Sales Credit Due</div>
                            </div>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <div class="d-flex align-items-center">
                                <div class="fw-bolder fs-5 text-gray-800 pe-1">
                                    {{ number_format($sales_credit, 0, ',', '.') }}</div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Description-->

                    </div>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <div class="d-flex align-items-center mb-6">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-45px w-40px me-5">
                            <span class="symbol-label bg-lighten">
                                <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"
                                            d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z"
                                            fill="black"></path>
                                        <path
                                            d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Description-->
                        <div class="d-flex align-items-center flex-wrap w-100">
                            <!--begin::Title-->
                            <div class="mb-1 pe-3 flex-grow-1">
                                <a href="javascript:;" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Credit
                                    Purchase</a>
                                <div class="text-gray-400 fw-bold fs-7">Purchase Credit Due</div>
                            </div>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <div class="d-flex align-items-center">
                                <div class="fw-bolder fs-5 text-gray-800 pe-1">
                                    {{ number_format($purchase_credit, 0, ',', '.') }}</div>
                            </div>
                            <!--end::Label-->
                        </div>
                        <!--end::Description-->

                    </div>
                    <!--end::Item-->
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-xl-stretch mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Tracking Shipment Product</span>
                        <span class="text-muted fw-bold fs-7">Shipment Expedition </span>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="border-0">
                                    <th class="p-0 w-50px"></th>
                                    <th class="p-0 min-w-150px"></th>
                                    <th class="p-0 min-w-140px"></th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>

                                @forelse($tracking_shipment as $trackings)
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-45px me-2">
                                                <span class="symbol-label">
                                                    <img src="{{ asset('assets/media/svg/brand-logos/plurk.svg') }}"
                                                        class="h-50 align-self-center" alt="">
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('sales.show', $trackings->id_transaction) }}"
                                                class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $trackings->sales?->code_transaction }}</a>
                                            <span class="text-muted fw-bold d-block">{{ $trackings->first_name }}
                                                {{ $trackings->last_name }} </span>
                                        </td>
                                        <td class="text-end text-muted fw-bold">
                                            {{ $trackings?->number_tracking }}
                                            <p class="text-dark">
                                                {{ $trackings?->note }}
                                            </p>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                                <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                            d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                                            fill="black"></path>
                                                        <path
                                                            d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z"
                                                            fill="black"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <div class="d-flex flex-column">
                                                    <h4 class="mb-1 text-danger">This is an alert</h4>
                                                    <span>Tracking Delievery Product No Found.</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                    <p class="text-info"> Information List this bottom for check tracking delivery </p>
                    <a href="https://cekresi.com" target="_blank" class="btn btn-info btn-sm mb-3"> Cekresi.com </a>
                    <a href="https://berdu.id/cek-resi" target="_blank" class="btn btn-info btn-sm mb-3"> berdu.id </a>
                    <a href="https://anteraja.id/id/tracking" target="_blank" class="btn btn-info btn-sm mb-3">
                        Anteraja.id
                    </a>
                    <a href="https://kiriminaja.com/tracking" target="_blank" class="btn btn-info btn-sm mb-3">
                        Kiriminaja.com
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-5 g-xl-8">
        <div class="col-lg-6">
            <div class="card card-xl-stretch mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Recent Statistics</span>
                        <span class="text-muted fw-bold fs-7">Sales</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div id="kt_charts_widget_1_chart" style="height: 500px"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-xl-stretch mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Recent Statistics</span>
                        <span class="text-muted fw-bold fs-7">Purchase</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div id="kt_charts_widget_2_chart" style="height: 500px"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-5 g-xl-8">
        <div class="col-lg-6">
            <div class="card card-xl-stretch mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Recent Statistics</span>
                        <span class="text-muted fw-bold fs-7">Income</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div id="kt_charts_widget_3_chart" style="height: 500px"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-xl-stretch mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Recent Statistics</span>
                        <span class="text-muted fw-bold fs-7">Expense</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div id="kt_charts_widget_4_chart" style="height: 500px"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        var a = document.getElementById("kt_charts_widget_1_chart");
        var o = parseInt(KTUtil.css(a, "height"));
        var s = KTUtil.getCssVariableValue("--bs-gray-500");
        var r = KTUtil.getCssVariableValue("--bs-gray-200");
        var i = KTUtil.getCssVariableValue("--bs-primary");
        var x = KTUtil.getCssVariableValue("--bs-warning");
        var l = KTUtil.getCssVariableValue("--bs-danger");
        var lx = KTUtil.getCssVariableValue("--bs-success");

        new ApexCharts(a, {
            series: [{
                name: "Sales Success ",
                data: @json($chart_success_sales)
            }, {
                name: "Sales Cancel",
                data: @json($chart_cancel_sales)
            }, {
                name: "Sales Pending",
                data: @json($chart_pending_sales)
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
                categories: @json($chart_month_sales),
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

        var b = document.getElementById("kt_charts_widget_2_chart");
        var u = parseInt(KTUtil.css(b, "height"));

        new ApexCharts(b, {
            series: [{
                name: "Purchase Success ",
                data: @json($chart_success_purchase)
            }, {
                name: "Purchase Cancel",
                data: @json($chart_cancel_purchase)
            }, {
                name: "Purchase Pending",
                data: @json($chart_pending_purchase)
            }],
            chart: {
                fontFamily: "inherit",
                type: "bar",
                height: u,
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
                categories: @json($chart_month_purchase),
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
        }).render();

        var bi = document.getElementById("kt_charts_widget_3_chart");
        var ui = parseInt(KTUtil.css(bi, "height"));

        new ApexCharts(bi, {
            series: [{
                name: "Income ",
                data: @json($chart_success_income)
            }],
            chart: {
                fontFamily: "inherit",
                type: "bar",
                height: ui,
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
                categories: @json($chart_month_income),
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
            colors: [lx],
            grid: {
                borderColor: r,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: !0
                    }
                }
            },
        }).render();

        var bx = document.getElementById("kt_charts_widget_4_chart");
        var ux = parseInt(KTUtil.css(bx, "height"));

        new ApexCharts(bx, {
            series: [{
                name: "Income ",
                data: @json($chart_success_expense)
            }],
            chart: {
                fontFamily: "inherit",
                type: "bar",
                height: ux,
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
                categories: @json($chart_month_expense),
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
            colors: [l],
            grid: {
                borderColor: r,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: !0
                    }
                }
            },
        }).render();
    </script>
@endpush
