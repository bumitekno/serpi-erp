@extends('purchase::layouts.master')
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
            <form action="{{ route('purchase.store') }}" method="post">
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
                                <select class="form-select @error('supplier') is-invalid @enderror" data-control="select2"
                                    data-placeholder="Select an option Supplier" name="supplier">
                                    <option></option>
                                    @foreach ($supplier as $supplier)
                                        <option value="{{ $supplier->id }}"> {{ $supplier->name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('supplier'))
                                    <span class="text-danger">{{ $errors->first('supplier') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Ship To</label>
                            <div class="col-md-8">
                                <select class="form-select @error('departement') is-invalid @enderror"
                                    data-control="select2" data-placeholder="Select an option Departement"
                                    name="departement">
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
                                        data-control="select2" data-placeholder="Select an option Product"
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
                                        data-control="select2" data-placeholder="Select an option unit"
                                        name="addmore[units][]">
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
                                        class="form-control @error('addmore.qty.*') is-invalid @enderror"
                                        placeholder="QTY">
                                    @if ($errors->has('addmore.qty.*'))
                                        <span class="text-danger">{{ $errors->first('addmore.qty.*') }}</span>
                                    @endif
                                </td>
                                <td><input inputmode="text" name="addmore[unitprice][]"
                                        class="form-control @error('addmore.unitprice.*') is-invalid @enderror kt_inputmask_6"
                                        placeholder="Unit Price " data-type='currency'>
                                    @if ($errors->has('addmore.unitprice.*'))
                                        <span class="text-danger">{{ $errors->first('addmore.unitprice.*') }}</span>
                                    @endif
                                </td>
                                <td><input type="number" name="addmore[amount][]"
                                        class="form-control @error('addmore.amount.*') is-invalid @enderror form-control-solid"
                                        placeholder="Amount " readonly="readonly">
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
        var index = 0;
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
