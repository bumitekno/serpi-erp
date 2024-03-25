@extends('template')
@push('menu-tops')
    @include('top_menu')
@endpush

@push('modals')
    <div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="kt_modal_1Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kt_modal_1Label">Are you sure?</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="bi bi-exclamation-triangle fs-5x"></i><br>
                    <p class="mb-0">Are you sure to delete this record ( {{ $journal->name }} )</p>
                    <p class="mb-0">You won't be able to revert this!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="delete-form-{{ $journal->id }}" action="{{ route('account.journal.destroy', $journal->id) }}"
                        method="put">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"> <i class="bi bi-trash"> </i> Delete </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush

@section('content')
    <form action="{{ route('account.journal.update', $journal->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <h1 class="py-5 fw-bolder"> Journal Edit </h1>
                </div>
                <div class="float-end">
                    <div class="d-flex py-5">
                        <a href="{{ route('account.journal') }}" class="btn btn-dark me-2">Back </a>
                        <button type="submit" class="btn btn-primary me-2 ">Save</button>
                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                            Actions
                            <span class="svg-icon svg-icon-5 m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path
                                            d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)">
                                        </path>
                                    </g>
                                </svg>
                            </span>
                        </a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                            data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="javascript:;" class="menu-link px-3" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_1">
                                    Delete
                                </a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="py-5">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">Journal Name</label>
                            <div class="wrap-input200">
                                <input type="text" name="name" placeholder="Journal Name" value="{{ $journal->name }}"
                                    class="input200 {{ $errors->has('name') ? 'is-invalid' : '' }} form-control">
                            </div>
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Type</label>
                                <div class="col-sm-7">
                                    <div class="wrap-input200">
                                        <select name="type" id="type" style="border:none"
                                            class="input200 {{ $errors->has('type') ? 'is-invalid' : '' }} form-select"
                                            data-control="select2" data-placeholder="Select Type ">
                                            <option></option>
                                            <option value="Sales"
                                                @if ($journal->type == 'Sales') selected="selected" @endif>Sales</option>
                                            <option value="Purchases"
                                                @if ($journal->type == 'Purchases') selected="selected" @endif>Purchases
                                            </option>
                                            <option value="Cash"
                                                @if ($journal->type == 'Cash') selected="selected" @endif>Cash</option>
                                            <option value="Bank"
                                                @if ($journal->type == 'Bank') selected="selected" @endif>Bank</option>
                                            <option value="Miscellaneous"
                                                @if ($journal->type == 'Miscellaneous') selected="selected" @endif>Miscellaneous
                                            </option>
                                        </select>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('type') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Company</label>
                                <div class="col-sm-7">
                                    <div class="wrap-input200">
                                        <select name="company_id" id="company_id" style="border:none"
                                            class="input200 {{ $errors->has('company_id') ? 'is-invalid' : '' }} form-select"
                                            data-control="select2" data-placeholder="Select Company ">
                                            @foreach ($company as $row)
                                                <option value="{{ $row->id }}"
                                                    {{ $row->id == $journal->company_id ? 'selected' : '' }}>
                                                    {{ ucfirst($row->company_name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('company_id') }}</p>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item" id="entries">
                                <a class="nav-link active journal_entry" href="#">Journal Entries</a>
                            </li>
                            <li class="nav-item" id="bank" style="display: none">
                                <a class="nav-link bank_account" href="#">Bank Account</a>
                            </li>
                            <li class="nav-item" id="settings">
                                <a class="nav-link advance_setting" href="#">Advanced Settings</a>
                            </li>
                        </ul>
                        <section id="JournalEntries">
                            <div class="py-3">
                                <div class="row">
                                    <div class="col-sm-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label">Short Code</label>
                                            <div class="col-sm-7">
                                                <div class="wrap-input200">
                                                    <input type="text" name="code" id="code"
                                                        value="{{ $journal->code }}"
                                                        class="input200 {{ $errors->has('code') ? 'is-invalid' : '' }} form-control"
                                                        autofocus>
                                                </div>
                                                <p class="text-danger">{{ $errors->first('code') }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label">Currency</label>
                                            <div class="col-sm-7">
                                                <div class="wrap-input200">
                                                    <select name="currency_id" id="currency_id" style="border:none"
                                                        class="input200 {{ $errors->has('currency_id') ? 'is-invalid' : '' }} form-select"
                                                        data-control="select2" data-placeholder="Select currency">
                                                        <option></option>
                                                        @foreach ($currency as $row)
                                                            <option value="{{ $row->id }}"
                                                                {{ $row->id == $journal->currency_id ? 'selected' : '' }}>
                                                                {{ ucfirst($row->currency_name) }}
                                                                ({{ ucfirst($row->symbol) }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <p class="text-danger">{{ $errors->first('currency_id') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-5 col-form-label">Default Debit Account</label>
                                            <div class="col-sm-6">
                                                <div class="wrap-input200">
                                                    <select name="default_debit_account_id" id="default_debit_account_id"
                                                        style="border:none"
                                                        class="input200 {{ $errors->has('default_debit_account_id') ? 'is-invalid' : '' }} form-select"
                                                        data-control="select2" data-placeholder="Select Account Debit">
                                                        <option value=""></option>
                                                        @foreach ($account as $row)
                                                            <option value="{{ $row->code }}"
                                                                {{ $row->code == $journal->default_debit_account_id ? 'selected' : '' }}>
                                                                {{ ucfirst($row->name) }}
                                                                |
                                                                {{ ucfirst($row->code) }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <p class="text-danger">{{ $errors->first('default_debit_account_id') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-5 col-form-label">Default Credit Account</label>
                                            <div class="col-sm-6">
                                                <div class="wrap-input200">
                                                    <select name="default_credit_account_id"
                                                        id="default_credit_account_id" style="border:none"
                                                        class="input200 {{ $errors->has('default_credit_account_id') ? 'is-invalid' : '' }} form-select"
                                                        data-control="select2" data-placeholder="Select Account Credit">
                                                        <option></option>
                                                        @foreach ($account as $row)
                                                            <option value="{{ $row->code }}"
                                                                {{ $row->code == $journal->default_credit_account_id ? 'selected' : '' }}>
                                                                {{ ucfirst($row->name) }}
                                                                |
                                                                {{ ucfirst($row->code) }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <p class="text-danger">{{ $errors->first('default_credit_account_id') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="AdvanceSetting">
                            <div class="py-3">
                                <div class="row mb-3">
                                    <div class="col-sm-9 mt-2">
                                        <section id="posting">
                                            <h5 class="text-primary">Posting</h5>
                                            <section id="ProfitLoss">
                                                <div class="row mt-1">
                                                    <label class="col-sm-3 col-form-label">Profit Account</label>
                                                    <div class="col-sm-6">
                                                        <div class="wrap-input200">
                                                            <select name="profit_account_id" id="profit_account_id"
                                                                style="border:none"
                                                                class="input200 {{ $errors->has('profit_account_id') ? 'is-invalid' : '' }} form-select"
                                                                data-control="select2"
                                                                data-placeholder="Select Profit Account">
                                                                <option></option>
                                                                @foreach ($account as $row)
                                                                    <option value="{{ $row->code }}"
                                                                        {{ $row->code == $journal->profit_account_id ? 'selected' : '' }}>
                                                                        {{ ucfirst($row->name) }}
                                                                        | {{ ucfirst($row->code) }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <p class="text-danger">{{ $errors->first('profit_account_id') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label">Loss Account</label>
                                                    <div class="col-sm-6">
                                                        <div class="wrap-input200">
                                                            <select name="loss_account_id" id="loss_account_id"
                                                                style="border:none"
                                                                class="input200 {{ $errors->has('loss_account_id') ? 'is-invalid' : '' }} form-select"
                                                                data-control="select2"
                                                                data-placeholder="Select Loss Account">
                                                                <option></option>
                                                                @foreach ($account as $row)
                                                                    <option value="{{ $row->code }}"
                                                                        {{ $row->code == $journal->loss_account_id ? 'selected' : '' }}>
                                                                        {{ ucfirst($row->name) }}
                                                                        | {{ ucfirst($row->code) }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <p class="text-danger">{{ $errors->first('loss_account_id') }}</p>
                                                    </div>
                                                </div>
                                            </section>
                                            <div class="row">
                                                <label class="col-sm-3">Post At</label>
                                                <div class="col-sm-6">
                                                    <div class="row ml-3 mb-3">
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" id="payment"
                                                                name="post_at" value="payment validation"
                                                                {{ $journal->post_at == 'payment validation' ? 'checked' : '' }} />
                                                            <label class="form-check-label" for="flexRadioChecked">
                                                                Payment Validation
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row ml-3 mb-3">
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio"
                                                                id="bankreconsiliation" name="post_at"
                                                                value="bank reconciliation"
                                                                {{ $journal->post_at == 'bank reconciliation' ? 'checked' : '' }} />
                                                            <label class="form-check-label" for="flexRadioChecked">
                                                                Bank Reconciliation
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9 mt-2">
                                        <h5 class="text-primary mb-3">Control-Access</h5>

                                        <p class="blockquote-footer mb-3">Keep empty for no control</p>
                                        <div class="row mt-1">
                                            <label class="col-sm-3 col-form-label">Account Types Allowed</label>
                                            <div class="col-sm-6">
                                                <div class="wrap-input200">
                                                    <select name="account_type_allowed" id="account_type_allowed"
                                                        style="border:none"
                                                        class="input200 {{ $errors->has('account_type_allowed') ? 'is-invalid' : '' }} form-select"
                                                        data-control="select2" data-placeholder="Select Type Account">
                                                        <option></option>
                                                        @foreach ($account_type as $row)
                                                            <option value="{{ $row->id }}"
                                                                {{ $row->id == $journal->account_type_allowed ? 'selected' : '' }}>
                                                                {{ ucfirst($row->name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <p class="text-danger">{{ $errors->first('account_type_allowed') }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">Account Allowed</label>
                                            <div class="col-sm-6">
                                                <div class="wrap-input200">
                                                    <select name="account_allowed" id="account_allowed"
                                                        style="border:none"
                                                        class="input200 {{ $errors->has('account_allowed') ? 'is-invalid' : '' }} form-select"
                                                        data-control="select2" data-placeholder="Select Allowed Account">
                                                        <option value=""></option>
                                                        @foreach ($account as $row)
                                                            <option value="{{ $row->code }}"
                                                                {{ $row->code == $journal->account_allowed ? 'selected' : '' }}>
                                                                {{ ucfirst($row->name) }}
                                                                |
                                                                {{ ucfirst($row->code) }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <p class="text-danger">{{ $errors->first('account_allowed') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="bankaccount">
                            <div class="py-3">
                                <div class="row">
                                    <div class="col-sm-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label">Bank Account</label>
                                            <div class="col-sm-7">
                                                <div class="wrap-input200">
                                                    <select name="bank_account_id" id="bank_account_id"
                                                        style="border:none"
                                                        class="input200 {{ $errors->has('bank_account_id') ? 'is-invalid' : '' }} form-select"
                                                        data-control="select2" data-placeholder="Select Bank Account">
                                                        <option></option>
                                                        @foreach ($bank_account as $row)
                                                            <option value="{{ $row->id }}"
                                                                {{ $row->id == $journal->bank_account_id ? 'selected' : '' }}>
                                                                {{ ucfirst($row->company_bank_name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <p class="text-danger">{{ $errors->first('bank_account_id') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label">Bank</label>
                                            <div class="col-sm-7">
                                                <div class="wrap-input200">
                                                    <select name="bank" id="bank" style="border:none"
                                                        class="input200 {{ $errors->has('bank') ? 'is-invalid' : '' }} form-select"
                                                        data-control="select2" data-placeholder="Select Bank">
                                                        <option value=""></option>
                                                        @foreach ($bank as $row)
                                                            <option value="{{ $row->id }}"
                                                                {{ $row->id == $journal->bank ? 'selected' : '' }}>
                                                                {{ ucfirst($row->bank_name) }}
                                                                ({{ ucfirst($row->symbol) }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <p class="text-danger">{{ $errors->first('bank') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('a#account-config').addClass('mm-active');
        $('a#journal').addClass('mm-active');

        function close() {
            const close = document.querySelectorAll("section");
            close.forEach(function(el) {
                el.style.display = 'none';
            });
        }

        function Hide(params) {
            $(params).css("display", "none");
        }

        function Display(params) {
            $(params).css("display", "");
        }

        function unactive() {
            $('.nav-link').removeClass('active');
        }

        function checktype() {
            var status = $("#type").val();
            if (status == "Sales") {
                Hide("#bank");
            }
            if (status == "Purchases") {
                Hide("#bank");
            }
            if (status == "Cash") {
                Hide("#bank");
                Display("section#ProfitLoss");
                Display("section#posting");
            }
            if (status == "Bank") {
                Display("#bank");
                Display("section#posting");
                Hide("section#ProfitLoss");
            }
            if (status == "Miscellaneous") {
                Hide("#bank");
            }
        }
        $("#type").change(function() {
            checktype()
        });

        close();

        $(function() {
            close();
            Display("section#JournalEntries");
            checktype()

            $("a.journal_entry").click(function(event) {
                close();
                unactive();
                checktype();
                $(this).addClass('active');
                Display("section#JournalEntries");
                event.preventDefault();
            });

            // if jobs position clicked
            $("a.bank_account").click(function(event) {
                close();
                unactive();
                checktype();
                $(this).addClass('active');
                Display("section#bankaccount");
                event.preventDefault();
            });

            // if advance setting clicked
            $("a.advance_setting").click(function(event) {
                close();
                unactive();
                checktype();
                $(this).addClass('active');
                Display("section#AdvanceSetting");
                event.preventDefault();
            });
        })
    </script>
@endpush
