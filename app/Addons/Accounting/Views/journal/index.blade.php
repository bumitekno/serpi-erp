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
                            @forelse ($journal as $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <th>{{ $data->code }}</th>
                                    <th>{{ $data->name }}</th>
                                    <th>{{ $data->type }}</th>
                                    <th>{{ $data->company->company_name }}</th>
                                    <th>
                                        <a href="{{ route('account.journal.edit', $data->id) }}"
                                            class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit </a>
                                    </th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                            <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
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
                                                <span>Journal Not Found.</span>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforelse
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
