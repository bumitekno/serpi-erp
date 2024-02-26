@extends('customer::layouts.master')
@push('menu-tops')
    @include('menu-top-pos')
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form name="edit" action="{{ route('customer.update', $customer->id) }}" method="POST"
                id="kt_docs_formvalidation_text" class="form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header mt-3">
                        <div class="float-start">
                            Customer Edit Information
                        </div>
                        <div class="float-end">
                            <a href="{{ route('customer.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="mb-3 row">
                            <!--begin::Label-->
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Avatar</label>
                            <!--end::Label-->
                            <div class="col-md-6">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url({{ asset('assets/media/avatars/blank.png') }})">
                                    @if (!empty($customer->image))
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url({{ Storage::url($customer->image) }});">
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

                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Image input-->
                        </div>

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Name</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="name_input" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Insert Name " value="{{ $customer->name }}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="email" name="email_input" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="insert Email" value="{{ $customer->email }}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Contact</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="number" name="contact_input" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Insert Contact " value="{{ $customer->contact }}" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Address</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <textarea name="address_input" class="form-control form-control-solid" placeholder="Insert Address">{{ $customer->address }}</textarea>
                            <!--end::Input-->
                        </div>

                    </div>
                    <div class="card-footer">
                        <!--end::Input group-->
                        <button type="submit" class="btn btn-primary" id="kt_docs_formvalidation_text_submit">Save changes
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        // Define form element
        const form = document.getElementById('kt_docs_formvalidation_text');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'name_input': {
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            }
                        }
                    },
                    'email_input': {
                        validators: {
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            },
                            notEmpty: {
                                message: 'Email address is required'
                            }
                        }
                    },
                    'address_input': {
                        validators: {
                            notEmpty: {
                                message: 'Address is required'
                            }
                        }
                    },
                    'contact_input': {
                        validators: {
                            notEmpty: {
                                message: 'Contact is required'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Submit button handler
        const submitButton = document.getElementById('kt_docs_formvalidation_text_submit');
        submitButton.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function(status) {

                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable button to avoid multiple click
                        submitButton.disabled = true;

                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        setTimeout(function() {
                            // Remove loading indication
                            submitButton.removeAttribute('data-kt-indicator');

                            // Enable button
                            submitButton.disabled = false;

                            // Show popup confirmation
                            Swal.fire({
                                text: "Form has been successfully submitted!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });

                            form.submit(); // Submit form
                        }, 2000);
                    }
                });
            }
        });
    </script>
@endpush
