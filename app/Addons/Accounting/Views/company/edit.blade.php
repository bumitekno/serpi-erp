@extends('template')
@push('menu-tops')
    @include('top_menu')
@endpush
@section('content')
    <div class="card">
        <form name="form-create" action="{{ route('account.company.update', $company->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-header mt-3">
                <div class="float-start">
                    Company
                </div>
                <div class="float-end">
                    <a href="{{ route('account.company') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="py-5">
                    <div class="row">
                        <div class="col-12 col-md-10 mt-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="oe_title">
                                        <label class="o_form_label oe_edit_only mb-3">Company Name</label>
                                        <h1>
                                            <div
                                                class="o_field_partner_autocomplete dropdown open o_field_widget o_required_modifier">
                                                <input class="o_input form-control" placeholder="" type="text"
                                                    id="company_name" name="company_name" required
                                                    value="{{ $company->company_name ?? '' }}">
                                            </div>
                                        </h1>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-empty" data-kt-image-input="true"
                                        style="background-image: url({{ asset('assets/media/avatars/blank.png') }})">
                                        <!--begin::Image preview wrapper-->
                                        @if (!empty($company->photo))
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-image: url({{ Storage::url($company->photo) }});">
                                            </div>
                                        @else
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-image: url({{ asset('assets/media/avatars/blank.png') }})">
                                            </div>
                                        @endif
                                        <!--end::Image preview wrapper-->

                                        <!--begin::Edit button-->
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            data-bs-dismiss="click" title="Change avatar">
                                            <i class="bi bi-pencil-fill fs-7"></i>

                                            <!--begin::Inputs-->
                                            <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="avatar_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit button-->

                                        <!--begin::Cancel button-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            data-bs-dismiss="click" title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel button-->

                                        <!--begin::Remove button-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            data-bs-dismiss="click" title="Remove avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Remove button-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">General Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">Sosial Media </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <table class="o_group o_inner_group table">
                                        <tbody>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label">Address</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="o_address_format">
                                                        <div class="wrap-input200 mb-3">
                                                            <input class="input200 form-control" name="street"
                                                                value="{{ $company->street ?? '' }}" placeholder="Street..."
                                                                type="text" id="street">
                                                        </div>
                                                        <div class="wrap-input200 mb-3">
                                                            <input class="input200 form-control"
                                                                value="{{ $company->street2 ?? '' }}" name="street2"
                                                                placeholder="Street 2..." type="text" id="street2">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="wrap-input200 mb-3">
                                                                    <input class="input200 form-control"
                                                                        value="{{ $company->city ?? '' }}" name="city"
                                                                        placeholder="City..." type="text" id="city">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="wrap-input200 mb-3">
                                                                    <input class="input200 form-control"
                                                                        value="{{ $company->zip }}" name="zip"
                                                                        placeholder="ZIP" type="text" id="zip">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="wrap-input200 mb-3">
                                                            <select id="country" name="country_id"
                                                                class="input200 form-control form-select"
                                                                style="border:none;" data-control="select2"
                                                                data-placeholder="Select country">
                                                                <option></option>
                                                                @forelse($res_country as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $company->country_id == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->country_name }}
                                                                    </option>
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                        <div class="wrap-input200 mb-3">
                                                            <select id="state" name="state_id"
                                                                class="input200 form-select" style="border:none;"
                                                                data-control="select2" data-placeholder="Select state">
                                                                <option></option>
                                                                @forelse($res_country_state as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $company->state_id == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->state_name }}
                                                                    </option>
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label">Phone</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control"
                                                            value="{{ $company->Phone ?? '' }}" name="Phone"
                                                            type="text" id="Phone">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label">Email</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control"
                                                            value="{{ $company->email ?? '' }}" name="email"
                                                            type="Email" id="email">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label">Website</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control"
                                                            value="{{ $company->website ?? '' }}" name="website"
                                                            placeholder="e.g. https://www.mycompany.com" type="text"
                                                            id="website">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 col-md-6">
                                    <table class="o_group o_inner_group table ">
                                        <tbody>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label">VAT</label>
                                                </td>
                                                <td>
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control"
                                                            value="{{ $company->vat ?? '' }}" name="vat"
                                                            type="text" id="vat">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label" style="width: 30%;">
                                                    <label class="o_form_label form-label ">Company Registry</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control"
                                                            value="{{ $company->company_registry ?? '' }}"
                                                            name="company_registry" type="text" id="company_registry">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label o_required_modifier">Currency</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <select class="form-select" data-control="select2"
                                                            id="exampleInpuCurrency" data-placeholder="Select currency"
                                                            required name="currency_id">
                                                            <option></option>
                                                            @forelse($res_currency as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $company->currency_id == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->currency_name }} (
                                                                    {{ $item->symbol }} )
                                                                </option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label o_required_modifier">Partner</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <select class="form-select" data-control="select2"
                                                            id="exampleInpupatner" data-placeholder="Select Partner"
                                                            name="parent_id">
                                                            <option></option>
                                                            @forelse($parent_company as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $company->parent_id == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->company_name }}
                                                                </option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <table class="o_group o_inner_group table">
                                        <tbody>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label form-label">Social Twitter</label>
                                                </td>
                                                <td>
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control"
                                                            value="{{ $company->social_twitter }}" name="social_twitter"
                                                            type="text" id="social_twitter">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label">Social Facebook</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control"
                                                            value="{{ $company->social_facebook ?? '' }}"
                                                            name="social_facebook" type="text" id="social_facebook">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label">Social Instagram</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control"
                                                            value="{{ $company->social_instagram ?? '' }}"
                                                            name="social_instagram" type="text" id="social_instagram">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label">Social Youtube</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control"
                                                            value="{{ $company->social_youtube ?? '' }}"
                                                            name="social_youtube" type="text" id="social_youtube">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label">Social Linkedin</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control"
                                                            value="{{ $company->social_linkedin ?? '' }}"
                                                            name="social_linkedin" type="text" id="social_linkedin">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label">Social Github</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control"
                                                            value="{{ $company->social_github ?? '' }}"
                                                            name="social_github" type="text" id="social_github">
                                                    </div>
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
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
