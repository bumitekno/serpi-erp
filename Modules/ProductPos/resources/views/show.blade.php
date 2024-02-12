@extends('productpos::layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Product Information
                    </div>
                    <div class="float-end">
                        <a href="{{ route('productpos.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="mb-3 row">
                        <label for="avatar" class="col-lg-4 fw-bold text-muted text-end"><strong>Image:</strong></label>
                        <div class="col-md-8">
                            <div class="symbol-label symbol symbol-circle symbol-150px">
                                @if (!empty($product->image_product))
                                    <img src="{{ Storage::url($product->image_product) }}" alt="Product" class="w-100" />
                                @else
                                    <img src="https://fakeimg.pl/100x100" alt="Product" class="w-100" />
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Name:</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $product->name }} </span>
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Code Product
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $product->code_product }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Category
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $product->category_product?->name }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Warehouse
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $product->warehouse?->name }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Location
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $product->location?->name_location }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Stock Min
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $product?->stock_min }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Stock Max
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $product?->stock_max }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Expired Date
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">
                                {{ empty($product->date_expired) ? '-' : \Carbon\Carbon::parse($product->date_expired)->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="description"
                            class="col-lg-4 fw-bold text-muted text-end"><strong>Description:</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $product->description }} </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
