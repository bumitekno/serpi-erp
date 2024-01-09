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
                        <label for="avatar"
                            class="col-md-4 col-form-label text-md-end text-start"><strong>Image:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            <div class="symbol-label symbol symbol-circle symbol-150px">
                                @if (!empty($product->image_product))
                                    <img src="{{ Storage::url($product->image_product) }}" alt="Emma Smith"
                                        class="w-100" />
                                @else
                                    <img src="{{ asset('assets/media/avatars/150-1.jpg') }}" alt="Emma Smith"
                                        class="w-100" />
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="name"
                            class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $product->name }}
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Code Product
                                :</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $product->code_product }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Category
                                :</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $product->category }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="description"
                            class="col-md-4 col-form-label text-md-end text-start"><strong>Description:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $product->description }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
