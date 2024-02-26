@extends('warehouse::layouts.master')
@push('menu-tops')
    @include('menu-top-pos')
@endpush
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Edit Warehouse
            </div>
            <div class="float-end">
                <a href="{{ route('warehouse.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('warehouse.update', $warehouse->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Code</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                            name="code" value="{{ $warehouse->code }}">
                        @if ($errors->has('code'))
                            <span class="text-danger">{{ $errors->first('code') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ $warehouse->name }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Warehouse">
                </div>
            </form>
        </div>
    </div>
@endsection
