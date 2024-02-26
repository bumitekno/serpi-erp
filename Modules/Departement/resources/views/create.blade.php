@extends('departement::layouts.master')
@push('menu-tops')
    @include('menu-top-pos')
@endpush
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Create Departement
            </div>
            <div class="float-end">
                <a href="{{ route('departement.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
        </div>
        <div class="card-body">

            <form id="kt_docs_formvalidation_textD" class="form" action="{{ route('departement.store') }}" autocomplete="off"
                method="POST">
                @csrf
                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2 @error('name_input') is-invalid @enderror">Name</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="text" name="name_input" class="form-control form-control-solid mb-3 mb-lg-0"
                        placeholder="Insert Name " />
                    <!--end::Input-->

                    @if ($errors->has('name_input'))
                        <span class="text-danger">{{ $errors->first('name_input') }}</span>
                    @endif

                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-10">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2 @error('email_input') is-invalid @enderror">Email</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input type="email" name="email_input" class="form-control form-control-solid mb-3 mb-lg-0"
                        placeholder="insert Email" />
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
                        placeholder="Insert Contact " />
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
                    <textarea name="address_input" class="form-control form-control-solid" placeholder="Insert Address"></textarea>
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
                            <option value="{{ $warehouses->id }}">
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
                            <option value="{{ $locations->id }}">
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
@endsection
