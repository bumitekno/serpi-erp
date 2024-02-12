@extends('template')
@section('content')
    <div class="d-flex flex-wrap flex-stack my-5">
        <!--begin::Heading-->
        <h3 class="fw-bolder my-2">List Module Apps
            <span class="fs-6 text-gray-400 fw-bold ms-1"></span>
        </h3>
        <!--end::Heading-->
        <!--begin::Controls-->
        <div class="d-flex my-2">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative me-4">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-3 position-absolute ms-3 mt-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="black"></path>
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <input type="text" id="kt_filter_search"
                    class="form-control form-control-sm form-control-solid bg-body fw-bold fs-7 w-150px ps-9"
                    placeholder="Search">
            </div>
            <!--end::Search-->
        </div>
        <!--end::Controls-->
    </div>
    <div class="row g-6 g-xl-9 mb-6 mb-xl-9" id="results">
        @canany(['create-user', 'edit-user', 'delete-user', 'create-role', 'edit-role', 'delete-role'])
            <!--begin::Col-->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                        <!--begin::Name-->
                        <a href="{{ route('checkroute', ['module' => 'user']) }}"
                            class="text-gray-800 text-hover-primary d-flex flex-column">
                            <!--begin::Image-->
                            <div class="symbol symbol-60px mb-5">
                                <img src="{{ asset('assets/media/svg/module.svg') }}" alt="">
                            </div>
                            <!--end::Image-->
                            <!--begin::Title-->
                            <div class="fs-5 fw-bolder mb-2">User Management</div>
                            <!--end::Title-->
                        </a>
                        <!--end::Name-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endcan

        @canany(['create-master', 'edit-master', 'delete-master'])
            <!--begin::Col-->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                        <!--begin::Name-->
                        <a href="{{ route('checkroute', ['module' => 'master']) }}"
                            class="text-gray-800 text-hover-primary d-flex flex-column">
                            <!--begin::Image-->
                            <div class="symbol symbol-60px mb-5">
                                <img src="{{ asset('assets/media/svg/module.svg') }}" alt="">
                            </div>
                            <!--end::Image-->
                            <!--begin::Title-->
                            <div class="fs-5 fw-bolder mb-2"> Master Management</div>
                            <!--end::Title-->
                        </a>
                        <!--end::Name-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endcan

        @canany(['create-category-product', 'edit-category-product', 'delete-category-product', 'create-product',
            'edit-product', 'delete-product', 'import-product', 'export-product', 'create-unitproduct', 'edit-unitproduct',
            'delete-unitproduct', 'create-warehouse', 'edit-warehouse', 'delete-warehouse', 'create-location', 'edit-location',
            'delete-location'])
            <!--begin::Col-->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                        <!--begin::Name-->
                        <a href="{{ route('checkroute', ['module' => 'inventory']) }}"
                            class="text-gray-800 text-hover-primary d-flex flex-column">
                            <!--begin::Image-->
                            <div class="symbol symbol-60px mb-5">
                                <img src="{{ asset('assets/media/svg/module.svg') }}" alt="">
                            </div>
                            <!--end::Image-->
                            <!--begin::Title-->
                            <div class="fs-5 fw-bolder mb-2">Inventory Management</div>
                            <!--end::Title-->
                        </a>
                        <!--end::Name-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endcan

        @canany(['create-purchase', 'edit-purchase', 'delete-purchase'])
            <!--begin::Col-->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                        <!--begin::Name-->
                        <a href="{{ route('checkroute', ['module' => 'purchase']) }}"
                            class="text-gray-800 text-hover-primary d-flex flex-column">
                            <!--begin::Image-->
                            <div class="symbol symbol-60px mb-5">
                                <img src="{{ asset('assets/media/svg/module.svg') }}" alt="">
                            </div>
                            <!--end::Image-->
                            <!--begin::Title-->
                            <div class="fs-5 fw-bolder mb-2">Purchase Management</div>
                            <!--end::Title-->
                        </a>
                        <!--end::Name-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endcan

        @canany(['create-sales', 'edit-sales', 'delete-sales'])
            <!--begin::Col-->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                        <!--begin::Name-->
                        <a href="{{ route('checkroute', ['module' => 'sales']) }}"
                            class="text-gray-800 text-hover-primary d-flex flex-column">
                            <!--begin::Image-->
                            <div class="symbol symbol-60px mb-5">
                                <img src="{{ asset('assets/media/svg/module.svg') }}" alt="">
                            </div>
                            <!--end::Image-->
                            <!--begin::Title-->
                            <div class="fs-5 fw-bolder mb-2">Sales Management</div>
                            <!--end::Title-->
                        </a>
                        <!--end::Name-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endcan

        @canany(['create-income', 'edit-income', 'delete-income'])
            <!--begin::Col-->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                        <!--begin::Name-->
                        <a href="{{ route('checkroute', ['module' => 'income']) }}"
                            class="text-gray-800 text-hover-primary d-flex flex-column">
                            <!--begin::Image-->
                            <div class="symbol symbol-60px mb-5">
                                <img src="{{ asset('assets/media/svg/module.svg') }}" alt="">
                            </div>
                            <!--end::Image-->
                            <!--begin::Title-->
                            <div class="fs-5 fw-bolder mb-2">Income Management</div>
                            <!--end::Title-->
                        </a>
                        <!--end::Name-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endcan

        @canany(['create-expense', 'edit-expense', 'delete-expense'])
            <!--begin::Col-->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                        <!--begin::Name-->
                        <a href="{{ route('checkroute', ['module' => 'income']) }}"
                            class="text-gray-800 text-hover-primary d-flex flex-column">
                            <!--begin::Image-->
                            <div class="symbol symbol-60px mb-5">
                                <img src="{{ asset('assets/media/svg/module.svg') }}" alt="">
                            </div>
                            <!--end::Image-->
                            <!--begin::Title-->
                            <div class="fs-5 fw-bolder mb-2">Expense Management</div>
                            <!--end::Title-->
                        </a>
                        <!--end::Name-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endcan

        @canany(['create-crm', 'edit-crm', 'delete-crm'])
            <!--begin::Col-->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                        <!--begin::Name-->
                        <a href="{{ route('checkroute', ['module' => 'crm']) }}"
                            class="text-gray-800 text-hover-primary d-flex flex-column">
                            <!--begin::Image-->
                            <div class="symbol symbol-60px mb-5">
                                <img src="{{ asset('assets/media/svg/module.svg') }}" alt="">
                            </div>
                            <!--end::Image-->
                            <!--begin::Title-->
                            <div class="fs-5 fw-bolder mb-2">CRM Management</div>
                            <!--end::Title-->
                        </a>
                        <!--end::Name-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endcan

        @canany(['create-finance', 'edit-finance', 'delete-finance'])
            <!--begin::Col-->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                        <!--begin::Name-->
                        <a href="{{ route('checkroute', ['module' => 'finance']) }}"
                            class="text-gray-800 text-hover-primary d-flex flex-column">
                            <!--begin::Image-->
                            <div class="symbol symbol-60px mb-5">
                                <img src="{{ asset('assets/media/svg/module.svg') }}" alt="">
                            </div>
                            <!--end::Image-->
                            <!--begin::Title-->
                            <div class="fs-5 fw-bolder mb-2">Finance Management</div>
                            <!--end::Title-->
                        </a>
                        <!--end::Name-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endcan

        @canany(['create-hr', 'edit-hr', 'delete-hr'])
            <!--begin::Col-->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                        <!--begin::Name-->
                        <a href="{{ route('checkroute', ['module' => 'hrm']) }}"
                            class="text-gray-800 text-hover-primary d-flex flex-column">
                            <!--begin::Image-->
                            <div class="symbol symbol-60px mb-5">
                                <img src="{{ asset('assets/media/svg/module.svg') }}" alt="">
                            </div>
                            <!--end::Image-->
                            <!--begin::Title-->
                            <div class="fs-5 fw-bolder mb-2">HR Management</div>
                            <!--end::Title-->
                        </a>
                        <!--end::Name-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endcan

        @canany(['create-addon', 'edit-addon', 'delete-addon'])
            <!--begin::Col-->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                        <!--begin::Name-->
                        <a href="{{ route('checkroute', ['module' => 'addon']) }}"
                            class="text-gray-800 text-hover-primary d-flex flex-column">
                            <!--begin::Image-->
                            <div class="symbol symbol-60px mb-5">
                                <img src="{{ asset('assets/media/svg/module.svg') }}" alt="">
                            </div>
                            <!--end::Image-->
                            <!--begin::Title-->
                            <div class="fs-5 fw-bolder mb-2">Add On Management</div>
                            <!--end::Title-->
                        </a>
                        <!--end::Name-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endcan

    </div>

    <div class="card-px text-center py-20 my-10" id="notfound">
        <!--begin::Title-->
        <h2 class="fs-2x fw-bolder mb-10">App list not found !</h2>
        <!--end::Title-->
        <!--begin::Description-->
        <p class="text-gray-400 fs-4 fw-bold mb-10"></p>
        <!--end::Description-->
    </div>
@endsection

@push('scripts')
    <script>
        $('#notfound').hide();
        $("#kt_filter_search").keyup(function() {

            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val(),
                count = 0;

            if (count == 0) {
                $('#notfound').hide();
            }

            // Loop through the comment list
            $('#results div').each(function() {
                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {

                    $(this).hide(); // MY CHANGE
                    $('.symbol').show();

                    if (count == 0) {
                        $('#notfound').show();
                    } else {
                        $('#notfound').hide();
                    }

                    // Show the list item if the phrase matches and increase the count by 1

                } else {
                    $(this).show(); // MY CHANGE
                    count++;
                }
            });

        });
    </script>
@endpush
