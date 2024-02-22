@extends('productpos::layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header mt-3 ">
                    <div class="float-start">
                        Edit Product
                    </div>
                    <div class="float-end">
                        <a href="{{ route('productpos.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('productpos.update', $product->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="code_product" class="col-md-4 col-form-label text-md-end text-start">Code
                                Product</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control @error('code_product') is-invalid @enderror form-control-solid"
                                    id="code_product" name="code_product" value="{{ $product->code_product }}" readonly>
                                @if ($errors->has('code_product'))
                                    <span class="text-danger">{{ $errors->first('code_product') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ $product->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Category</label>
                            <div class="col-md-6">

                                <select class="form-select @error('category') is-invalid @enderror" data-control="select2"
                                    data-placeholder="Select an option category" name="category">
                                    <option></option>
                                    @foreach ($category_product as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == $product->category_product?->id) selected="selected" @endif>
                                            {{ $category->name }} </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('category'))
                                    <span class="text-danger">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Warehouse</label>
                            <div class="col-md-6">
                                <select class="form-select @error('warehouse') is-invalid @enderror" data-control="select2"
                                    data-placeholder="Select Warehouse" name="warehouse">
                                    <option></option>
                                    @foreach ($warehouse as $warehouses)
                                        <option value="{{ $warehouses->id }}"
                                            @if ($warehouses->id == $product->id_warehouse) selected="selected" @endif>
                                            {{ $warehouses->name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('warehouse'))
                                    <span class="text-danger">{{ $errors->first('warehouse') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Location</label>
                            <div class="col-md-6">
                                <select class="form-select @error('location') is-invalid @enderror" data-control="select2"
                                    data-placeholder="Select Location" name="location">
                                    <option></option>
                                    @foreach ($location as $locations)
                                        <option value="{{ $locations->id }}"
                                            @if ($locations->id == $product->id_location) selected="selected" @endif>
                                            {{ $locations->name_location }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('location'))
                                    <span class="text-danger">{{ $errors->first('location') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <!--begin::Label-->
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Image</label>
                            <!--end::Label-->
                            <div class="col-md-6">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url({{ asset('assets/media/avatars/blank.png') }})">
                                    <!--begin::Preview existing avatar-->

                                    @if (!empty($product->image_product))
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url({{ Storage::url($product->image_product) }});">
                                        </div>
                                    @else
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url('https://fakeimg.pl/100x100')">
                                        </div>
                                    @endif

                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change Image">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="image_product" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel Image">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Cancel-->

                                </div>
                                <!--begin::Hint-->
                                @if ($errors->has('image_product'))
                                    <span class="text-danger">{{ $errors->first('image_product') }}</span>
                                @endif
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Image input-->
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Stock Min</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('stockmin') is-invalid @enderror"
                                    id="stockmin" name="stockmin" value="{{ $product->stock_min }}" placeholder="0">
                                @if ($errors->has('stockmin'))
                                    <span class="text-danger">{{ $errors->first('stockmin') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Stock Max</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('stockmax') is-invalid @enderror"
                                    id="stockmax" name="stockmax" value="{{ $product->stock_max }}" placeholder="0">
                                @if ($errors->has('stockmax'))
                                    <span class="text-danger">{{ $errors->first('stockmax') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Price
                                Purchase</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control @error('pricepurchase') is-invalid @enderror kt_inputmask"
                                    id="pricepurchase" name="pricepurchase" value="{{ $product->price_purchase }}"
                                    placeholder="0">
                                @if ($errors->has('pricepurchase'))
                                    <span class="text-danger">{{ $errors->first('pricepurchase') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Price
                                Sell</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control @error('pricesell') is-invalid @enderror kt_inputmask"
                                    id="pricesell" name="pricesell" value="{{ $product->price_sell }}" placeholder="0">
                                @if ($errors->has('pricesell'))
                                    <span class="text-danger">{{ $errors->first('pricesell') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Expired
                                Date</label>
                            <div class="col-md-6">
                                <input type="date"
                                    class="form-control @error('expired') is-invalid @enderror kt_datepicker"
                                    id="expired" name="expired" value="{{ $product->date_expired }}">
                                @if ($errors->has('expired'))
                                    <span class="text-danger">{{ $errors->first('expired') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">

                            <label class="form-check-label col-md-4 col-form-label text-md-end text-start"
                                for="flexSwitch20x30">
                                Enabled
                            </label>

                            <div class="form-check form-switch form-check-custom form-check-solid col-md-6">
                                <input class="form-check-input h-20px w-30px" type="checkbox" name="enabled"
                                    @if ($product->enabled == 1) checked="checked" @endif value="1"
                                    id="flexSwitch20x30" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description"
                                class="col-md-4 col-form-label text-md-end text-start">Description</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    placeholder="Insert Description">{{ $product->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(".kt_datepicker").flatpickr({
            dateFormat: "d/m/Y",
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
    </script>
@endpush
