@extends('template')
@section('content')
    <div class="d-flex flex-wrap flex-stack my-5">
        <!--begin::Heading-->
        <h3 class="fw-bolder my-2">
            <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm me-4">&larr; Back</a>
            {{ Str::title($group_module) }} Management
        </h3>
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
        @foreach ($nav_route as $nav_route)
            @php
                $list_permission = Spatie\Permission\Models\Permission::select('name', 'module')
                    ->where('module', '=', $nav_route->module)
                    ->get()
                    ->pluck('name');

                $text_route = strtolower(Str::replace('_', '', $nav_route->module));
                if ($text_route == 'product') {
                    $text_route = 'productpos';
                }
                $route_name = route($text_route . '.index');
            @endphp

            @canany($list_permission)
                <!--begin::Col-->
                <div class="col-md-6 col-lg-4 col-xl-3 @if ($text_route == 'methodpayment') d-none @endif ">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                            <!--begin::Name-->
                            <a href="{{ $route_name }}" class="text-gray-800 text-hover-primary d-flex flex-column">
                                <!--begin::Image-->
                                <div class="symbol symbol-60px mb-5">
                                    <img src="{{ asset('assets/media/svg/module.svg') }}" alt="">
                                </div>
                                <!--end::Image-->
                                <!--begin::Title-->
                                <div class="fs-5 fw-bolder mb-2">{{ Str::title(Str::replace('_', ' ', $nav_route->module)) }}
                                </div>
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
        @endforeach
    </div>
    <div class="card-px text-center py-20 my-10" id="notfound">
        <!--begin::Title-->
        <h2 class="fs-2x fw-bolder mb-10">list not found !</h2>
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
