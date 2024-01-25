@extends('productpos::layouts.master')

@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Product List
            </div>
            <div class="float-end">
                <form name="search" action="{{ route('productpos.search') }}" method="POST" id="form-search">
                    @csrf
                    <div class="d-flex align-items-center position-relative my-1">

                        <input type="text" data-kt-subscription-table-filter="search"
                            class="form-control form-control-solid w-250px ps-14" id="keyword"
                            placeholder="Search Name Product " name="search" value="{{ empty($keyword) ? '' : $keyword }}">

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
                <a href="{{ route('productpos.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
                    New Product</a>
            @endcan
            @can('import-product')
                <a href="{{ route('tools-productpos.importview') }}" class="btn btn-warning btn-sm my-2"><i
                        class="bi bi-upload"></i> Import</a>
            @endcan
            @can('export-product')
                <a href="{{ route('tools-productpos.export') }}" class="btn btn-info btn-sm my-2"><i
                        class="bi bi-file-arrow-down-fill"></i>Export</a>
            @endcan

            @can('download-product')
                <a href="{{ route('tools-productpos.download') }}" class="btn btn-default btn-sm my-2"><i
                        class="bi bi-file-arrow-down-fill"></i>Template</a>
            @endcan

            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code </th>
                            <th>Image </th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Unit Price Purchase</th>
                            <th>Unit Price Sell</th>
                            <th>Stock Last </th>
                            <th>Description</th>
                            <th class="text-end min-w-125px">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                        @forelse ($products as $product)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $product->code_product }}</td>
                                <td>
                                    <!--begin:: Avatar -->
                                    <div class="symbol symbol-50px overflow-hidden me-3">
                                        <a href="{{ route('productpos.show', $product->id) }}">
                                            <div class="symbol-label">
                                                @if (!empty($product->image_product))
                                                    <img src="{{ Storage::url($product->image_product) }}" alt="Product"
                                                        class="w-100" />
                                                @else
                                                    <img src="https://fakeimg.pl/100x100" alt="Product" class="w-100" />
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                    <!--end::Avatar-->
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category_product?->name }}</td>
                                <td>{{ empty($product->price_purchase) ? 0 : number_format($product->price_purchase, 0, ',', '.') }}
                                </td>
                                <td>{{ empty($product->price_sell) ? 0 : number_format($product->price_sell, 0, ',', '.') }}
                                </td>
                                <td>{{ $product?->stock_last }}</td>
                                <td>
                                    @if (strlen($product->description) > 100)
                                        {{ substr($product->description, 0, 100) }}
                                        <span class="read-more-show hide_content">More<i
                                                class="fa fa-angle-down"></i></span>
                                        <span class="read-more-content">
                                            {{ substr($product->description, 100, strlen($product->description)) }}
                                            <span class="read-more-hide hide_content">Less <i
                                                    class="fa fa-angle-up"></i></span>
                                        </span>
                                    @else
                                        {{ $product->description }}
                                    @endif
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('productpos.destroy', $product->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="py-5">
                                            <a href="{{ route('productpos.show', $product->id) }}"
                                                class="btn btn-default btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </a>

                                            @can('edit-product')
                                                <a href="{{ route('productpos.edit', $product->id) }}"
                                                    class="btn btn-default btn-warning btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </a>
                                            @endcan

                                            @can('delete-product')
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
                                    <strong>No Product Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $products->links() }}

        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        // Hide the extra content initially, using JS so that if JS is disabled, no problemo:
        $('.read-more-content').addClass('hide_content')
        $('.read-more-show, .read-more-hide').removeClass('hide_content')

        // Set up the toggle effect:
        $('.read-more-show').on('click', function(e) {
            $(this).next('.read-more-content').removeClass('hide_content');
            $(this).addClass('hide_content');
            e.preventDefault();
        });

        // Changes contributed by @diego-rzg
        $('.read-more-hide').on('click', function(e) {
            var p = $(this).parent('.read-more-content');
            p.addClass('hide_content');
            p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
            e.preventDefault();
        });
    </script>
@endpush

@push('styles')
    <style type="text/css">
        .read-more-show {
            cursor: pointer;
            color: #ed8323;
        }

        .read-more-hide {
            cursor: pointer;
            color: #ed8323;
        }

        .hide_content {
            display: none;
        }
    </style>
@endpush
