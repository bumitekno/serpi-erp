@extends('template')
@push('menu-tops')
    @include('top_menu')
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="py-5">
                <form name="form-filter" class="form" action="{{ route('account.search') }}" method="POST">
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
                            <a href="{{ route('account.create') }}" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 gy-7">
                        <thead>
                            <tr class="fw-bolder fs-6 text-gray-800">
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Code</th>
                                <th scope="col">Reconcile</th>
                                <th scope="col">Deprecated</th>
                                <th scope="col">Note</th>
                                <th scope="col">Type</th>
                                <th scope="col">company</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($account as $item)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name ?? '-' }}</td>
                                    <td>{{ $item->code ?? '-' }}</td>
                                    <td>{{ $item->reconcile == '1' ? 'Y' : 'N' }}</td>
                                    <td>{{ $item->deprecated == '1' ? 'Y' : 'N' }}</td>
                                    <td>{{ $item->note ?? '-' }}</td>
                                    <td>{{ $item->account_type->name }}</td>
                                    <td>{{ $item->company->company_name }}</td>
                                    <td>
                                        <a href="{{ route('account.edit', $item->id) }}" class="btn btn-warning">
                                            <i class="bi bi-vector-pen"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{ $account->links() }}
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
