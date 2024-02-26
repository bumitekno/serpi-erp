@extends('stock::layouts.master')
@push('menu-tops')
    @include('menu-top-pos')
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Stock Product Information
                    </div>
                    <div class="float-end">
                        <a href="{{ route('stock.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="mb-3 row">
                        <label for="avatar" class="col-lg-4 fw-bold text-muted text-end"><strong>Image:</strong></label>
                        <div class="col-md-8">
                            <div class="symbol-label symbol symbol-circle symbol-150px">
                                @if (!empty($stock->products->image_product))
                                    <img src="{{ Storage::url($stock->products->image_product) }}" alt="Product"
                                        class="w-100" />
                                @else
                                    <img src="https://fakeimg.pl/100x100" alt="Product" class="w-100" />
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Name:</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $stock->products?->name }} </span>
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Code Product
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $stock->products?->code_product }} </span>
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Expired Date
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">
                                {{ empty($stock->date_expired) ? '-' : \Carbon\Carbon::parse($stock->date_expired)->translatedFormat('l, j F Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Unit
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $stock->units?->name }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Unit Price Purchase
                                (small)
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">
                                {{ empty($stock->products->price_purchase) ? 0 : number_format($stock->products->price_purchase, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Unit Price Sell
                                (small)
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">
                                {{ empty($stock->products->price_sell) ? 0 : number_format($stock->products->price_sell, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>
                                Description
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">
                                {{ empty($stock->products->description) ? '-' : $stock->products->description }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
