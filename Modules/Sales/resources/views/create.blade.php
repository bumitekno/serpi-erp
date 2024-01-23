@extends('purchase::layouts.master')
@push('styles')
    <style>
        div.scrollmenu {
            overflow: auto;
            white-space: nowrap;
        }

        div.scrollmenu a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px;
            text-decoration: none;
        }

        .fs-large {
            font-size: 5.75rem !important;
        }
    </style>
@endpush
@section('content')
    <div class="row g-5 g-xl-8">
        <div class="col-xl-12">
            <!--begin::Tables Widget 5-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body py-3">
                    <div class="row">
                        <div class="col-lg-6">
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
                                        <a href="javascript:;" class="btn btn-bg-light btn-icon-info btn-text-info mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen006.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
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
                            <div class="mb-3 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end text-start">Departement</label>
                                <div class="col-md-8">
                                    <select class="form-select @error('departement') is-invalid @enderror"
                                        data-control="select2" data-placeholder="Select Departement" name="customer">
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
                        <div class="col-lg-6">
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-start text-start">Date</label>
                                <div class="col-md-4">
                                    <input type="date" name="date_transaction"
                                        class="form-control @error('date_transaction') is-invalid @enderror kt_datepicker text-start"
                                        value="{{ $date_transaction }}">
                                    @if ($errors->has('date_transaction'))
                                        <span class="text-danger">{{ $errors->first('date_transaction') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row ">
                                <label for="name" class="col-md-4 col-form-label text-md-start text-start">Total Cart
                                </label>
                                <div
                                    class="col-md-12 card  @if ($total_cart > 0) bg-primary @else bg-danger @endif">
                                    <h1 class="fs-large text-end text-white">
                                        {{ number_format($total_cart, 0, ',', '.') }}
                                    </h1>
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

    <div class="scrollmenu">
        <div class="card-rounded bg-light d-flex flex-stack flex-wrap p-0 mb-3">
            <!--begin::Nav-->
            <ul class="nav flex-wrap border-transparent fw-bolder">
                <!--begin::Nav item-->
                <li class="nav-item my-1">
                    <a class="btn btn-color-gray-600 btn-active-white btn-active-color-primary fw-boldest fs-8 fs-lg-base nav-link px-3 px-lg-8 mx-1 text-uppercase @if (request()->segment(2) == 'all') active @endif"
                        href="{{ route('sales.filter', ['filter' => 'all']) }}">All</a>
                </li>
                <!--end::Nav item-->
                @forelse($category_product as $categorys)
                    <!--begin::Nav item-->
                    <li class="nav-item my-1">
                        <a class="btn btn-color-gray-600 btn-active-white btn-active-color-primary fw-boldest fs-8 fs-lg-base nav-link px-3 px-lg-8 mx-1 text-uppercase @if (request()->segment(2) == $categorys->id) active @endif"
                            href="{{ route('sales.filter', ['filter' => $categorys->id]) }}">
                            {{ Str::title($categorys->name) }}</a>
                    </li>
                @empty
                @endforelse

            </ul>
            <!--end::Nav-->
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
                    <a href="{{ url()->previous() }}" class="btn btn-danger btn-icon-white btn-text-white ps-5 w-120px">
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
            <div class="row g-4 g-xl-4 mb-6 mb-xl-4">
                @forelse ($product as $products)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <!--begin::Card-->
                        <div class="card h-100">
                            <!--begin::Card body-->
                            <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                <!--begin::Name-->
                                <a href="{{ route('sales.addcart', $products->id) }}"
                                    class="text-gray-800 text-hover-primary d-flex flex-column">
                                    <!--begin::Image-->
                                    <div class="symbol symbol-100px mb-5">
                                        @if (!empty($products->image_product))
                                            <img src="{{ Storage::url($products->image_product) }}" alt="Product"
                                                class="w-100" />
                                        @else
                                            <img src="https://fakeimg.pl/100x100" alt="Product" class="w-100" />
                                        @endif
                                    </div>
                                    <!--end::Image-->
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-bolder mb-2">{{ $products->name ?? '' }}</div>
                                    <!--end::Title-->
                                </a>
                                <!--end::Name-->
                                <!--begin::Description-->
                                <div class="fs-7 fw-bold text-gray-400">
                                    {{ $products->category_product?->name }}
                                </div>
                                <!--end::Description-->
                                <div class="fs-7 fw-bold text-gray-400">
                                    {{ empty($products->price_sell) ? 0 : number_format($products->price_sell, 0, ',', '.') }}
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                @empty

                    <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                        <!--begin::Icon-->
                        <!--begin::Svg Icon | path: icons/duotune/communication/com003.svg-->
                        <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
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
            <div class="mb-3 mt-3 row">
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
                            <span class="text-muted mt-1 fw-bold fs-7">Cart Item </span>
                        </h3>
                        @if (!empty($cart))
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
                        <div class="scroll h-400px">
                            @forelse($cart as $key => $cart_item)
                                <div class="d-flex align-items-sm-center mb-7">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-60px symbol-2by3 me-4">
                                        <div class="symbol-label"
                                            style="background-image: url('assets/media/stock/600x400/img-17.jpg')"></div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Content-->
                                    <div class="d-flex flex-row-fluid align-items-center flex-wrap my-lg-0 me-2">
                                        <!--begin::Title-->
                                        <div class="flex-grow-1 my-lg-0 my-2 me-2">
                                            <a href="javascript:;"
                                                class="text-gray-800 fw-bolder text-hover-primary fs-6">{{ Str::title($cart[$key]['name_product']) }}</a>
                                            <span
                                                class="text-muted fw-bold d-block pt-1">{{ empty($cart[$key]['price_unit']) ? 0 : number_format($cart[$key]['price_unit'], 0, ',', '.') }}</span>
                                            <span class="text-gray-800 fw-bolder">x</span>
                                            <span class="text-gray-800 fw-bolder">{{ $cart[$key]['qty'] }}</span>
                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center">

                                            <div class="me-6">
                                                <span
                                                    class="text-gray-800 fw-bolder">{{ number_format($cart[$key]['price_unit'] * $cart[$key]['qty'], 0, ',', '.') }}</span>
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
                </div>
            </div>

            @if (!empty($cart))
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Method Payment</label>
                    <div class="col-md-8">
                        <select class="form-select @error('methodpayment') is-invalid @enderror" data-control="select2"
                            data-placeholder="Select Method Payment" name="methodpayment">
                            <option></option>
                            @foreach ($method_payment as $method_payments)
                                <option value="{{ $method_payments->id }}"> {{ $method_payments->name }} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('methodpayment'))
                            <span class="text-danger">{{ $errors->first('methodpayment') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <button type="button" class="btn btn-primary">Pay Now</button>
                </div>
            @endif

        </div>
        <!--end::Col-->
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#kt_body').attr('data-kt-aside-minimize', 'on');

        $(".kt_datepicker").flatpickr({
            dateFormat: "d/m/Y",
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
    </script>
@endpush
