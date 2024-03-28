@extends('template')
@push('menu-tops')
    @include('top_menu')
@endpush
@section('content')
    <form action="{{ route('account.payment.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <H1 class="py-3">Payment Create </H1>
                </div>
                <div class="float-end">
                    <div class="py-3">
                        <a href="{{ route('account.payment') }}" class="btn btn-dark"> Back </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger text-center" role="alert">
                        {{ $message }}
                    </div>
                @endif

                <div class="py-5">
                    <div class="o_group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group ml-3 table">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label" style="width: 30%;">
                                                <label class="o_form_label o_required_modifier">Payment Type</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="row ml-3 mb-2">

                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="radio" name="payment_type"
                                                            value="inbound" id="flexRadioDefault" />
                                                        <label class="form-check-label" for="flexRadioDefault">
                                                            Send Money
                                                        </label>
                                                    </div>

                                                </div>
                                                <div class="row ml-3 mb-2">
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="radio" id="flexRadioDefault"
                                                            name="payment_type" value="outbound" checked="true" />
                                                        <label class="form-check-label" for="flexRadioDefault">
                                                            Receive Money
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label" style="width: 30%;">
                                                <label for="" name="partner_type" class="col-form-label"><b>Partner
                                                        Type
                                                    </b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="form-group">
                                                    <select id="partner_type" required name="partner_type"
                                                        class="form-control o_input o_field_widget o_required_modifier"
                                                        data-control="select2" data-placeholder="Select Partner Type">
                                                        <option></option>
                                                        <option value="customer">Customer</option>
                                                        <option value="vendor">Vendor</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="customer" style="display:none">
                                            <td class="o_td_label" style="width: 30%;">
                                                <label for="" name="partner"
                                                    class="col-form-label"><b>Partner</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="form-group">
                                                    <select name="partner_id_cust"
                                                        class="form-control o_input o_field_widget o_required_modifier form-select"
                                                        data-control="select2" data-placeholder="Select Partner">
                                                        <option></option>
                                                        @foreach ($partner_customer as $row)
                                                            <option value="{{ $row->id }}">
                                                                {{ ucfirst($row->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="vendor" style="display:none">
                                            <td class="o_td_label" style="width: 30%;">
                                                <label for="" name="partner"
                                                    class="col-form-label"><b>Partner</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="form-group">
                                                    <select name="partner_id_sup"
                                                        class="form-control o_input o_field_widget o_required_modifier form-select"
                                                        data-control="select2" data-placeholder="Select Partner">
                                                        <option></option>
                                                        @foreach ($partner_vendor as $row)
                                                            <option value="{{ $row->id }}">
                                                                {{ ucfirst($row->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label" style="width: 30%;">
                                                <label
                                                    class="o_form_label o_readonly_modifier o_required_modifier">Company</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <select name="company_id" id="company_id" style="border:none"
                                                    class="input200 {{ $errors->has('company_id') ? 'is-invalid' : '' }} form-select"
                                                    data-control="select2" data-placeholder="Select Company">
                                                    <option value=""></option>
                                                    @foreach ($company as $row)
                                                        <option value="{{ $row->id }}">
                                                            {{ ucfirst($row->company_name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group table">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_required_modifier">Journal</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <select class="form-select " required name="journal_id"
                                                    data-control="select2" data-placeholder="Select Journal">
                                                    <option></option>
                                                    @foreach ($journal as $row)
                                                        <option value="{{ $row->id }}">{{ ucfirst($row->name) }}
                                                            ({{ ucfirst($row->currency->currency_name) }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label" style="width: 30%;">
                                                <label class="o_form_label o_required_modifier">Payment Method</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="row ml-3 mb-2">
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="radio"
                                                            id="flexRadioDefault" name="payment_method" value="Manual"
                                                            checked="true" />
                                                        <label class="form-check-label" for="flexRadioDefault">
                                                            Manual
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row ml-3 mb-2">
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="radio"
                                                            id="flexRadioDefault" name="payment_method" value="Check" />
                                                        <label class="form-check-label" for="flexRadioDefault">
                                                            Check
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row ml-3 mb-2">
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="radio"
                                                            name="payment_method" value="PDC" id="flexRadioDefault" />
                                                        <label class="form-check-label" for="flexRadioDefault">
                                                            PDC ( Post Date Check )
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group ml-3 table ">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Amount</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div name="amount_div" class="o_row">
                                                    <input type="text"
                                                        class="o_input o_field_widget o_required_modifier form-control kt_inputmask"
                                                        required name="amount">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_required_modifier">Date</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input type="date"
                                                    class="o_input o_field_widget o_required_modifier form-control"
                                                    required name="payment_date">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label" style="width: 30%;">
                                                <label class="o_form_label">Bank Reference</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_char o_field_widget o_input form-control"
                                                    name="bank_reference">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label" style="width: 30%;">
                                                <label class="o_form_label">Cheque Reference</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_char o_field_widget o_input form-control"
                                                    name="cheque_reference">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Memo</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_char o_field_widget o_input form-control"
                                                    name="communication">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script>
        $(function() {

            $('select[name=partner_type]').change(function(e) {
                if (e.target.value == 'customer') {
                    $('#partner_id_cust').select2();
                    $('#customer').show();
                    $('#vendor').hide();
                } else if (e.target.value == 'vendor') {
                    $('#partner_id_sup').select2();
                    $('#vendor').show();
                    $('#customer').hide();
                }
            });

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

        });
    </script>
@endpush
