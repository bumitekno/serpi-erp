@extends('departement::layouts.master')
@push('menu-tops')
    @include('menu-top-pos')
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Edit Departement
                    </div>
                    <div class="float-end">
                        <a href="{{ route('departement.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form id="kt_docs_formvalidation_textD" class="form"
                        action="{{ route('departement.update', $departement->id) }}" autocomplete="off" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="mb-3 row">
                            <!--begin::Label-->
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Logo</label>
                            <!--end::Label-->
                            <div class="col-md-6">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url({{ asset('assets/media/avatars/blank.png') }})">
                                    <!--begin::Preview existing avatar-->
                                    @if (!empty($departement->image))
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url({{ Storage::url($departement->image) }});">
                                        </div>
                                    @else
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url({{ asset('assets/media/avatars/blank.png') }})">
                                        </div>
                                    @endif
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Remove-->
                                </div>
                                <!--begin::Hint-->
                                @if ($errors->has('avatar'))
                                    <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                @endif
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Image input-->
                        </div>

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label
                                class="required fw-semibold fs-6 mb-2 @error('name_input') is-invalid @enderror">Name</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="name_input" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Insert Name " value="{{ $departement->name }}" />
                            <!--end::Input-->

                            @if ($errors->has('name_input'))
                                <span class="text-danger">{{ $errors->first('name_input') }}</span>
                            @endif

                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label
                                class="required fw-semibold fs-6 mb-2 @error('email_input') is-invalid @enderror">Email</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="email" name="email_input" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="insert Email" value="{{ $departement->email }}" />
                            <!--end::Input-->

                            @if ($errors->has('email_input'))
                                <span class="text-danger">{{ $errors->first('email_input') }}</span>
                            @endif

                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label
                                class="required fw-semibold fs-6 mb-2 @error('contact_input') is-invalid @enderror">Contact</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="number" name="contact_input" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Insert Contact " value="{{ $departement->contact }}" />
                            <!--end::Input-->
                            @if ($errors->has('contact_input'))
                                <span class="text-danger">{{ $errors->first('contact_input') }}</span>
                            @endif
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label
                                class="required fw-semibold fs-6 mb-2 @error('address_input') is-invalid @enderror">Address</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="address_input" class="form-control form-control-solid" placeholder="Insert Address">{{ $departement->address }}</textarea>
                            <!--end::Input-->

                            @if ($errors->has('address_input'))
                                <span class="text-danger">{{ $errors->first('address_input') }}</span>
                            @endif

                        </div>
                        <!--end::Input group-->

                        <div class="fv-row mb-10">
                            <label for="name" class="required fw-semibold fs-6 mb-2">Warehouse</label>
                            <select class="form-select @error('id_warehouse') is-invalid @enderror" data-control="select2"
                                data-placeholder="Select Warehouse" name="id_warehouse">
                                <option></option>
                                @foreach ($warehouse as $warehouses)
                                    <option value="{{ $warehouses->id }}"
                                        @if ($departement->id_warehouse == $warehouses->id) selected="selected" @endif>
                                        {{ $warehouses->name }} </option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_warehouse'))
                                <span class="text-danger">{{ $errors->first('id_warehouse') }}</span>
                            @endif
                        </div>

                        <div class="fv-row mb-10">
                            <label for="name" class="required fw-semibold fs-6 mb-2">Location</label>
                            <select class="form-select @error('id_location') is-invalid @enderror" data-control="select2"
                                data-placeholder="Select Location" name="id_location">
                                <option></option>
                                @foreach ($location as $locations)
                                    <option value="{{ $locations->id }}"
                                        @if ($departement->id_location == $locations->id) selected="selected" @endif>
                                        {{ $locations->name_location }} </option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_location'))
                                <span class="text-danger">{{ $errors->first('id_location') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary" id="kt_docs_formvalidation_text_submitD">Save changes
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
