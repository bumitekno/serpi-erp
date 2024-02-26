@extends('productpos::layouts.master')

@push('menu-tops')
    @include('menu-top-pos')
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

@push('modals')
    <div class="modal fade" tabindex="-1" id="kt_modal_printlabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"> Printing Label Barcode </h3>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="html-append grid-container" id="printarea"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="kt_print_preview" data-list=""> Print Preview
                    </button>
                </div>
            </div>
        </div>
    </div>
@endpush


@push('modals')
    <div class="modal fade" tabindex="-1" id="kt_modal_transfer">
        <div class="modal-dialog modal-lg">
            <form name="move" method="POST" action="{{ route('productpos.movewarehouse') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"> Moving Product Warehouse </h3>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="product">
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Warehouse</label>
                            <div class="col-md-6">
                                <select class="form-select @error('warehouse') is-invalid @enderror" data-control="select2"
                                    data-placeholder="Select Warehouse" name="warehouse" required>
                                    <option></option>
                                    @foreach ($warehouse as $warehouses)
                                        <option value="{{ $warehouses->id }}"> {{ $warehouses->name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('warehouse'))
                                    <span class="text-danger">{{ $errors->first('warehouse') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Location</label>
                            <div class="col-md-6">
                                <select class="form-select @error('location') is-invalid @enderror" data-control="select2"
                                    data-placeholder="Select Location" name="location" required>
                                    <option></option>
                                    @foreach ($location as $locations)
                                        <option value="{{ $locations->id }}"> {{ $locations->name_location }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('location'))
                                    <span class="text-danger">{{ $errors->first('location') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endpush

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
            <div class="d-flex justify-content-start " data-kt-product-table-toolbar="base">
                @can('create-product')
                    <a href="{{ route('productpos.create') }}" class="btn btn-success btn-sm my-2 me-3"><i
                            class="bi bi-plus-circle"></i>
                        New Product</a>
                @endcan

                @can('import-product')
                    <a href="{{ route('tools-productpos.importview') }}" class="btn btn-warning btn-sm my-2 me-3"><i
                            class="bi bi-upload"></i> Import</a>
                @endcan
                @can('export-product')
                    <a href="{{ route('tools-productpos.export') }}" class="btn btn-info btn-sm my-2 me-3"><i
                            class="bi bi-file-arrow-down-fill"></i>Export</a>
                @endcan

                @can('download-product')
                    <a href="{{ route('tools-productpos.download') }}" class="btn btn-default btn-sm my-2"><i
                            class="bi bi-file-arrow-down-fill"></i>Template</a>
                    <a href="{{ route('productpos.printlabelpageAll') }}" target="_blank"
                        class="btn btn-default btn-sm my-2"><i class="bi bi-printer"></i>Print Barcode All Product </a>
                @endcan
            </div>

            <div class="d-flex justify-content-end align-items-center d-none" data-kt-product-table-toolbar="selected">
                <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-product-table-select="selected_count"></span>Selected
                </div>
                <a href="javascript:;" class="btn btn-dark btn-sm my-2 me-2"
                    data-kt-product-table-select="print_selected"><i class="bi bi-printer"></i>
                    Barcode Label Printing </a>

                <a href="javascript:;" class="btn btn-warning btn-sm my-2" id="transfer_warehouse"><i
                        class="bi bi-filter-square"></i>
                    Moving Warehouse </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_product">
                    <thead>
                        <tr>
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_table_product .form-check-input" value="1" />
                                </div>
                            </th>
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
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="{{ $product->id }}" />
                                    </div>
                                </td>
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
                                                    <img src="https://fakeimg.pl/100x100" alt="Product"
                                                        class="w-100" />
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
                                <td>{{ empty($product->stock_last) ? '-' : $product->stock_last }}</td>
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
                            <tr>
                                <td colspan="8">
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
                                            <span>No Product Found</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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

        var o = document.getElementById("kt_table_product")
        const c = o.querySelectorAll('[type="checkbox"]');
        const s = document.querySelector('[data-kt-product-table-select="print_selected"]');
        const t = document.querySelector('[data-kt-product-table-toolbar="base"]');
        const r = document.querySelector(
            '[data-kt-product-table-select="selected_count"]');
        const n = document
            .querySelector('[data-kt-product-table-toolbar="selected"]')
        var ls = [];
        const a = () => {
            const e = o.querySelectorAll('tbody [type="checkbox"]');
            let c = !1,
                l = 0;
            e.forEach((e) => {
                    e.checked && ((c = !0), l++);
                }),
                c ? ((r.innerHTML = l), t.classList.add("d-none"), n.classList.remove("d-none")) : (t
                    .classList.remove("d-none"), n.classList.add("d-none"));
        };
        c.forEach((e) => {
            e.addEventListener("click", function() {
                setTimeout(function() {
                    a();
                    const tx = o.querySelectorAll('tbody [type="checkbox"]');
                    tx.forEach((e) => {
                        if (e.checked) {
                            ls.push(e.value);
                        } else {
                            var index = ls.indexOf(e.value);
                            if (index > -1) {
                                ls.splice(index, 1);
                            }
                        }
                    })
                }, 50);
            });
        });

        s.addEventListener("click", function() {
            Swal.fire({
                text: "Are you sure you want to printing label barcode selected Product?",
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Yes, Printing!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function(t) {
                t.value ?
                    $.ajax({
                        url: '{{ route('productpos.printbarcode') }}',
                        type: "POST",
                        contentType: "application/json;",
                        dataType: "json",
                        data: JSON.stringify({
                            product_id: ls
                        }),
                        success: function(r) {
                            $('.html-append').html(r.data);
                            $('#kt_modal_printlabel').modal('show');
                            $('#kt_print_preview').attr('data-list', r.list_array);
                        },
                        error: function(e) {
                            Swal.fire({
                                text: e.responseJSON.message,
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                },
                            }).then((r) => {
                                if (r.isConfirmed) {
                                    location.href = e.responseJSON.redirect;
                                }
                            });
                        }
                    }) :
                    "cancel" === t.dismiss &&
                    Swal.fire({
                        text: "Selected Product was not printing label.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary"
                        }
                    });
            });
        });


        $('body').on('click', '#transfer_warehouse', function() {

            var uniqueArray = ls.filter(function(item, pos) {
                return ls.indexOf(item) == pos;
            });

            $('input[name=product]').val(uniqueArray);
            $('#kt_modal_transfer').modal('show');
        });


        $('body').on('click', '#kt_print_preview', function() {
            var listc = $(this).data('list');
            var url = "{{ route('productpos.printlabelpage', ['listarray' => ':listarray']) }}";
            url = url.replace(':listarray', listc);
            Object.assign(document.createElement('a'), {
                target: '_blank',
                rel: 'noopener noreferrer',
                href: url,
            }).click();
        });
    </script>
@endpush
