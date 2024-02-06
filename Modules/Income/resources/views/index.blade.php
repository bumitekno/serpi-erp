@extends('income::layouts.master')

@push('modals')
    <div class="modal fade" tabindex="-1" id="kt_modal_income">
        <form id="kt_docs_formvalidation_text" class="form" action="{{ route('income.store') }}" autocomplete="off"
            method="POST">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add Income </h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Name</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="name_input" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Insert Name " />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="kt_docs_formvalidation_text_submit">Save changes
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endpush

@section('content')
    <div class="d-flex flex-wrap flex-stack pb-7">
        <div class="d-flex flex-wrap align-items-center my-1">
            <h3 class="fw-bolder me-5 my-1"> Income </h3>
            <!--begin::Search-->
            <form name="filterse" action="{{ route('income.search') }}" method="POST">
                @csrf
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-3 position-absolute ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" id="kt_filter_search"
                        class="form-control form-control-white form-control-sm w-150px ps-9" placeholder="Search"
                        value="{{ empty($keyword) ? '' : $keyword }}" name="search">
                </div>
            </form>
            <!--end::Search-->
            @can('create-income')
                <a href="javascript:;" class="btn btn-bg-light btn-icon-info btn-text-info mb-2" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_income">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen006.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-fill-add" viewBox="0 0 16 16">
                            <path
                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path
                                d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                        </svg>
                    </span>
                </a>
            @endcan
        </div>
        <div class="d-flex flex-wrap my-1">
            <span class="text-muted me-2 ">Total Income</span>
            {{ number_format($total_trans, 0, ',', '.') }}
        </div>
    </div>
    <div class="row g-6 g-xl-9">
        @forelse($income as $incomes)
            <!--begin::Col-->
            <div class="col-md-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                        <!--begin::Name-->
                        <a href="javascript:;"
                            class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-3">{{ Str::title($incomes?->name) }}</a>
                        <!--end::Name-->

                        <div class="fw-bold text-gray-400 mb-6">
                            @php
                                $amount = \Modules\Income\app\Models\TransactionIncome::where('id_income', $incomes->id)->sum('amount');
                            @endphp
                            {{ number_format($amount, 0, ',', '.') }}
                        </div>

                        <form action="{{ route('income.destroy', $incomes->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="d-flex flex-center flex-wrap ">

                                <!--begin::Stats-->
                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                    @can('show-income')
                                        <a href="{{ route('income.show', $incomes->id) }}"
                                            class="btn btn-default btn-info btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </a>
                                    @endcan
                                </div>
                                <!--end::Stats-->



                                <!--begin::Stats-->
                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                    @can('edit-income')
                                        <a href="{{ route('income.edit', $incomes->id) }}"
                                            class="btn btn-default btn-warning btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                        </a>
                                    @endcan
                                </div>
                                <!--end::Stats-->
                                <!--begin::Stats-->
                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3 @if ($incomes->id == 1) d-none @endif ">
                                    @can('delete-income')
                                        <button type="submit" onclick ="return confirm('Do you want to delete this income?')"
                                            class="btn btn-default btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </button>
                                    @endcan
                                </div>
                                <!--end::Stats-->

                                <!--begin::Stats-->
                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                    @can('create-transaction-income')
                                        <a href="{{ route('income.create_trans', $incomes->id) }}"
                                            class="btn btn-default btn-default btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                        </a>
                                    @endcan
                                </div>
                                <!--end::Stats-->

                            </div>
                            <!--end::Info-->
                        </form>

                    </div>
                    <!--end::Card body-->

                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @empty
            <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path opacity="0.3"
                            d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                            fill="black"></path>
                        <path
                            d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z"
                            fill="black"></path>
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-danger">This is an alert</h4>
                    <span>Income no record found !.</span>
                </div>
            </div>
        @endforelse
    </div>
    {{ $income->links() }}
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
