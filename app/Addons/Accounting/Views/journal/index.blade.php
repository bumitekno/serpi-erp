@extends('template')
@push('menu-tops')
    @include('top_menu')
@endpush
@section('content')
    <div class="card">

        <div class="card-body">
            <div class="py-5">
                <form action="{{ route('account.journal.filter') }}" method="get">
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
                                class="form-control form-control-solid w-250px ps-15 o_searchview_input"
                                placeholder="Search Name" name="filter" accesskey="Q">
                        </div>
                        <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <a href="{{ route('account.journal.create') }}" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                </form>
                <div class="table-responsive-lg mb-4">
                    <table class="table table-striped table-row-dashed table-row-gray-300 gy-7">
                        <thead class="table table-sm">
                            <tr class="fw-bolder fs-6 text-gray-800">
                                <th scope="col">No.</th>
                                <th scope="col">code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">company</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($journal as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <th>{{ $data->code }}</th>
                                    <th>{{ $data->name }}</th>
                                    <th>{{ $data->type }}</th>
                                    <th>{{ $data->company->company_name }}</th>
                                    <th>
                                        <a href="{{ route('account.journal.edit', $data->id) }}"
                                            class="btn btn-sm btn-success"><i class="fa fa-edit"> Edit</i></a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{ $journal->links() }}
        </div>
    </div>
@endsection
@push('scripts')
@endpush
