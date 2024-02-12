@extends('stock::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Create Stock Convert
            </div>
            <div class="float-end">
                <a href="{{ route('stock.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
        </div>
        <div class="card-body">

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
                                <th>QTY Convert </th>
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


                                <td><input type="number" name="addmore[qty_convert][]"
                                        class="form-control @error('addmore.qty_convert.*') is-invalid @enderror"
                                        placeholder="Qty Convert">
                                    @if ($errors->has('addmore.qty_convert.*'))
                                        <span class="text-danger">{{ $errors->first('addmore.qty_convert.*') }}</span>
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
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
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
