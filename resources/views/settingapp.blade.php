@extends('template')
@section('content')
    <div class="card mb-3">
        <div class="card-header mt-3">
            <div class="float-start">
                <h3 class="text-dark">Setting Application </h3>
            </div>
            <div class="float-end">

            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('settings.settingStore') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_settings" value="{{ $settings?->id }}">
                <div class="mb-3 row">
                    <!--begin::Label-->
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Logo</label>
                    <!--end::Label-->
                    <div class="col-md-6">
                        <div class="image-input image-input-outline" data-kt-image-input="true"
                            style="background-image: url({{ asset('assets/media/svg/module.svg') }})">
                            <!--begin::Preview existing avatar-->
                            @if (!empty($settings->logo))
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url({{ Storage::url($settings->logo) }});">
                                </div>
                            @else
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url({{ asset('assets/media/svg/module.svg') }})">
                                </div>
                            @endif
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="avatar_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->

                        </div>
                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Image input-->
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ $settings?->title }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Keyword</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="keyword" name="keyword"
                            value="{{ $settings?->keywords }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                    <div class="col-md-6">
                        <textarea name="description" class="form-control">{{ $settings?->description }}</textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Footer</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="footer" name="footer"
                            value="{{ $settings?->footer }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <input type="submit" class=" btn btn-primary" value="Save">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="text-dark"> Tools Database </h3>
        </div>
        <div class="card-body">
            @if ($message = Session::get('info'))
                <div class="alert alert-info text-center" role="alert">
                    {!! $message !!}
                </div>
            @endif
            <a href="{{ route('settings.backupdatabase') }}" class="btn btn-info btn-sm mb-3"> <i
                    class="bi bi-cloud-arrow-down-fill"></i> Backup Now </a>

            <a href="{{ route('systems.reset_trans') }}" class="btn btn-danger btn-sm mb-3"
                onclick="return confirm('Are you sure to reset transaction ? ')"> <i class="bi bi-trash"></i> Reset
                Transaction </a>

            <a href="{{ route('systems.reset_datamaster') }}" class="btn btn-danger btn-sm mb-3"
                onclick="return confirm('Are you sure to reset data master ? ')"> <i class="bi bi-trash"></i> Reset Data
                Master </a>

            <form action="{{ route('settings.restoredatabase') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">File Restore </label>
                    <div class="col-md-6">
                        <input type="file" class="form-control" id="file" name="file" accept=".gz"
                            required>
                        <div class="form-text">Allowed file types: .gz</div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <input type="submit" class=" btn btn-primary" value="Save">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
