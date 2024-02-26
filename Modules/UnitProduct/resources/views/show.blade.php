@extends('unitproduct::layouts.master')
@push('menu-tops')
    @include('menu-top-pos')
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Unit Information
                    </div>
                    <div class="float-end">
                        <a href="{{ route('unitproduct.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class=" mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Name:</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ Str::title($unit->name) }} </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
