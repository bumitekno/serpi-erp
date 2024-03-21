@extends('template')
@push('menu-tops')
    @include('top_menu')
@endpush
@section('content')
    <div class="card">
        <form name="form-create" action="{{ route('account.store') }}" method="POST">
            @csrf
            <div class="card-header mt-3">
                <div class="float-start">
                    Create Chart Of Account
                </div>
                <div class="float-end">
                    <a href="{{ route('account.index') }}" class="btn btn-dark ">Back </a>
                </div>
            </div>
            <div class="card-body">
                <div class="py-5">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <label class="col-sm-5 col-form-label">Code</label>
                                <div class="col-sm-6">
                                    <div class="wrap-input200">
                                        <input type="text" name="code"
                                            class="input200 {{ $errors->has('code') ? 'is-invalid' : '' }} form-control"
                                            value="{{ old('code') }}">
                                    </div>
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-5 col-form-label">Name</label>
                                <div class="col-sm-6">
                                    <div class="wrap-input200">
                                        <input type="text" name="name" id="name"
                                            class="input200 {{ $errors->has('name') ? 'is-invalid' : '' }} form-control"
                                            value="{{ old('name') }}" autofocus>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-5 col-form-label">Type</label>
                                <div class="col-sm-6">
                                    <div class="wrap-input200">
                                        <select name="type" id="type" style="border:none"
                                            class="input200 {{ $errors->has('type') ? 'is-invalid' : '' }} form-select"
                                            data-control="select2" data-placeholder="Select Type">
                                            <option value=""></option>
                                            @foreach ($account_type as $row)
                                                <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('type') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-5 col-form-label">Internal Type</label>
                                <div class="col-sm-6">
                                    <div class="wrap-input200">
                                        <input type="text" name="internal_type"
                                            class="input200 {{ $errors->has('internal_type') ? 'is-invalid' : '' }} form-control">
                                    </div>
                                    <p class="text-danger">{{ $errors->first('internal_type') }}</p>
                                    <p class="text-info">Internal Type can be liquidity, receivable, payable, other</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-5 col-form-label">Internal Group</label>
                                <div class="col-sm-6">
                                    <div class="wrap-input200">
                                        <input type="text" name="internal_group"
                                            class="input200 {{ $errors->has('internal_group') ? 'is-invalid' : '' }} form-control">
                                    </div>
                                    <p class="text-danger">{{ $errors->first('internal_group') }}</p>
                                    <p class="text-info">
                                        Internal groups can be assets, income, expenses, liabilities, equity
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-5 col-form-label">Currency</label>
                                <div class="col-sm-6">
                                    <div class="wrap-input200">
                                        <select name="currency_id" id="currency_id" style="border:none"
                                            class="input200 {{ $errors->has('currency_id') ? 'is-invalid' : '' }} form-select"
                                            data-control="select2" data-placeholder="Select Currency">
                                            <option value=""></option>
                                            @foreach ($currency as $row)
                                                <option value="{{ $row->id }}">{{ ucfirst($row->currency_name) }}
                                                    ({{ ucfirst($row->symbol) }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('currency_id') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-5 col-form-label">Company</label>
                                <div class="col-sm-6">
                                    <div class="wrap-input200">
                                        <select name="company_id" id="company_id" style="border:none"
                                            class="input200 {{ $errors->has('company_id') ? 'is-invalid' : '' }} form-select"
                                            data-control="select2" data-placeholder="Select Company">
                                            <option value=""></option>
                                            @foreach ($company as $row)
                                                <option value="{{ $row->id }}">{{ ucfirst($row->company_name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('company_id') }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5">Allow Reconciliation</label>
                                <div class="col-sm-6">
                                    <input class="form-check-input" type="checkbox" id="reconcile" name="reconcile"
                                        value="1">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5">Deprecated</label>
                                <div class="col-sm-6">
                                    <input class="form-check-input" type="checkbox" id="deprecated" name="deprecated"
                                        value="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
