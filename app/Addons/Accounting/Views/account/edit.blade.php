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
                    <p class="mb-0">Are you sure to delete this record ( {{ $account->name }} )</p>
                    <p class="mb-0">You won't be able to revert this!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="delete-form-{{ $account->id }}" action="{{ route('account.destroy', $account->id) }}"
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
    <div class="card">
        <form name="form-create" action="{{ route('account.update', $account->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header mt-3">
                <div class="float-start">
                    Edit Chart Of Account
                </div>
                <div class="float-end">
                    <a href="{{ route('account.index') }}" class="btn btn-dark me-2 ">Back </a>
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
            <div class="card-body">
                <div class="py-5">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <label class="col-sm-5 col-form-label">Code</label>
                                <div class="col-sm-6">
                                    <div class="wrap-input200">
                                        <input type="text" name="code" value="{{ $account->code }}" readonly
                                            class="input200 {{ $errors->has('code') ? 'is-invalid' : '' }} form-control form-control-solid"
                                            value="{{ old('code') }}">
                                    </div>
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-5 col-form-label">Name</label>
                                <div class="col-sm-6">
                                    <div class="wrap-input200">
                                        <input type="text" name="name" id="name" value="{{ $account->name }}"
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
                                            data-control="select2" data-placeholder="Select Currency">
                                            <option value=""></option>
                                            @foreach ($account_type as $row)
                                                <option value="{{ $row->id }}"
                                                    {{ $row->id == $account->type ? 'selected' : '' }}>
                                                    {{ ucfirst($row->name) }}</option>
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
                                        <input type="text" name="internal_type" value="{{ $account->internal_type }}"
                                            class="input200 {{ $errors->has('internal_type') ? 'is-invalid' : '' }} form-control">
                                    </div>
                                    <p class="text-danger">{{ $errors->first('internal_type') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-5 col-form-label">Internal Group</label>
                                <div class="col-sm-6">
                                    <div class="wrap-input200">
                                        <input type="text" name="internal_group"
                                            value="{{ $account->internal_group }}"
                                            class="input200 {{ $errors->has('internal_group') ? 'is-invalid' : '' }} form-control">
                                    </div>
                                    <p class="text-danger">{{ $errors->first('internal_group') }}</p>
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
                                                <option value="{{ $row->id }}"
                                                    {{ $row->id == $account->currency_id ? 'selected' : '' }}>
                                                    {{ ucfirst($row->currency_name) }}
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
                                                <option value="{{ $row->id }}"
                                                    {{ $row->id == $account->company_id ? 'selected' : '' }}>
                                                    {{ ucfirst($row->company_name) }}
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
                                        value="1" @if ($account->reconcile == '1') checked @endif>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-5">Deprecated</label>
                                <div class="col-sm-6">
                                    <input class="form-check-input" type="checkbox" id="deprecated" name="deprecated"
                                        value="1" @if ($account->deprecated == '1') checked @endif>
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
