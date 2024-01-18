@extends('stock::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Create Stock
            </div>
            <div class="float-end">
                <a href="{{ route('stock.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
        </div>
        <div class="card-body">

            @if (\Session::has('error'))
                <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                    <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
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
                        <span>{!! \Session::get('error') !!}.</span>
                    </div>
                </div>
            @endif

            <form action="{{ route('stock.store') }}" method="post">
                @csrf

                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Warehouse</label>
                    <div class="col-md-4">
                        <select class="form-select @error('warehouse') is-invalid @enderror" data-control="select2"
                            data-placeholder="Select an option warehouse" name="warehouse">
                            <option></option>
                            @foreach ($warehouse as $warehouse)
                                <option value="{{ $warehouse->id }}"> {{ $warehouse->name }} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('warehouse'))
                            <span class="text-danger">{{ $errors->first('warehouse') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Location</label>
                    <div class="col-md-4">
                        <select class="form-select @error('location') is-invalid @enderror" data-control="select2"
                            data-placeholder="Select an option location" name="location">
                            <option></option>
                            @foreach ($location as $location)
                                <option value="{{ $location->id }}"> {{ $location->name_location }} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('location'))
                            <span class="text-danger">{{ $errors->first('location') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <table class="table table-hover" id="dynamicTable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Unit</th>
                                <th>Stock Min </th>
                                <th>Stock Last </th>
                                <th>Date Expired </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr_clone">
                                <td>
                                    <select
                                        class="form-select  form-control-sm items @error('addmore.product.*') is-invalid @enderror"
                                        data-control="select2" data-placeholder="Select an option Product"
                                        name="addmore[product][]">
                                        <option></option>
                                        @foreach ($product as $product)
                                            <option value="{{ $product->id }}"> {{ $product->name }} </option>
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
                                <td><input type="number" name="addmore[stockmin][]"
                                        class="form-control @error('addmore.stockmin.*') is-invalid @enderror"
                                        placeholder="Stock Min">
                                    @if ($errors->has('addmore.stockmin.*'))
                                        <span class="text-danger">{{ $errors->first('addmore.stockmin.*') }}</span>
                                    @endif
                                </td>
                                <td><input type="number" name="addmore[stocklast][]" class="form-control"
                                        placeholder="Stock Last">
                                </td>

                                <td><input type="date" name="addmore[expired][]" class="form-control"
                                        placeholder="Date Expired" id="kt_datepicker_1">
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
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $("#kt_datepicker_1").flatpickr({
            dateFormat: "d-m-Y",
        });
        $('.btn-del-select').hide();
        $('.items').select2();
        $("table").on('click', '.add-select', function() {
            $("select.select2-hidden-accessible.items").select2('destroy');
            var $tr = $(this).closest('.tr_clone');
            var $clone = $tr.clone().insertBefore($(this).parent()).removeClass("tr_clone");
            $tr.after($clone);
            $clone.find('.btn-del-select').fadeIn();
            $clone.find('.add-select').hide();
            $('.items').select2();
            $clone.find('.items').select2();
            $clone.find('input').val('');
        });
        $(document).on('click', '.remove-select', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endpush
