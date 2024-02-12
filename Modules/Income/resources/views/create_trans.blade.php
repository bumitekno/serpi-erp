@extends('income::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Transaction Income {{ Str::title($income->name) }}
            </div>
            <div class="float-end">
                <a href="{{ route('income.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row g-5 g-xl-8">
                <div class="col-lx-4">
                    <form action="{{ route('income.storetrans') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $income->id }}" name="id_income">
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">No Trans </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-solid " id="name"
                                    name="no_trans" value="{{ $no_trans }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Departement
                            </label>
                            <div class="col-md-6">
                                <select class="form-select" data-control="select2" data-placeholder="Select Departement"
                                    name="departement" required>
                                    <option></option>
                                    @foreach ($list_departement as $departements)
                                        <option value="{{ $departements->id }}">
                                            {{ $departements->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control " id="name" name="name_trans" required
                                    placeholder="Insert Name ">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">
                                Date</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control kt_datepicker" id="date" name="date_trans">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">
                                Amount</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control kt_inputmask" id="amount" name="amount_trans"
                                    placeholder="0">

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>
                <div class="col-lx-8">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(".kt_datepicker").flatpickr({
            dateFormat: "d/m/Y",
            defaultDate: new Date()
        });

        // Currency
        Inputmask({
            "numericInput": true,
            "clearMaskOnLostFocus": true,
            "removeMaskOnSubmit": true,
            "placeholder": "",
            "autoUnmask": true,
            'digits': 0,
            'rightAlign': false,
            'allowMinus': false,
            'alias': 'currency',
            'groupSeparator': '.'
        }).mask(".kt_inputmask");

        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('income.create_trans', $income->id) }}",
                order: [],
                columnDefs: [{
                    "targets": [0]
                }],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'code_transaction',
                        name: 'code_transaction'
                    },
                    {
                        data: 'date_transaction',
                        name: 'date_transaction'
                    },
                    {
                        data: 'name_transaction',
                        name: 'name_transaction'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@endpush
