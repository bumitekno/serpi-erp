@extends('productpos::layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Add New Product
                    </div>
                    <div class="float-end">
                        <a href="{{ route('productpos.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('productpos.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Code
                                Product</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('code_product') is-invalid @enderror"
                                    id="name" name="code_product" value="{{ old('code_product') }}">
                                @if ($errors->has('code_product'))
                                    <span class="text-danger">{{ $errors->first('code_product') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Category</label>
                            <div class="col-md-6">
                                <select class="form-select @error('category') is-invalid @enderror" data-control="select2"
                                    data-placeholder="Select category" name="category">
                                    <option></option>
                                    @foreach ($category_product as $category)
                                        <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <span class="text-danger">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <!--begin::Label-->
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Image</label>
                            <!--end::Label-->
                            <div class="col-md-6">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url('https://fakeimg.pl/100x100')">
                                    <!--begin::Preview existing avatar-->

                                    <div class="image-input-wrapper w-125px h-125px"
                                        style="background-image: url('https://fakeimg.pl/100x100')">
                                    </div>

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
                                    <!--begin::Remove-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove Image">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Remove-->
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
                                    id="stockmin" name="stockmin">
                                @if ($errors->has('stockmin'))
                                    <span class="text-danger">{{ $errors->first('stockmin') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Stock Max</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('stockmax') is-invalid @enderror"
                                    id="stockmax" name="stockmax">
                                @if ($errors->has('stockmax'))
                                    <span class="text-danger">{{ $errors->first('stockmax') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Expired
                                Date</label>
                            <div class="col-md-6">
                                <input type="date"
                                    class="form-control @error('expired') is-invalid @enderror kt_datepicker" id="expired"
                                    name="expired">
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
                                    value="1" id="flexSwitch20x30" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description"
                                class="col-md-4 col-form-label text-md-end text-start">Description</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Product">
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
    </script>
@endpush
