@extends('template')
@push('menu-tops')
    @include('top_menu')
@endpush
@section('content')
    <form action="{{ route('account.journal.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <h1 class="py-5 fw-bolder"> Journal Create </h1>
                </div>
                <div class="float-end">
                    <div class="d-flex py-5">
                        <a href="{{ route('account.journal') }}" class="btn btn-dark me-2">Back </a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="py-5">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">Journal Name</label>
                            <div class="wrap-input200">
                                <input type="text" name="name" placeholder="Journal Name"
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
                                            <option value="Sales">Sales</option>
                                            <option value="Purchases">Purchases</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Bank">Bank</option>
                                            <option value="Miscellaneous">Miscellaneous</option>
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
                                                <option value="{{ $row->id }}">{{ ucfirst($row->company_name) }}
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
                                                            <option value="{{ $row->id }}">
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
                                                            <option value="{{ $row->code }}">{{ ucfirst($row->name) }}
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
                                                            <option value="{{ $row->code }}">{{ ucfirst($row->name) }}
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
                                                                    <option value="{{ $row->code }}">
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
                                                                    <option value="{{ $row->code }}">
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
                                                                name="post_at" value="payment validation" />
                                                            <label class="form-check-label" for="flexRadioChecked">
                                                                Payment Validation
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="row ml-3 mb-3">
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio"
                                                                id="bankreconsiliation" name="post_at"
                                                                value="bank reconciliation" />
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
                                                            <option value="{{ $row->id }}">{{ ucfirst($row->name) }}
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
                                                            <option value="{{ $row->code }}">{{ ucfirst($row->name) }}
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
                                                            <option value="{{ $row->id }}">
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
                                                            <option value="{{ $row->id }}">
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
    <script>
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
