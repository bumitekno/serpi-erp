@extends('template')
@push('menu-tops')
    @include('top_menu')
@endpush
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Company
            </div>
            <div class="float-end">
                <a href="{{ route('account.company.create') }}" class="btn btn-primary">Add</a>
            </div>
        </div>
        <div class="card-body">
            <div class="py-5">
                <table class="table table-row-dashed table-row-gray-300 gy-7">
                    <thead>
                        <tr class="fw-bolder fs-6 text-gray-800">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Website</th>
                            <th>Company Registry</th>
                            <th>Address</th>
                            <th>Street</th>
                            <th>Street2</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($company as $item)
                            <tr>
                                <td>{{ $item->company_name ?? '-' }}</td>
                                <td>{{ $item->email ?? '-' }}</td>
                                <td>{{ $item->Phone ?? '-' }}</td>
                                <td>{{ $item->website ?? '-' }}</td>
                                <td>{{ $item->company_registry ?? '-' }}</td>
                                <td>{{ $item->address ?? '-' }}</td>
                                <td>{{ $item->street ?? '-' }}</td>
                                <td>{{ $item->street2 ?? '-' }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
