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
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="exampleInpuCompany" class="form-label">Company Name</label>
                                <input type="text" name="company_name" class="form-control" id="exampleInpuCompany"
                                    aria-describedby="companyHelp" required>
                                <div id="companyHelp" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputTel" class="form-label">Phone</label>
                                <input type="tel" name="phpne" class="form-control" id="exampleInputTel"
                                    aria-describedby="phonelHelp">
                                <div id="phonelHelp" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputAddress" class="form-label">Address</label>
                                <textarea name="address" class="form-control" id="exampleInputAddress" aria-describedby="addressHelp"></textarea>
                                <div id="addressHelp" class="form-text"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">

                                <!--begin::Image input-->
                                <div class="image-input image-input-empty" data-kt-image-input="true"
                                    style="background-image: url({{ asset('assets/media/avatars/blank.png') }})">
                                    <!--begin::Image preview wrapper-->
                                    <div class="image-input-wrapper w-125px h-125px"></div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                        title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                        title="Cancel avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                        title="Remove avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Remove button-->
                                </div>
                                <!--end::Image input-->
                            </div>
                            <div class="mb-3">
                                <label for="exampleInpuCurrency" class="form-label">Currency</label>
                                <select class="form-select form-select-white" data-control="select2"
                                    id="exampleInpuCurrency" data-placeholder="Select an option" required>
                                    <option></option>
                                    @forelse($res_currency as $item)
                                        <option value="{{ $item->id }}"> {{ $item->currency_name }} (
                                            {{ $item->symbol }} )
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
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
