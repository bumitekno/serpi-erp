@extends('template')
@push('menu-tops')
    @include('top_menu')
@endpush
@section('content')
    <div class="card">

        <div class="card-body">
            <div class="py-5">
                <form name="form-filter" class="form" action="{{ route('account.company.search') }}" method="POST">
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
                                name="q" value="{{ empty($q) ? '' : $q }}">
                        </div>
                        <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <div class="me-3">
                                <select class="form-select" name="sortby" data-control="select2"
                                    data-placeholder="Select an option">
                                    <option></option>
                                    <option value="asc" @if ($sort == 'asc') selected="selected" @endif>
                                        ASC</option>
                                    <option value="desc" @if ($sort == 'desc') selected="selected" @endif>
                                        DESC</option>
                                </select>
                            </div>
                            <a href="{{ route('account.company.create') }}" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                </form>
                <div class="table-reponsive">
                    <table class="table table-row-dashed table-row-gray-300 gy-7">
                        <thead>
                            <tr class="fw-bolder fs-6 text-gray-800">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th scope="col">Partner</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($company as $item)
                                <tr>
                                    <td>{{ $item->company_name ?? '-' }}</td>
                                    <td>{{ $item->email ?? '-' }}</td>
                                    <td>{{ $item->Phone ?? '-' }}</td>
                                    @if (!empty($item->parent_id))
                                        <td>{{ $item->company_name }}</td>
                                    @else
                                        <td>-</td>
                                    @endif
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('select[name=sortby]').change(function() {
                $('.form').submit();
            });
        });
    </script>
@endpush
