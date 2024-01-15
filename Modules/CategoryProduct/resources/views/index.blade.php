@extends('categoryproduct::layouts.master')

@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Category Product List
            </div>
            <div class="float-end">
                <form name="search" action="{{ route('categoryproduct.search') }}" method="POST" id="form-search">
                    @csrf
                    <div class="d-flex align-items-center position-relative my-1">

                        <input type="text" data-kt-subscription-table-filter="search"
                            class="form-control form-control-solid w-250px ps-14" id="keyword"
                            placeholder="Search Category Product " name="search"
                            value="{{ empty($keyword) ? '' : $keyword }}">

                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                    transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="black"></path>
                            </svg>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            @can('create-product')
                <a href="{{ route('categoryproduct.create') }}" class="btn btn-success btn-sm my-2"><i
                        class="bi bi-plus-circle"></i>
                    New Category</a>
            @endcan
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image </th>
                            <th>Name</th>
                            <th class="text-end min-w-125px">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                        @forelse ($category as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <!--begin:: Avatar -->
                                    <div class="symbol symbol-50px overflow-hidden me-3">
                                        <a href="{{ route('categoryproduct.show', $category->id) }}">
                                            <div class="symbol-label">
                                                @if (!empty($category->image_category))
                                                    <img src="{{ Storage::url($category->image_category) }}" alt="Category"
                                                        class="w-100" />
                                                @else
                                                    <img src="https://fakeimg.pl/100x100" alt="image_category"
                                                        class="w-100" />
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                    <!--end::Avatar-->
                                </td>
                                <td>{{ Str::title($category->name ?? '-') }}</td>
                                <td class="text-end">
                                    <form action="{{ route('categoryproduct.destroy', $category->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="py-5">
                                            <a href="{{ route('categoryproduct.show', $category->id) }}"
                                                class="btn btn-default btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </a>

                                            @can('edit-category-product')
                                                <a href="{{ route('categoryproduct.edit', $category->id) }}"
                                                    class="btn btn-default btn-warning btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </a>
                                            @endcan

                                            @can('delete-category-product')
                                                <button type="submit"
                                                    onclick ="return confirm('Do you want to delete this user?')"
                                                    class="btn btn-default btn-danger btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </button>
                                            @endcan
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="4">
                                <span class="text-danger">
                                    <strong>No Category Found!</strong>
                                </span>
                            </td>
                        @endforelse

                    </tbody>
                </table>
            </div>
            {{ $category->links }}
        </div>
    </div>
@endsection
