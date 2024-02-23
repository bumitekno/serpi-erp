@extends('template')

@push('modals')
    <div class="modal fade" tabindex="-1" id="kt_modal_tracking">
        <form id="kt_docs_formvalidation_text" class="form" action="{{ route('report.storeshipment') }}" autocomplete="off"
            method="POST">
            @csrf
            <input type="hidden" name="id_shipment" />
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Update Shipment </h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">No Tracking</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="number_tracking_input"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Insert Number Tracking "
                                required />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Note Expedisi Shipment</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea class="form-control form-control-solid mb-3 mb-lg-0" name="note_tracking" placeholder="Insert Note" required></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="kt_docs_formvalidation_text_submit">Save changes
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endpush

@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Report Shipment
            </div>
            <div class="float-end">
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
        </div>
        <div class="card-body">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1 mb-3">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <input type="text" data-kt-shipment-table-filter="search"
                    class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
            </div>
            <!--end::Search-->
            <div class="table-responsive mb-10">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address </th>
                            <th>No Tracking</th>
                            <th>Note</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <p class="text-info"> Information List this bottom for check tracking delivery </p>
            <a href="https://cekresi.com" target="_blank" class="btn btn-info btn-sm mb-3"> Cekresi.com </a>
            <a href="https://berdu.id/cek-resi" target="_blank" class="btn btn-info btn-sm mb-3"> berdu.id </a>
            <a href="https://anteraja.id/id/tracking" target="_blank" class="btn btn-info btn-sm mb-3">
                Anteraja.id
            </a>
            <a href="https://kiriminaja.com/tracking" target="_blank" class="btn btn-info btn-sm mb-3">
                Kiriminaja.com
            </a>

        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('report.shipment') }}",
                order: [],
                columnDefs: [{
                    "targets": [0]
                }],
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'code_transaction',
                        name: 'code_transaction'
                    },

                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },

                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'number_tracking',
                        name: 'number_tracking'
                    },
                    {
                        data: 'note',
                        name: 'note'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('body').on('keyup', 'input[data-kt-shipment-table-filter="search"]', function(t) {
                table.search(t.target.value).draw();
            });

            $('body').on('click', '.edit', function() {
                var id = $(this).data('id');
                $('input[name=id_shipment]').val(id);
            });
        });
    </script>
@endpush
