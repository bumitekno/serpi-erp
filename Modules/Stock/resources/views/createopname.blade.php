@extends('stock::layouts.master')
@section('content')
    <form action="{{ route('stock.storeopname') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mb-3">
            <div class="card-header mt-3">
                <div class="float-start">
                    Create Stock Opname
                </div>
                <div class="float-end ">
                    <div class="d-flex">
                        <a href="{{ route('stock.index') }}" class="btn btn-primary btn-sm me-2">&larr; Back</a>
                        <button type="submit" class="btn btn-info btn-sm">Create Opname </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Warehouse</label>
                    <div class="col-md-4">
                        <select class="form-select " data-control="select2" data-placeholder="Select an option warehouse"
                            name="warehouse">
                            <option></option>
                            @foreach ($warehouse as $warehouse)
                                <option value="{{ $warehouse->id }}"
                                    @if (!empty(request()->get('warehouse')) && request()->get('warehouse') == $warehouse->id) selected="selected" @endif> {{ $warehouse->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Location</label>
                    <div class="col-md-4">
                        <select class="form-select " data-control="select2" data-placeholder="Select an option location"
                            name="location">
                            <option></option>
                            @foreach ($location as $location)
                                <option value="{{ $location->id }}"
                                    @if (!empty(request()->get('location')) && request()->get('location') == $location->id) selected="selected" @endif>
                                    {{ $location->name_location }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="mb-3 row table-responsive">
                    <table class="table table-hover" id="dynamicTable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Unit</th>
                                <th>Stock Before </th>
                                <th>Stock After </th>
                                <th>Difference </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty(request()->get('warehouse')) && !empty(request()->get('location')))
                                <tr class="tr_clone" data-id="0">
                                    <td>
                                        <select
                                            class="form-select product form-control-sm items @error('addmore.product.*') is-invalid @enderror"
                                            data-control="select2" data-placeholder="Select Product"
                                            name="addmore[product][]">
                                            <option></option>
                                            @foreach ($product as $product)
                                                <option value="{{ $product->id }}"> {{ $product->code_product }}
                                                    {{ $product->name }} </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('addmore.product.*'))
                                            <span class="text-danger">{{ $errors->first('addmore.product.*') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <select
                                            class="form-select form-control-sm items units @error('addmore.units.*')is-invalid @enderror"
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

                                    <td><input type="number" name="addmore[qty_before][]"
                                            class="form-control qty_before @error('addmore.qty_before.*') is-invalid @enderror "
                                            placeholder="0">
                                        @if ($errors->has('addmore.qty_before.*'))
                                            <span class="text-danger">{{ $errors->first('addmore.qty_before.*') }}</span>
                                        @endif
                                    </td>

                                    <td><input type="number" name="addmore[qty_after][]"
                                            class="form-control qty_after @error('addmore.qty_after.*') is-invalid @enderror"
                                            placeholder="0">
                                        @if ($errors->has('addmore.qty_after.*'))
                                            <span class="text-danger">{{ $errors->first('addmore.qty_after.*') }}</span>
                                        @endif
                                    </td>

                                    <td><input type="number" name="addmore[qty_difference][]"
                                            class="form-control form-control-solid qty_difference  @error('addmore.qty_difference.*') is-invalid @enderror"
                                            placeholder="0" readonly>
                                        @if ($errors->has('addmore.qty_difference.*'))
                                            <span
                                                class="text-danger">{{ $errors->first('addmore.qty_difference.*') }}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex">
                                            <span
                                                class="btn btn-success btn-sm add-select icon text-white-50 mt-1 mb-1 me-2">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                            <span
                                                class="btn btn-danger btn-sm remove-select btn-del-select icon text-white-50 mt-1 mb-1">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="6">
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
                                                <span>Choose Warehouse and Location !</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                History Stock Opname
            </div>
            <div class="float-end ">
            </div>
        </div>
        <div class="card-body">
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        var index = 0;
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('change', 'select[name=warehouse]', function(e) {
                var url = " {{ route('stock.createopname') }}?warehouse=" + e.target.value;
                window.location.href = url;
            });
            $('body').on('change', 'select[name=location]', function(e) {
                var url = " {{ route('stock.createopname') }}?warehouse=" + $(
                    'select[name=warehouse] option:selected').val() + '&location=' + e.target.value;
                window.location.href = url;
            });

            $('.btn-del-select').hide();
            $('.items').select2();
            $("table").on('click', '.add-select', function() {
                $("select.select2-hidden-accessible.items").select2('destroy');
                index++;
                var $tr = $(this).closest('.tr_clone');
                var $clone = $tr.clone().insertBefore($(this).parent()).attr('data-id', index);
                $tr.after($clone);
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

            $('body').on('change', 'select.product', function(e) {
                var index_id = $(this).closest('tr');
                $.ajax({
                    url: "{{ route('stock.ajaxproduct') }}",
                    type: "POST",
                    data: {
                        id: e.target.value,
                        id_warehouse: $(
                            'select[name=warehouse] option:selected').val(),
                        id_location: $(
                            'select[name=location] option:selected').val()
                    },
                    success: function(r) {
                        index_id.find('input.qty_before').val(r.data
                            .stock_last);
                        index_id.find('select.units').select2().val(1).change();
                    },
                    error: function(e) {}
                });
            });

            $('body').on('keyup', 'input.qty_after', function(e) {
                var index_id = $(this).closest('tr');
                var stock_last = index_id.find('input.qty_before').val();
                var diff = e.target.value - stock_last;
                index_id.find('input.qty_difference').val(diff);
            });
        });
    </script>
@endpush
