@extends('purchase::layouts.master')
@push('modals')
    <div class="modal fade" tabindex="-1" id="kt_modal_supplier">
        <form id="kt_docs_formvalidation_text" class="form" action="{{ route('purchase.storesupplier') }}" autocomplete="off"
            method="POST">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add Supplier </h3>

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
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Create Purchase Order
            </div>
            <div class="float-end">
                <a href="{{ route('purchase.index') }}" class="btn btn-success btn-sm my-2"><i
                        class="bi bi-plus-arrow-left"></i>
                    Back </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('purchase.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">P.O Number</label>
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
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Supplier</label>
                            <div class="col-md-8">
                                <div class="float-start">
                                    <select class="form-select @error('supplier') is-invalid @enderror"
                                        data-control="select2" data-placeholder="Select Supplier" name="supplier">
                                        <option></option>
                                        @foreach ($supplier as $supplier)
                                            <option value="{{ $supplier->id }}"> {{ $supplier->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('supplier'))
                                        <span class="text-danger">{{ $errors->first('supplier') }}</span>
                                    @endif
                                </div>
                                <div class="float-end">
                                    <a href="javascript:;" class="btn btn-bg-light btn-icon-info btn-text-info mb-2"
                                        data-bs-toggle="modal" data-bs-target="#kt_modal_supplier">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3 row">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-end text-start">Departement</label>
                            <div class="col-md-8">
                                <select class="form-select @error('departement') is-invalid @enderror"
                                    data-control="select2" data-placeholder="Select Departement" name="departement">
                                    <option></option>
                                    @foreach ($departement as $departement)
                                        <option value="{{ $departement->id }}"> {{ $departement->name }} </option>
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
                                        <option value="{{ $method_payment->id }}"> {{ $method_payment->name }} </option>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr_clone" data-id="0">
                                <td>
                                    <select
                                        class="form-select  form-control-sm items @error('addmore.product.*') is-invalid @enderror"
                                        data-control="select2" data-placeholder="Select  Product"
                                        name="addmore[product][]">
                                        <option></option>
                                        @foreach ($product as $product)
                                            <option value="{{ $product->id }}"> {{ $product->name }}
                                                {{ $product->code_product }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('addmore.product.*'))
                                        <span class="text-danger">{{ $errors->first('addmore.product.*') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <select
                                        class="form-select form-control-sm items @error('addmore.units.*')is-invalid @enderror"
                                        data-control="select2" data-placeholder="Select unit" name="addmore[units][]">
                                        <option></option>
                                        @foreach ($unit as $unit)
                                            <option value="{{ $unit->id }}"> {{ $unit->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('addmore.units.*'))
                                        <span class="text-danger">{{ $errors->first('addmore.units.*') }}</span>
                                    @endif
                                </td>
                                <td><input type="number" name="addmore[qty][]"
                                        class="form-control @error('addmore.qty.*') is-invalid @enderror kt_inputqty"
                                        placeholder="QTY">
                                    @if ($errors->has('addmore.qty.*'))
                                        <span class="text-danger">{{ $errors->first('addmore.qty.*') }}</span>
                                    @endif
                                </td>
                                <td><input inputmode="text" name="addmore[unitprice][]"
                                        class="form-control @error('addmore.unitprice.*') is-invalid @enderror kt_inputmask"
                                        placeholder="Unit Price " data-type='currency'>
                                    @if ($errors->has('addmore.unitprice.*'))
                                        <span class="text-danger">{{ $errors->first('addmore.unitprice.*') }}</span>
                                    @endif
                                </td>
                                <td><input type="text" name="addmore[amount][]"
                                        class="form-control @error('addmore.amount.*') is-invalid @enderror kt_inputamount kt_inputmask form-control-solid"
                                        placeholder="Amount " readonly="readonly" data-currency="0">
                                    @if ($errors->has('addmore.amount.*'))
                                        <span class="text-danger">{{ $errors->first('addmore.amount.*') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <span class="btn btn-success btn-sm add-select icon text-white-50 mt-1 mb-1 me-2">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span
                                            class="btn btn-danger btn-sm remove-select btn-del-select icon text-white-50 mt-1 mb-1">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </div>
                                </td>
                            </tr>
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
                                        placeholder="0" readonly="readonly" data-currency="0"></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>Tax</td>
                                <td><input type="text" name="tax" class="form-control kt_inputmask"
                                        placeholder="0" readonly="readonly" data-currency="0"></td>
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
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Create Purchase ">
                </div>
            </form>
        </div>
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

        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }

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
    </script>
@endpush
