@extends('purchase::layouts.master')
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
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Date</label>
                                <div class="col-md-8">
                                    <input type="date" name="date_transaction"
                                        class="form-control @error('date_transaction') is-invalid @enderror kt_datepicker">
                                    @if ($errors->has('date_transaction'))
                                        <span class="text-danger">{{ $errors->first('date_transaction') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end text-start">Customer</label>
                                <div class="col-md-8">
                                    <select class="form-select @error('customer') is-invalid @enderror"
                                        data-control="select2" data-placeholder="Select an option customer" name="customer">
                                        <option></option>
                                        @foreach ($customer as $customer)
                                            <option value="{{ $customer->id }}"> {{ $customer->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('customer'))
                                        <span class="text-danger">{{ $errors->first('customer') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Payment</label>
                                <div class="col-md-8">
                                    <select class="form-select @error('methodpayment') is-invalid @enderror"
                                        data-control="select2" data-placeholder="Select an option Method Payment"
                                        name="methodpayment">
                                        <option></option>
                                        @foreach ($method_payment as $method_payment)
                                            <option value="{{ $method_payment->id }}"> {{ $method_payment->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('methodpayment'))
                                        <span class="text-danger">{{ $errors->first('methodpayment') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Due
                                    Date</label>
                                <div class="col-md-8">
                                    <input type="date" name="date_due"
                                        class="form-control @error('date_due') is-invalid @enderror kt_datepicker">
                                    @if ($errors->has('date_due'))
                                        <span class="text-danger">{{ $errors->first('date_due') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Note</label>
                                <div class="col-md-8">
                                    <textarea name="note_purchase" class="form-control"></textarea>
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
    <div class="row g-5 g-xl-8">
        <div class="col-xl-6">
            <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
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
                @endforelse

                {{ empty($product->links()) ? '' : $product->links() }}
            </div>
        </div>
        <!--begin::Col-->
        <div class="col-xl-6">
            <!--begin::Tables Widget 5-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">

                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">List Item</span>
                    </h3>
                    <div class="card-toolbar">
                        <div class="mb-3 row me-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Scan
                            </label>
                            <div class="col-lg-8">
                                <input type="text" name="search_product"class="form-control" placeholder="Code Barcode">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <a href="{{ route('sales.clearcart') }}" class="btn btn-danger"
                                onclick ="return confirm('Do you want to delete All this list item cart ?')">Clear Cart </a>
                        </div>
                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body py-3">

                    <div class="mb-3 row">
                        <table class="table table-hover" id="dynamicTable">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                    <th>Code Product</th>
                                    <th>Name Product</th>
                                    <th>Unit Product </th>
                                    <th>QTY </th>
                                    <th>Unit Price </th>
                                    <th>Amount </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($cart as $key => $cart_item)
                                    <tr>
                                        <td>{{ $cart[$key]['code_product'] ?? '-' }}</td>
                                        <td>{{ $cart[$key]['name_product'] ?? '-' }}</td>
                                        <td>{{ $cart[$key]['unit_id'] ?? '-' }}</td>
                                        <td>{{ $cart[$key]['qty'] ?? '-' }}</td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Tables Widget 5-->
        </div>
        <!--end::Col-->
    </div>
@endsection
@push('scripts')
    <script>
        var index = 0;

        $('#kt_body').attr('data-kt-aside-minimize', 'on');

        $(".kt_datepicker").flatpickr({
            dateFormat: "d-m-Y",
        });
        $('.btn-del-select').hide();
        $('.items').select2();
        $("table").on('click', '.add-select', function() {
            index++;
            $("select.select2-hidden-accessible.items").select2('destroy');
            var $tr = $(this).closest('.tr_clone');
            var $clone = $tr.clone().insertBefore($(this).parent()).attr('data-id', index);
            $tr.after($clone);
            $clone.find('tr').attr('data-id', index);
            $clone.find('.btn-del-select').fadeIn();
            $clone.find('.add-select').hide();
            $('.items').select2();
            $clone.find('.items').select2();
            $clone.find('input').val('');
        });
        $(document).on('click', '.remove-select', function() {
            $(this).parents('tr').remove();
            index--;
        });

        // Currency
        Inputmask("Rp 999.999.999,99", {
            "numericInput": true,
        }).mask(".kt_inputmask_6");

        let input = document.querySelector("input[data-type='currency']")
        input.addEventListener("keyup", (e) => {
            console.log(e.target.value);
        });
    </script>
@endpush
