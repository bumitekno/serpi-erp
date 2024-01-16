@extends('categoryproduct::layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Category Information
                    </div>
                    <div class="float-end">
                        <a href="{{ route('categoryproduct.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="mb-3 row">
                        <label for="avatar" class="col-lg-4 text-md-end text-start"><strong>Image:</strong></label>
                        <div class="col-lg-8">
                            <div class="symbol-label symbol symbol-circle symbol-150px">
                                @if (!empty($category->image_category))
                                    <img src="{{ Storage::url($category->image_category) }}" alt="Product"
                                        class="w-100" />
                                @else
                                    <img src="https://fakeimg.pl/100x100" alt="Product" class="w-100" />
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class=" mb-3 row">
                        <label for="name" class="col-lg-4 text-md-end text-start"><strong>Name:</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ Str::title($category->name) }} </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
