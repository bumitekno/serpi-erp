@extends('template')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <span class="card-label">Daily Report </span>
            </div>
            <div class="card-toolbar">

                <button class="btn btn-info btn-sm me-2" type="button" id="filter"> Filter </button>

                @if (!empty(request()->get('departement')))
                    <a href="javascript::" class="btn btn-primary btn-sm " id="export"> Export </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3 row fv-row">
                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Departement</label>
                <div class="col-md-6">
                    <select class="form-select" data-control="select2" data-placeholder="Select Departement"
                        name="departement">
                        <option></option>
                        @foreach ($list_departement as $departements)
                            <option value="{{ $departements->id }}"
                                @if (!empty(request()->get('departement')) && request()->get('departement') == $departements->id) selected="selected" @endif>
                                {{ $departements->name }}
                            </option>
                        @endforeach
                        <option value="all" @if (!empty(request()->get('departement')) && request()->get('departement') == 'all') selected="selected" @endif>All
                        </option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row fv-row">
                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Start
                    Date</label>
                <div class="col-md-6">
                    <input type="date" name="start_date_transaction" class="form-control kt_datepicker text-start"
                        value="{{ $startdate }}">
                </div>
            </div>
            <div class="mb-3 row fv-row">
                <label for="name" class="col-md-4 col-form-label text-md-end text-start">End
                    Date</label>
                <div class="col-md-6">
                    <input type="date" name="end_date_transaction" class="form-control kt_datepicker text-start"
                        value="{{ $enddate }}">
                </div>
            </div>

            <div class="content-area mt-10">
                <h3 class="card-title text-center">
                    <span class="card-label fw-bolder fs-3 mb-1"> Report Daily POS </span>
                    <br>
                    <span class="card-label fw-bolder fs-3 mb-1" id="labeldepartement"></span>
                    <br>
                    <span class="card-label fw-bolder fs-3 mb-1">
                        {{ \Carbon\Carbon::parse($startdate)->translatedFormat('d F Y') }} -
                        {{ \Carbon\Carbon::parse($enddate)->translatedFormat('d F Y') }}
                    </span>
                </h3>

                <div class="d-flex align-items-sm-center mb-7">
                    <!--begin::Section-->
                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <a href="javascript:;" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Beginning
                                Balance</a>
                            <span class="text-muted fw-bold d-block fs-7">Amount Open Balance</span>
                        </div>
                        <span class="badge badge-light fw-bolder my-2">{{ $open_balance }}</span>
                    </div>
                    <!--end::Section-->
                </div>
                <div class="d-flex align-items-sm-center mb-7">
                    <!--begin::Section-->
                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <a href="javascript:;" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Income</a>
                            <span class="text-muted fw-bold d-block fs-7">Amount Income</span>
                        </div>
                        <span class="badge badge-light fw-bolder my-2">{{ $daily_income }}</span>
                    </div>
                    <!--end::Section-->
                </div>
                <div class="d-flex align-items-sm-center mb-7">
                    <!--begin::Section-->
                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <a href="javascript:;" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Sales</a>
                            <span class="text-muted fw-bold d-block fs-7">Amount Sales</span>
                        </div>
                        <span class="badge badge-light fw-bolder my-2">{{ $daily_sales }}</span>
                    </div>
                    <!--end::Section-->
                </div>
                <div class="d-flex align-items-sm-center mb-7">
                    <!--begin::Section-->
                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <a href="javascript:;" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Purchase</a>
                            <span class="text-muted fw-bold d-block fs-7">Amount Purchase</span>
                        </div>
                        <span class="badge badge-light fw-bolder my-2">{{ $daily_purchase }}</span>
                    </div>
                    <!--end::Section-->
                </div>
                <div class="d-flex align-items-sm-center mb-7">
                    <!--begin::Section-->
                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <a href="javascript:;" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Expense</a>
                            <span class="text-muted fw-bold d-block fs-7">Amount Expense</span>
                        </div>
                        <span class="badge badge-light fw-bolder my-2">{{ $daily_expense }}</span>
                    </div>
                    <!--end::Section-->
                </div>
                <div class="d-flex align-items-sm-center mb-7">
                    <!--begin::Section-->
                    <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                        <div class="flex-grow-1 me-2">
                            <a href="javascript:;" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Ending
                                Balance</a>
                            <span class="text-muted fw-bold d-block fs-7">Amount Close Balance</span>
                        </div>
                        <span class="badge badge-light fw-bolder my-2">{{ $close_balance }}</span>
                    </div>
                    <!--end::Section-->
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            var name_departement = $('select[name=departement] option:selected').text();
            $('#labeldepartement').html(name_departement);

            $('body').on('click', 'button#filter', function() {

                var departement = $('select[name=departement] option:selected').val();
                var startdate = $('input[name=start_date_transaction]').val();
                var enddate = $('input[name=end_date_transaction]').val();

                if (departement == null || departement == '') {
                    alert('Please choose departement');
                } else {

                    var url = "{{ route('report.dailypost') }}?departement=" + departement + '&from=' +
                        startdate + '&to=' + enddate;
                    window.location.href = url;
                }

            });

            $('body').on('click', '#export', function() {

                var departement = $('select[name=departement] option:selected').val();
                var startdate = $('input[name=start_date_transaction]').val();
                var enddate = $('input[name=end_date_transaction]').val();

                var url = "{{ route('report.downloadreportD') }}?departement=" + departement + '&from=' +
                    startdate + '&to=' + enddate;
                window.location.href = url;

            });

        });
    </script>
@endpush
