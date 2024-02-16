@extends('purchase::layouts.master')
@push('modals')
    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <form id="kt_docs_formvalidation_text_p" class="form" action="{{ route('purchase.pay_credit') }}" autocomplete="off"
            method="POST">
            @csrf
            <input type="hidden" name="id_trans" value="{{ $transaction->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal Pay Credit</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Date Credit
                            </label>
                            <div class="col-md-4">
                                <input type="date" name="date_transaction" class="form-control kt_datepicker text-start"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start"> Amount
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="amount_transaction" class="form-control text-start" required
                                    data-type="currency" placeholder="0">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endpush
@section('content')
    <div class="card mb-3 ">
        <div class="card-header mt-3">
            <div class="float-start">
                Purchase Order Information
            </div>
            <div class="float-end">
                @if (request()->get('import') == true && !empty(request()->get('import')))
                    <a href="{{ route('purchase.index') }}" class="btn btn-sm btn-dark my-2 "> Back to Purchase </a>
                    @if ($transaction->transfer_stock == 0)
                        <a href="{{ route('purchase.storetransfer', $transaction->id) }}"
                            class="btn btn-sm btn-info my-2 ">Transfer Stock </a>
                    @endif
                @else
                    <a href="{{ route('purchase.index') }}" class="btn btn-sm btn-dark my-2 ">Back</a>
                    <a href="javascript:;" class="btn btn-sm btn-info my-2 " onclick="printDiv()">Print receipt (large) </a>
                    @can('create-purchase')
                        <a href="{{ route('purchase.create') }}" class="btn btn-success btn-sm my-2"><i
                                class="bi bi-plus-circle"></i>
                            New Purchase </a>
                    @endcan
                    <!--begin::Action-->
                    @if ($transaction->status != 1 && $transaction->note != 'cancel')
                        <a href="javascript:;" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_1">Pay Now</a>
                    @endif
                    <!--end::Action-->
                @endif
            </div>
        </div>

        <!--begin::Body-->
        <div class="card-body p-lg-20" id="printarea">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
                    <!--begin::Invoice 2 content-->
                    <div class="mt-n1">
                        <!--begin::Top-->
                        <div class="d-flex flex-stack pb-10">
                            <!--begin::Logo-->
                            <a href="#">
                                @if (!empty($transaction->departement->image))
                                    <img alt="Logo" src="{{ Storage::url($transaction->departement->image) }}">
                                @else
                                    <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/code-lab.svg') }}">
                                @endif
                            </a>
                            <!--end::Logo-->

                        </div>
                        <!--end::Top-->
                        <!--begin::Wrapper-->
                        <div class="m-0">
                            <!--begin::Label-->
                            <div class="fw-bolder fs-3 text-gray-800 mb-8">Invoice #{{ $transaction?->code_transaction }}
                            </div>
                            <!--end::Label-->
                            <!--begin::Row-->
                            <div class="row g-5 mb-11">
                                <!--end::Col-->
                                <div class="col-sm-4">
                                    <!--end::Label-->
                                    <div class="fw-bold fs-7 text-gray-600 mb-1">Transaction Date:</div>
                                    <!--end::Label-->
                                    <!--end::Col-->
                                    <div class="fw-bolder fs-6 text-gray-800">
                                        {{ empty($transaction->date_purchase) ? '-' : \Carbon\Carbon::parse($transaction->date_purchase)->translatedFormat('d F Y') }}
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Col-->
                                <!--end::Col-->
                                <div class="col-sm-4">
                                    <!--end::Label-->
                                    <div class="fw-bold fs-7 text-gray-600 mb-1">Due Date:</div>
                                    <!--end::Label-->
                                    <!--end::Info-->
                                    <div class="fw-bolder fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                                        <span
                                            class="pe-2">{{ empty($transaction->date_due) ? '-' : \Carbon\Carbon::parse($transaction->date_due)->translatedFormat('d F Y') }}</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Col-->
                                <div class="col-sm-4">
                                    <!--end::Label-->
                                    <div class="fw-bold fs-7 text-gray-600 mb-1">Operator:</div>
                                    <!--end::Label-->
                                    <!--end::Info-->
                                    <div class="fw-bolder fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                                        <span class="pe-2">{{ $transaction->operator?->name }}</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row g-5 mb-12">
                                <!--end::Col-->
                                <div class="col-sm-6">
                                    <!--end::Label-->
                                    <div class="fw-bold fs-7 text-gray-600 mb-1">Supplier:</div>
                                    <!--end::Label-->
                                    <!--end::Text-->
                                    <div class="fw-bolder fs-6 text-gray-800">
                                        {{ Str::title($transaction->supplier?->name) }}</div>
                                    <!--end::Text-->
                                    <!--end::Description-->
                                    <div class="fw-bold fs-7 text-gray-600"> {{ $transaction->supplier?->address }}
                                        <br> {{ $transaction->supplier?->contact }}
                                        <br> {{ $transaction->supplier?->email }}
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Col-->
                                <!--end::Col-->
                                <div class="col-sm-6">
                                    <!--end::Label-->
                                    <div class="fw-bold fs-7 text-gray-600 mb-1">Departement Store :</div>
                                    <!--end::Label-->
                                    <!--end::Text-->
                                    <div class="fw-bolder fs-6 text-gray-800">{{ $transaction->departement?->name }}</div>
                                    <!--end::Text-->
                                    <!--end::Description-->
                                    <div class="fw-bold fs-7 text-gray-600"> {{ $transaction->departement?->address }}
                                        <br> {{ $transaction->departement?->email }}
                                        <br> {{ $transaction->departement?->contact }}
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                            <!--begin::Content-->
                            <div class="flex-grow-1">
                                <!--begin::Table-->
                                <div class="table-responsive border-bottom mb-9">
                                    <table class="table mb-3">
                                        <thead class="table-dark">
                                            <tr class="border-bottom fs-6 fw-bolder text-muted">
                                                <th class="min-w-175px pb-2"><span class="p-2">Code</span></th>
                                                <th class="min-w-70px text-end pb-2">Product</th>
                                                <th class="min-w-80px text-end pb-2">Unit</th>
                                                <th class="min-w-80px text-end pb-2">Qty</th>
                                                <th class="min-w-100px text-end pb-2">Price Unit </th>
                                                <th class="min-w-100px text-end pb-2"><span class="p-2">Amount</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $subtotal = 0;
                                            @endphp
                                            @forelse($detail_transaction as $details)
                                                <tr class="fw-bolder text-gray-700 fs-5 text-end">
                                                    <td class="d-flex align-items-center pt-6">
                                                        {{ $details->products?->code_product }}</td>
                                                    <td class="pt-6">{{ $details->products?->name }}</td>
                                                    <td class="pt-6">{{ $details->units?->name }}</td>
                                                    <td class="pt-6">{{ $details->qty }}</td>
                                                    <td class="pt-6">
                                                        {{ empty($details->price_purchase) ? 0 : number_format($details->price_purchase, 0, ',', '.') }}
                                                    </td>
                                                    <td class="pt-6">
                                                        {{ empty($details->price_purchase) ? 0 : number_format($details->price_purchase * $details->qty, 0, ',', '.') }}
                                                    </td>
                                                    @php
                                                        $subtotal += $details->price_purchase * $details->qty;
                                                    @endphp
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6"> No Found Product Purchase </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Table-->
                                <!--begin::Container-->
                                <div class="d-flex justify-content-end">
                                    <!--begin::Section-->
                                    <div class="mw-300px">
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-3">
                                            <!--begin::Accountname-->
                                            <div class="fw-bold pe-10 text-gray-600 fs-7">Subtotal:</div>
                                            <!--end::Accountname-->
                                            <!--begin::Label-->
                                            <div class="text-end fw-bolder fs-6 text-gray-800">
                                                {{ number_format($subtotal, 0, ',', '.') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-3">
                                            <!--begin::Accountname-->
                                            <div class="fw-bold pe-10 text-gray-600 fs-7">Discount</div>
                                            <!--end::Accountname-->
                                            <!--begin::Label-->
                                            <div class="text-end fw-bolder fs-6 text-gray-800">
                                                {{ empty($transaction->discount_amount) ? 0 : number_format($transaction->discount_amount, 0, ',', '.') }}
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack mb-3">
                                            <!--begin::Accountnumber-->
                                            <div class="fw-bold pe-10 text-gray-600 fs-7">Tax</div>
                                            <!--end::Accountnumber-->
                                            <!--begin::Number-->
                                            <div class="text-end fw-bolder fs-6 text-gray-800">
                                                {{ empty($transaction->tax_amount) ? 0 : number_format($transaction->tax_amount, 0, ',', '.') }}
                                            </div>
                                            <!--end::Number-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Code-->
                                            <div class="fw-bold pe-10 text-gray-600 fs-7">Total</div>
                                            <!--end::Code-->
                                            <!--begin::Label-->
                                            <div class="text-end fw-bolder fs-6 text-gray-800">
                                                {{ empty($transaction->amount) ? 0 : number_format($transaction->amount, 0, ',', '.') }}
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->

                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Container-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Invoice 2 content-->
                </div>
                <!--end::Content-->
                <!--begin::Sidebar-->
                <div class="m-0">
                    <!--begin::Invoice 2 sidebar-->
                    <div
                        class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
                        <!--begin::Labels-->
                        <div class="mb-8">
                            <div class="fw-bold text-gray-600 fs-7 mt-2 mb-3">Status :</div>
                            <div class="fw-bolder text-gray-800 fs-6">
                                @if ($transaction->status == 1)
                                    <span class="badge badge-light-success me-2">Paid</span>
                                @else
                                    <span class="badge badge-light-warning">Pending Payment</span>
                                @endif
                            </div>
                        </div>
                        <!--end::Labels-->
                        <!--begin::Title-->
                        <h6 class="mb-8 fw-boldest text-gray-600 text-hover-primary">PAYMENT DETAILS</h6>
                        <!--end::Title-->
                        <!--begin::Item-->
                        <div class="mb-6">
                            <div class="fw-bold text-gray-600 fs-7">Method :</div>
                            <div class="fw-bolder text-gray-800 fs-6">{{ $transaction->methodpayment?->name }}</div>
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="mb-6">
                            <div class="fw-bold text-gray-600 fs-7">Note:</div>
                            <div class="fw-bolder text-gray-800 fs-6">
                                {{ empty($transaction->note) ? '-' : $transaction->note }}
                            </div>
                        </div>
                        <!--end::Item-->

                        @if (!empty($transaction->file_doc))
                            <!--begin::Overlay-->
                            <a class="d-block overlay" data-fslightbox="lightbox-basic"
                                href="{{ Storage::url($transaction->file_doc) }}">
                                <!--begin::Image-->
                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                    style="background-image:url('{{ Storage::url($transaction->file_doc) }}')">
                                </div>
                                <!--end::Image-->
                                <!--begin::Action-->
                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                    <i class="bi bi-eye-fill text-white fs-3x"></i>
                                </div>
                                <!--end::Action-->
                            </a>
                            <!--end::Overlay-->
                        @endif

                    </div>
                    <!--end::Invoice 2 sidebar-->
                </div>
                <!--end::Sidebar-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Body-->
    </div>
    <div class="card" id="print-addon">
        <div class="card-header mt-3">
            <div class="float-start">
                Credit Information
            </div>
            <div class="float-end ">
                Remaining payment : <span class="badge badge-light-danger">
                    {{ $total_credit - $transaction->amount > 0 ? number_format($total_credit - $transaction->amount * -1, 0, ',', '.') : '-' }}
                </span>
            </div>
        </div>
        <div class="card-body p-lg-20">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th><span class="p-2">#</span></th>
                            <th>Date Credit</th>
                            <th>Status </th>
                            <th> <span class="p-2">Amount </span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($credit_transaction as $credit)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($credit->date_credit)->translatedFormat('d F Y') }}</td>
                                <td>{{ $credit->status == 1 ? 'Paid' : 'Pending' }}</td>
                                <td>{{ number_format($credit->amount, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
    <script type="text/javascript">
        $(".kt_datepicker").flatpickr({
            dateFormat: "d/m/Y",
            defaultDate: new Date()
        });
        var afterPrint = function() {
            window.close();
        };

        function printDiv() {
            var printContents = document.getElementById('printarea').innerHTML;
            var printAddon = document.getElementById('print-addon').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents + '<br>' + printAddon;

            window.print();

            document.body.innerHTML = originalContents;
        }

        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');
            mediaQueryList.addListener(function(mql) {
                if (!mql.matches) {
                    afterPrint();
                }
            });
        }

        window.onafterprint = afterPrint;

        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }

        function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.

            // get input value
            var input_val = input.val();

            // don't validate empty input
            if (input_val === "") {
                return;
            }

            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");

            // check for decimal
            if (input_val.indexOf(",") >= 0) {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(",");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);

                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                    right_side += "00";
                }

                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = left_side + "," + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = input_val;
            }

            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            }
        });
    </script>
@endpush
