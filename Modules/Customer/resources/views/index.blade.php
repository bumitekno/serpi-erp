@extends('customer::layouts.master')

@section('content')
    <div class="d-flex flex-wrap flex-stack pb-7">
        <div class="d-flex flex-wrap align-items-center my-1">
            <h3 class="fw-bolder me-5 my-1"> Customer </h3>
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-3 position-absolute ms-3">
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
                    class="form-control form-control-white form-control-sm w-150px ps-9" placeholder="Search">
            </div>
            <!--end::Search-->
        </div>
    </div>
    <div class="row g-6 g-xl-9">
        @forelse($customer as $customers)
            <!--begin::Col-->
            <div class="col-md-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-65px symbol-circle mb-5">
                            <img src="assets/media//avatars/150-3.jpg" alt="image">
                            <div
                                class="bg-success position-absolute border border-4 border-white h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3">
                            </div>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#"
                            class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">{{ $customers?->name }}</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fw-bold text-gray-400 mb-6">{{ $customers?->contact }}</div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <div class="d-flex flex-center flex-wrap">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bolder text-gray-700">$14,560</div>
                                <div class="fw-bold text-gray-400">Earnings</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bolder text-gray-700">23</div>
                                <div class="fw-bold text-gray-400">Tasks</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bolder text-gray-700">$236,400</div>
                                <div class="fw-bold text-gray-400">Sales</div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @empty
        @endforelse
    </div>
    {{ $customer->links() }}
@endsection
