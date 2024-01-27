@extends('sales::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Sales Order Information
            </div>
            <div class="float-end">
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark my-2 ">Back</a>
                <a href="{{ route('sales.printsmall', $transaction->id) }}" target="_blank"
                    class="btn btn-sm btn-info my-2 ">Print receipt
                    (small) </a>
                <a href="javascript:;" class="btn btn-sm btn-info my-2 " onclick="printDiv()">Print receipt (large) </a>
                @can('create-sales')
                    <a href="{{ route('sales.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
                        New Sales </a>
                @endcan
                <!--begin::Action-->
                @if ($transaction->status != 1 && $transaction->note != 'cancel')
                    <a href="#" class="btn btn-sm btn-success">Pay Now</a>
                @endif
                <!--end::Action-->
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
                                <div class="col-sm-6">
                                    <!--end::Label-->
                                    <div class="fw-bold fs-7 text-gray-600 mb-1">Transaction Date:</div>
                                    <!--end::Label-->
                                    <!--end::Col-->
                                    <div class="fw-bolder fs-6 text-gray-800">
                                        {{ empty($transaction->date_sales) ? '-' : \Carbon\Carbon::parse($transaction->date_sales)->translatedFormat('d F Y') }}
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Col-->
                                <!--end::Col-->
                                <div class="col-sm-6">
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
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row g-5 mb-12">
                                <!--end::Col-->
                                <div class="col-sm-6">
                                    <!--end::Label-->
                                    <div class="fw-bold fs-7 text-gray-600 mb-1">Customer:</div>
                                    <!--end::Label-->
                                    <!--end::Text-->
                                    <div class="fw-bolder fs-6 text-gray-800">
                                        {{ Str::title($transaction->customer?->name) }}</div>
                                    <!--end::Text-->
                                    <!--end::Description-->
                                    <div class="fw-bold fs-7 text-gray-600"> {{ $transaction->customer?->address }}
                                        <br> {{ $transaction->customer?->contact }}
                                        <br> {{ $transaction->customer?->email }}
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
                                        <thead>
                                            <tr class="border-bottom fs-6 fw-bolder text-muted">
                                                <th class="min-w-175px pb-2">Code</th>
                                                <th class="min-w-70px text-end pb-2">Product</th>
                                                <th class="min-w-80px text-end pb-2">Unit</th>
                                                <th class="min-w-80px text-end pb-2">Qty</th>
                                                <th class="min-w-100px text-end pb-2">Price Unit </th>
                                                <th class="min-w-100px text-end pb-2">Amount </th>
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
                                                        {{ empty($details->products->price_sell) ? 0 : number_format($details->products->price_sell, 0, ',', '.') }}
                                                    </td>
                                                    <td class="pt-6">
                                                        {{ empty($details->products->price_sell) ? 0 : number_format($details->products->price_sell * $details->qty, 0, ',', '.') }}
                                                    </td>

                                                    @php
                                                        $subtotal += $details->products->price_sell * $details->qty;
                                                    @endphp
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6"> No Found Product Sales </td>
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
                                                {{ empty($transaction->total_transaction) ? 0 : number_format($transaction->total_transaction, 0, ',', '.') }}
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Code-->
                                            <div class="fw-bold pe-10 text-gray-600 fs-7">Nominal</div>
                                            <!--end::Code-->
                                            <!--begin::Label-->
                                            <div class="text-end fw-bolder fs-6 text-gray-800">
                                                {{ empty($transaction->amount) ? 0 : number_format($transaction->amount, 0, ',', '.') }}
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Code-->
                                            <div class="fw-bold pe-10 text-gray-600 fs-7">Money Changes</div>
                                            <!--end::Code-->
                                            <!--begin::Label-->
                                            <div class="text-end fw-bolder fs-6 text-gray-800">
                                                {{ number_format($transaction->amount - $transaction->total_transaction, 0, ',', '.') }}
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
                    </div>
                    <!--end::Invoice 2 sidebar-->
                </div>
                <!--end::Sidebar-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Body-->
    </div>
@endsection
@push('scripts')
    <script>
        var afterPrint = function() {
            window.close();
        };

        function printDiv() {
            var printContents = document.getElementById('printarea').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

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
    </script>
@endpush
