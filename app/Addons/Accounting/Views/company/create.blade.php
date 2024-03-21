@extends('template')
@push('menu-tops')
    @include('top_menu')
@endpush
@section('content')
    <div class="card">
        <form name="form-create" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header mt-3">
                <div class="float-start">
                    Create Company
                </div>
                <div class="float-end">

                </div>
            </div>
            <div class="card-body">
                <div class="py-5">
                    <div class="row">
                        <div class="col-12 col-md-10 mt-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="oe_title">
                                        <label class="o_form_label oe_edit_only">Company Name</label>
                                        <h1>
                                            <div
                                                class="o_field_partner_autocomplete dropdown open o_field_widget o_required_modifier">
                                                <input class="o_input form-control" placeholder="" type="text"
                                                    id="company_name" name="company_name" required>
                                            </div>
                                        </h1>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mt-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file bg-primary text-white">
                                                    Browse… <input type="file" id="imgInp" name="photo">
                                                </span>
                                            </span>
                                        </div>
                                    </div>
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
                                                                value="{{ old('street') }}" placeholder="Street..."
                                                                type="text" id="street">
                                                        </div>
                                                        <div class="wrap-input200 mb-3">
                                                            <input class="input200 form-control"
                                                                value="{{ old('street2') }}" name="street2"
                                                                placeholder="Street 2..." type="text" id="street2">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="wrap-input200 mb-3">
                                                                    <input class="input200 form-control"
                                                                        value="{{ old('city') }}" name="city"
                                                                        placeholder="City..." type="text" id="city">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="wrap-input200 mb-3">
                                                                    <input class="input200 form-control"
                                                                        value="{{ old('zip') }}" name="zip"
                                                                        placeholder="ZIP" type="text" id="zip">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="wrap-input200 mb-3">
                                                            <select id="country" name="country_id"
                                                                class="input200 form-control" style="border:none;">
                                                                <option value="">country</option>
                                                            </select>
                                                        </div>
                                                        <div class="wrap-input200 mb-3">
                                                            <select id="state" name="state_id" class="input200"
                                                                style="border:none;">
                                                                <option value="">State</option>
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
                                                        <input class="input200 form-control" value="{{ old('Phone') }}"
                                                            name="Phone" type="text" id="Phone">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label">Email</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control" value="{{ old('email') }}"
                                                            name="email" type="Email" id="email">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label">Website</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control" value="{{ old('website') }}"
                                                            name="website" placeholder="e.g. https://www.mycompany.com"
                                                            type="text" id="website">
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
                                                        <input class="input200 form-control" value="{{ old('vat') }}"
                                                            name="vat" type="text" id="vat">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label ">Company Registry</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <input class="input200 form-control"
                                                            value="{{ old('company_registry') }}" name="company_registry"
                                                            type="text" id="company_registry">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label class="o_form_label o_required_modifier">Currency</label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <select class="form-select form-select-white"
                                                            data-control="select2" id="exampleInpuCurrency"
                                                            data-placeholder="Select currency" required
                                                            name="currency_id">
                                                            <option></option>
                                                            @forelse($res_currency as $item)
                                                                <option value="{{ $item->id }}">
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
                                                <td class="o_td_label"><label class="o_form_label o_invisible_modifier"
                                                        for="o_field_input_542">Parent Company</label></td>
                                                <td style="width: 100%;">
                                                    <div class="o_field_widget o_field_many2one o_invisible_modifier"
                                                        aria-atomic="true" name="parent_id">
                                                        <div class="o_input_dropdown">
                                                            <input type="text" class="o_input ui-autocomplete-input"
                                                                autocomplete="off" id="o_field_input_542">
                                                            <a role="button" class="o_dropdown_button"
                                                                draggable="false"></a>
                                                        </div>
                                                        <button type="button"
                                                            class="fa fa-external-link btn btn-secondary o_external_button"
                                                            tabindex="-1" draggable="false" aria-label="External link"
                                                            title="External link" style="display: none;"></button>
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
                                                            value="{{ old('social_twitter') }}" name="social_twitter"
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
                                                            value="{{ old('social_facebook') }}" name="social_facebook"
                                                            type="text" id="social_facebook">
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
                                                            value="{{ old('social_instagram') }}" name="social_instagram"
                                                            type="text" id="social_instagram">
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
                                                            value="{{ old('social_youtube') }}" name="social_youtube"
                                                            type="text" id="social_youtube">
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
                                                            value="{{ old('social_linkedin') }}" name="social_linkedin"
                                                            type="text" id="social_linkedin">
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
                                                            value="{{ old('social_github') }}" name="social_github"
                                                            type="text" id="social_github">
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
