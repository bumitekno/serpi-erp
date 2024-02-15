@extends('stock::layouts.master')

@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Stock Converter
            </div>
            <div class="float-end">
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                    data-kt-menu-placement="bottom-end">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Filter</button>

                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter"
                    style="">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-4 text-dark fw-bolder">Filter Options</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Separator-->
                    <form name="search" class="form-inline" action="{{ route('stock.search') }}" method="POST"
                        id="form-search">
                        @csrf
                        <!--begin::Content-->
                        <div class="px-7 py-5">

                            <div class="mb-10">
                                <input type="text" data-kt-subscription-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-14 me-3" id="keyword"
                                    placeholder="Search product " name="search"
                                    value="{{ empty($keyword) ? '' : $keyword }}">
                            </div>

                            <div class="mb-10">
                                <select class="form-select " data-control="select2" data-placeholder="Select an Location"
                                    name="filter_location">
                                    <option></option>
                                    @forelse($location as $location)
                                        <option value="{{ $location->id }}"
                                            @if (!empty($filter_location) && $filter_location == $location->id) selected="selected" @endif>
                                            {{ Str::title($location->name_location) }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="mb-10">
                                <select class="form-select " data-control="select2" data-placeholder="Select an Warehouse"
                                    name="filter_warehouse">
                                    <option></option>
                                    @forelse($warehouse as $warehouse)
                                        <option value="{{ $warehouse->id }}"
                                            @if (!empty($filter_warehouse) && $filter_warehouse == $warehouse->id) selected="selected" @endif>
                                            {{ Str::title($warehouse->name) }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                @if (!empty($keyword) || !empty($filter_location) || !empty($filter_warehouse))
                                    <a href="{{ route('stock.index') }}"
                                        class="btn btn-bg-danger btn-icon-white btn-text-white me-2"><i
                                            class="fas fa-trash"></i>
                                        Reset </a>
                                @endif
                                <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true"
                                    data-kt-customer-table-filter="filter">Apply</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Content-->
                    </form>
                </div>

            </div>
        </div>
        <div class="card-body">
            @can('create-stock')
                <a href="{{ route('stock.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
                    New Stock Converter </a>
                <a href="{{ route('stock.createopname') }}" class="btn btn-primary btn-sm my-2"><i
                        class="bi bi-plus-circle"></i>
                    Stock Opname </a>

                <a href="{{ route('stock.createstockp') }}" class="btn btn-default btn-sm my-2"><i
                        class="bi bi-plus-circle"></i>
                    Stock In Purchase </a>
            @endcan

            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th> Code</th>
                            <th> Name</th>
                            <th> Unit </th>
                            <th> Convert (QTY) </th>
                            <th> Warehouse</th>
                            <th> Location </th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                        @forelse ($stock as $stock)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <!--begin:: Avatar -->
                                    <div class="symbol symbol-50px overflow-hidden me-3">
                                        <a href="{{ route('stock.show', $stock->id) }}">
                                            <div class="symbol-label">
                                                @if (!empty($stock->products->image_product))
                                                    <img src="{{ Storage::url($stock->products->image_product) }}"
                                                        alt="Product" class="w-100" />
                                                @else
                                                    <img src="https://fakeimg.pl/100x100" alt="Product" class="w-100" />
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                    <!--end::Avatar-->
                                </td>
                                <td>{{ $stock->products?->code_product ?? '-' }}</td>
                                <td>{{ Str::title($stock->products?->name ?? '-') }}</td>
                                <td>{{ $stock->units?->name ?? '-' }}</td>
                                <td>{{ $stock->qty_convert ?? '-' }}</td>
                                <td>{{ $stock->warehouse?->name ?? '-' }}</td>
                                <td>{{ $stock->location?->name_location ?? '-' }}</td>

                                <td class="text-end">
                                    <form action="{{ route('stock.destroy', $stock->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="py-5">
                                            <a href="{{ route('stock.show', $stock->id) }}"
                                                class="btn btn-default btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </a>

                                            @can('edit-location')
                                                <a href="{{ route('stock.edit', $stock->id) }}"
                                                    class="btn btn-default btn-warning btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </a>
                                            @endcan

                                            @can('delete-stock')
                                                <button type="submit"
                                                    onclick ="return confirm('Do you want to delete this stock ?')"
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
                            <tr>
                                <td colspan="9">
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
                                            <span>No Stock Converter Product Found</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            {{ empty($stock->links) ? '' : $stock->links }}
        </div>
    </div>
@endsection
