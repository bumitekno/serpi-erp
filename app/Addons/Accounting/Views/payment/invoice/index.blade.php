@extends('template')
@push('menu-tops')
    @include('top_menu')
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="py-5">
                <form name="form-filter" class="form" action="" method="GET">
                    @csrf
                    <div class="d-flex flex-stack mb-5">
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-docs-table-filter="search"
                                class="form-control form-control-solid w-250px ps-15" placeholder="Search Name"
                                name="q" value="">
                        </div>
                        <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <div class="me-3">

                            </div>
                            <a href="{{ route('account.invoice.create') }}" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                </form>
                <div class="table-responsive-lg mb-4">
                    <table class="table table-striped">
                        <thead class="table table-sm">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Journal</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Company</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr class="table-row" data-href="{{ route('account.payment.view', $row) }}">
                                    <td>{{ $row->payment_date }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->journal->name }}</td>
                                    <td>{{ $row->payment_method_id }}</td>
                                    <td>{{ $row->partner->name }}</td>
                                    <td>{{ number_format($row->amount) }}</td>
                                    <td>
                                        @if ($row->state == 'draft')
                                            <div class="mb-2 mr-2 badge badge-pill badge-warning text-white"><span
                                                    style="font-size:10px;">Pending</span></div>
                                        @endif
                                        @if ($row->state == 'posted')
                                            <div class="mb-2 mr-2 badge badge-pill badge-success"><span
                                                    style="font-size:10px;">Validate</span></div>
                                        @endif
                                    </td>
                                    <td>{{ $row->company->company_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $(".table-row").click(function() {
                window.document.location = $(this).data("href");
            });
        });
    </script>
@endpush
