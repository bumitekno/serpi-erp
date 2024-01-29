@extends('stock::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Edit Stock
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
            <form action="{{ route('stock.update', $stock->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Warehouse</label>
                    <div class="col-md-4">
                        <select class="form-select @error('warehouse') is-invalid @enderror" data-control="select2"
                            data-placeholder="Select an option warehouse" name="warehouse">
                            <option></option>
                            @foreach ($warehouse as $warehouse)
                                <option value="{{ $warehouse->id }}"
                                    @if ($stock->id_warehouse == $warehouse->id) selected="selected" @endif> {{ $warehouse->name }}
                                </option>
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
                                <option value="{{ $location->id }}"
                                    @if ($stock->id_location == $location->id) selected="selected" @endif>
                                    {{ $location->name_location }} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('location'))
                            <span class="text-danger">{{ $errors->first('location') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Product</label>
                    <div class="col-md-4">
                        <select class="form-select @error('product') is-invalid @enderror form-select-solid"
                            data-control="select2" data-placeholder="Select an option unit" name="product"
                            readonly="readonly">
                            <option></option>
                            @foreach ($product as $product)
                                <option value="{{ $product->id }}"
                                    @if ($stock->id_product == $product->id) selected="selected" @endif>
                                    {{ $product->name }} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('product'))
                            <span class="text-danger">{{ $errors->first('product') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Unit</label>
                    <div class="col-md-4">
                        <select class="form-select @error('unit') is-invalid @enderror" data-control="select2"
                            data-placeholder="Select an option unit" name="unit">
                            <option></option>
                            @foreach ($unit as $unit)
                                <option value="{{ $unit->id }}"
                                    @if ($stock->id_unit == $unit->id) selected="selected" @endif>
                                    {{ $unit->name }} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('unit'))
                            <span class="text-danger">{{ $errors->first('unit') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">QTY Convert</label>
                    <div class="col-md-4">
                        <input type="number" name="qty_convert"
                            class="form-control @error('qty_convert') is-invalid @enderror" placeholder="Qty Convert"
                            value="{{ $stock->qty_convert }}">
                        @if ($errors->has('qty_convert'))
                            <span class="text-danger">{{ $errors->first('qty_convert') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection
