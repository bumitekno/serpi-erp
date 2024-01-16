@extends('warehouse::layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Warehouse Information
                    </div>
                    <div class="float-end">
                        <a href="{{ route('warehouse.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class=" mb-3 row">
                        <label for="code"
                            class="col-md-4 col-form-label text-md-end text-start"><strong>Code:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ Str::title($warehouse->code) }}
                        </div>
                    </div>
                    <div class=" mb-3 row">
                        <label for="name"
                            class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ Str::title($warehouse->name) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
