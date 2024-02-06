@extends('income::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Edit {{ Str::title($income->name_transaction) }}
            </div>
            <div class="float-end">
                <a href="{{ route('income.create_trans', $income->id_income) }}" class="btn btn-primary btn-sm">&larr;
                    Back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('income.update_trans', $income->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">No Trans </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control form-control-solid " id="name" name="no_trans"
                            value="{{ $income->code_transaction }}" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control " id="name" name="name_trans" required
                            placeholder="Insert Name " value="{{ $income->name_transaction }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">
                        Date</label>
                    <div class="col-md-6">
                        <input type="date" class="form-control kt_datepicker" id="date" name="date_trans"
                            value="{{ $income->date_transaction }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">
                        Amount</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control kt_inputmask" id="amount" name="amount_trans"
                            placeholder="0" value="{{ $income->amount }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
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
    </script>
@endpush
