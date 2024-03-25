@extends('template')
@push('menu-tops')
    @include('top_menu')
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <ol class="breadcrumb py-3" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{ route('account.invoice') }}">Payments</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $data->name }}</li>
                </ol>
                <div class="mt-3 mb-3">
                    @if ($data->state == 'posted')
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#deliverwarning">Edit</button>
                    @else
                        <a type="button" href="{{ route('account.invoice.edit', $data->id) }}"
                            class="btn btn-primary o-kanban-button-new">Edit</a>
                    @endif
                    <a type="button" class="btn btn-secondary o-kanban-button-new" accesskey="c"
                        href="{{ route('account.invoice.create') }}">
                        Create
                    </a>
                </div>
            </div>
            <div class="float-end">
                <div class="o_form_statusbar d-flex py-3">
                    @if ($data->state == 'draft')
                        <a href="{{ route('account.payment.posted', $data) }}" class="btn btn-primary me-3 "><i
                                class="fa fa-check">Approved</i></a>
                    @endif
                    @if ($data->state == 'draft')
                        <button type="button" data-value="sent" disabled="disabled" title="Not active state"
                            aria-pressed="false" class="btn o_arrow_button btn-secondary disabled d-none d-md-block me-3">
                            Validate
                        </button>
                        <button type="button" data-value="draft" disabled="disabled" title="Current state"
                            aria-pressed="true" class="btn o_arrow_button btn-primary disabled d-none d-md-block me-3"
                            aria-current="step">
                            Draft
                        </button>
                    @endif

                    @if ($data->state == 'posted')
                        <button type="button" data-value="draft" disabled="disabled" title="Current state"
                            aria-pressed="true" class="btn o_arrow_button btn-primary disabled d-none d-md-block me-3"
                            aria-current="step">
                            Validate
                        </button>
                        <button type="button" data-value="sent" disabled="disabled" title="Not active state"
                            aria-pressed="false" class="btn o_arrow_button btn-secondary disabled d-none d-md-block me-3">
                            Draft
                        </button>
                    @endif

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="o_form_view o_form_editable">
                <div class="o_form_sheet_bg">
                    <div class="clearfix o_form_sheet">
                        <div class="o_not_full oe_button_box mx-0">
                            <a href="#" type="button" class="btn oe_stat_button">
                                <i class="fa fa-fw o_button_icon fa-dollar"></i>
                                <span>Payment Matching</span>
                            </a>
                        </div>
                        <div class="oe_title ml-3 mt-5">
                            <h1>
                                <span class="o_field_char o_field_widget o_readonly_modifier">{{ $data->name }}</span>
                            </h1>
                        </div>
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
                                                    @if ($data->payment_type == 'inbound')
                                                        Send Money
                                                    @else
                                                        Receive Money
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label" style="width: 30%;">
                                                    <label for="" name="partner_type"
                                                        class="col-form-label"><b>Partner Type </b></label>
                                                </td>
                                                <td style="width: 100%;">
                                                    {{ $data->partner_type }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label" style="width: 30%;">
                                                    <label for="" name="partner"
                                                        class="col-form-label"><b>Partner</b></label>
                                                </td>
                                                <td style="width: 100%;">
                                                    {{ $data->partner->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label" style="width: 30%;">
                                                    <label
                                                        class="o_form_label o_readonly_modifier o_required_modifier">Company</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    {{ $data->company->company_name }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 col-md-6">
                                    <table class="o_group o_inner_group table">
                                        <tbody>
                                            <tr>
                                                <td class="o_td_label" style="width: 30%;">
                                                    <label class="o_form_label o_required_modifier">Journal</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    {{ $data->journal->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label" style="width: 30%;">
                                                    <label class="o_form_label o_required_modifier">Payment Method</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    {{ $data->payment_method_id }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <table class="o_group o_inner_group ml-3 table">
                                        <tbody>
                                            <tr>
                                                <td class="o_td_label" style="width: 30%;">
                                                    <label class="o_form_label">Amount</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    Rp. {{ number_format($data->amount) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label" style="width: 30%;">
                                                    <label class="o_form_label o_required_modifier">Date</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    {{ $data->payment_date }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label" style="width: 30%;">
                                                    <label class="o_form_label">Bank Reference</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    {{ $data->bank_reference }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label" style="width: 30%;">
                                                    <label class="o_form_label">Cheque Reference</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    {{ $data->cheque_reference }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label" style="width: 30%;">
                                                    <label class="o_form_label">Memo</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    {{ $data->communication }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer"></div>
    </div>
@endsection
