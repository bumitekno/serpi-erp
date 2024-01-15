@extends('categoryproduct::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Edit Category
            </div>
            <div class="float-end">
                <a href="{{ route('categoryproduct.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('categoryproduct.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ $category->name }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
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

                            @if (!empty($category->image_category))
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url({{ Storage::url($category->image_category) }});">
                                </div>
                            @else
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url('https://fakeimg.pl/100x100')">
                                </div>
                            @endif

                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change Image">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="image_category" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="avatar_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel Image">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove Image">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--begin::Hint-->
                        @if ($errors->has('image_category'))
                            <span class="text-danger">{{ $errors->first('image_category') }}</span>
                        @endif
                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Image input-->
                </div>
                <div class="mb-3 row">
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Change Category">
                </div>
            </form>
        </div>
    </div>
@endsection
