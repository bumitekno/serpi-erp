@extends('productpos::layouts.master')

@section('content')
    <div class="card">
        <div class="card-header mt-3">Product List</div>
        <div class="card-body">
            @can('create-product')
                <a href="{{ route('productpos.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
                    Add
                    New Product</a>
            @endcan
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr>
                        <th class="min-w-125px">#</th>
                        <th class="min-w-125px">Code </th>
                        <th class="min-w-125px">Image </th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Category</th>
                        <th class="min-w-125px">Description</th>
                        <th class="text-end min-w-100px">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                    @forelse ($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $product->code_product }}</td>
                            <td>
                                <!--begin:: Avatar -->
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <a href="{{ route('productpos.show', $product->id) }}">
                                        <div class="symbol-label">
                                            @if (!empty($product->image_product))
                                                <img src="{{ Storage::url($product->image_product) }}" alt="Emma Smith"
                                                    class="w-100" />
                                            @else
                                                <img src="{{ asset('assets/media/avatars/150-1.jpg') }}" alt="Emma Smith"
                                                    class="w-100" />
                                            @endif
                                        </div>
                                    </a>
                                </div>
                                <!--end::Avatar-->
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>
                                @if (strlen($product->description) > 100)
                                    {{ substr($product->description, 0, 100) }}
                                    <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>
                                    <span class="read-more-content">
                                        {{ substr($product->description, 100, strlen($product->description)) }}
                                        <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span>
                                    </span>
                                @else
                                    {{ $product->description }}
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon--></a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="{{ route('productpos.show', $product->id) }}" class="menu-link px-3"><i
                                                class="bi bi-eye"></i> &nbsp; Show</a>
                                    </div>
                                    @can('edit-product')
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('productpos.edit', $product->id) }}" class="menu-link px-3"> <i
                                                    class="bi bi-pencil-square"></i> &nbsp; Edit</a>
                                        </div>
                                    @endcan
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->

                                    @can('delete-product')
                                        <form action="{{ route('productpos.destroy', $product->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="menu-link px-3"
                                                onclick="return confirm('Do you want to delete this product?');"><i
                                                    class="bi bi-trash"></i> Delete</button>
                                        </form>
                                    @endcan

                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
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
