@extends('purchase::layouts.master')
@section('content')
    @if ($transaction->id_method_payment == 3)
        <div class="alert alert-warning d-flex align-items-center p-5 mb-10">
            <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
            <span class="svg-icon svg-icon-2hx svg-icon-warning me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
                <h4 class="mb-1 text-warning">Edit Form Purchase </h4>
                <span>
                    Changing the purchase transaction will cause the payment due date to be reset. Please check first.
                </span>
            </div>
        </div>
    @endif
    <div class="card mb-3 ">
        <div class="card-header mt-3">
            <div class="float-start">
                Edit Purchase Order
            </div>
            <div class="float-end">
                <a href="{{ route('purchase.index') }}" class="btn btn-sm btn-dark my-2 ">Back</a>
            </div>
        </div>

        <!--begin::Body-->
        <div class="card-body p-lg-20" id="printarea">
            <form action="{{ route('purchase.update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">P.O Number</label>
                            <div class="col-md-8">
                                <input type="text" name="ponumber" class="form-control form-control-solid"
                                    value="{{ $transaction->code_transaction }}" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Date</label>
                            <div class="col-md-8">
                                <input type="date" name="date_transaction"
                                    class="form-control @error('date_transaction') is-invalid @enderror kt_datepicker"
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $transaction->date_purchase)->format('Y-m-d') }}>
                                @if ($errors->has('date_transaction'))
                                    <span class="text-danger">{{ $errors->first('date_transaction') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Supplier</label>
                            <div class="col-md-8">
                                <div class="float-start">
                                    <select class="form-select @error('supplier') is-invalid @enderror"
                                        data-control="select2" data-placeholder="Select Supplier" name="supplier">
                                        <option></option>
                                        @foreach ($supplier as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                @if ($transaction->id_supplier == $supplier->id) selected="selected" @endif>
                                                {{ $supplier->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('supplier'))
                                        <span class="text-danger">{{ $errors->first('supplier') }}</span>
                                    @endif
                                </div>
                                <div class="float-end">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Departement</label>
                            <div class="col-md-8">
                                <select class="form-select @error('departement') is-invalid @enderror"
                                    data-control="select2" data-placeholder="Select Departement" name="departement">
                                    <option></option>
                                    @foreach ($departement as $departement)
                                        <option value="{{ $departement->id }}"
                                            @if ($transaction->id_departement == $departement->id) selected="selected" @endif>
                                            {{ $departement->name }} </option>
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
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Payment</label>
                            <div class="col-md-8">
                                <select class="form-select @error('methodpayment') is-invalid @enderror"
                                    data-control="select2" data-placeholder="Select Method Payment" name="methodpayment">
                                    <option></option>
                                    @foreach ($method_payment as $method_payment)
                                        <option value="{{ $method_payment->id }}"
                                            @if ($transaction->id_method_payment == $method_payment->id) selected="selected" @endif>
                                            {{ $method_payment->name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('methodpayment'))
                                    <span class="text-danger">{{ $errors->first('methodpayment') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Due Date</label>
                            <div class="col-md-8">
                                <input type="date" name="date_due"
                                    class="form-control @error('date_due') is-invalid @enderror kt_datepicker"
                                    value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $transaction->date_due)->format('Y-m-d') }}">
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
                                <textarea name="note_purchase" class="form-control">{{ $transaction?->note }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <!--begin::Label-->
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">
                                Attachment</label>
                            <!--end::Label-->
                            <div class="col-md-6">
                                <input type="file" name="image_purchase" accept=".png, .jpg, .jpeg" />
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Image input-->
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <table class="table table-hover" id="dynamicTable">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                <th>Name Product</th>
                                <th>Unit Product </th>
                                <th>QTY </th>
                                <th>Unit Price </th>
                                <th>Amount </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($detail_transaction as $key =>  $details)
                                <tr class="tr_clone" data-id="{{ $key }}">
                                    <td>
                                        <select
                                            class="form-select  form-control-sm items @error('addmore.product.*') is-invalid @enderror"
                                            data-control="select2" data-placeholder="SelectProduct"
                                            name="addmore[product][]">
                                            <option></option>
                                            @foreach ($product as $products)
                                                <option value="{{ $products->id }}"
                                                    @if ($details->id_product == $products->id) selected="selected" @endif>
                                                    {{ $products->name }}
                                                    {{ $products->code_product }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('addmore.product.*'))
                                            <span class="text-danger">{{ $errors->first('addmore.product.*') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <select
                                            class="form-select form-control-sm items @error('addmore.units.*')is-invalid @enderror"
                                            data-control="select2" data-placeholder="Select unit"
                                            name="addmore[units][]">
                                            <option></option>
                                            @foreach ($unit as $units)
                                                <option value="{{ $units->id }}"
                                                    @if ($details->id_unit == $units->id) selected="selected" @endif>
                                                    {{ $units->name }} </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('addmore.units.*'))
                                            <span class="text-danger">{{ $errors->first('addmore.units.*') }}</span>
                                        @endif
                                    </td>
                                    <td><input type="number" name="addmore[qty][]"
                                            class="form-control @error('addmore.qty.*') is-invalid @enderror kt_inputqty"
                                            placeholder="QTY" value="{{ $details->qty }}">
                                        @if ($errors->has('addmore.qty.*'))
                                            <span class="text-danger">{{ $errors->first('addmore.qty.*') }}</span>
                                        @endif
                                    </td>
                                    <td><input inputmode="text" name="addmore[unitprice][]"
                                            class="form-control @error('addmore.unitprice.*') is-invalid @enderror kt_inputmask"
                                            placeholder="Unit Price " data-type='currency'
                                            value="{{ $details->price_purchase }}">
                                        @if ($errors->has('addmore.unitprice.*'))
                                            <span class="text-danger">{{ $errors->first('addmore.unitprice.*') }}</span>
                                        @endif
                                    </td>
                                    <td><input type="text" name="addmore[amount][]"
                                            class="form-control @error('addmore.amount.*') is-invalid @enderror kt_inputamount kt_inputmask form-control-solid"
                                            placeholder="Amount " readonly="readonly"
                                            data-currency="{{ $details->price_purchase * $details->qty }}"
                                            value="{{ $details->price_purchase * $details->qty }}">
                                        @if ($errors->has('addmore.amount.*'))
                                            <span class="text-danger">{{ $errors->first('addmore.amount.*') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            @if ($key < 1)
                                                <span
                                                    class="btn btn-success btn-sm add-select icon text-white-50 mt-1 mb-1 me-2">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                            @endif
                                            @if ($key > 0)
                                                <span
                                                    class="btn btn-danger btn-sm remove-select btn-del-select icon text-white-50 mt-1 mb-1">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td>Subtotal</td>
                                <td>
                                    <input type="text" name="subtotal"
                                        class="form-control kt_inputmask form-control-solid" placeholder="0 "
                                        readonly="readonly" data-currency="0">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>Discount</td>
                                <td> <input type="text" name="discount" class="form-control  kt_inputmask"
                                        placeholder="0" readonly="readonly"
                                        data-currency="{{ $transaction->discount_amount }}"
                                        value="{{ $transaction->discount_amount }}"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>Tax</td>
                                <td><input type="text" name="tax" class="form-control kt_inputmask"
                                        placeholder="0" readonly="readonly"
                                        data-currency="{{ $transaction->tax_amount }}"
                                        value="{{ $transaction->tax_amount }}"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>Total</td>
                                <td><input type="text" name="total"
                                        class="form-control kt_inputmask form-control-solid" placeholder="0"
                                        readonly="readonly"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="mb-3 row">
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Purchase ">
                </div>
            </form>
        </div>
        <!--end::Body-->
    </div>
@endsection
@push('scripts')
    <script>
        $('#kt_body').attr('data-kt-aside-minimize', 'on');
        var index = 0;
        $(".kt_datepicker").flatpickr({
            dateFormat: "d/m/Y",
            defaultDate: new Date()
        });


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
            $clone.find('.kt_inputamount').attr('data-currency', 0);
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
                'groupSeparator': '.',
                'alias': 'currency'
            }).mask($clone.find('.kt_inputmask'));
            calculate();
        });
        $(document).on('click', '.remove-select', function() {
            $(this).parents('tr').remove();
            index--;
            calculate();
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

        calculate();

        function calculate() {
            var currency = 0;
            var discount = $('input[name=discount]').attr('data-currency');
            var tax = $('input[name=tax]').attr('data-currency');
            $('input.kt_inputamount').each(function(e) {
                currency += parseInt($(this).attr('data-currency').toString());
            });
            $('input[name=subtotal]').val(currency);
            if (currency > 0) {
                $('input[name=discount]').removeAttr('readonly');
                $('input[name=tax]').removeAttr('readonly');
            }
            var total = parseInt(currency) - parseInt(discount) + parseInt(tax);
            $('input[name=total]').val(total);
        }

        $('body').on('keyup', 'input[name=discount]', function(e) {
            var replace_currency = e.target.value.replace(/\D/g, "");
            $(this).attr('data-currency', replace_currency);
            calculate();
        });

        $('body').on('keyup', 'input[name=tax]', function(e) {
            var replace_currency = e.target.value.replace(/\D/g, "");
            $(this).attr('data-currency', replace_currency);
            calculate();
        });

        //calculate
        $('body').on('keyup', '.kt_inputmask', function(e) {
            //var id = $(this).closest('tr').attr('data-id');
            if (e.target.value.length > 0) {
                var replace_currency = e.target.value.replace(/\D/g, "");
                var qty = $(this).closest('tr').find('input.kt_inputqty').val();
                var change = parseInt(replace_currency) * parseInt(qty);
                $(this).closest('tr').find('input.kt_inputamount').val(change);
                $(this).closest('tr').find('input.kt_inputamount').attr('data-currency', change);
            } else {
                $(this).closest('tr').find('input.kt_inputamount').val('');
                $(this).closest('tr').find('input.kt_inputamount').attr('data-currency', 0);
            }
            calculate();
        });
    </script>
@endpush
