@extends('purchase::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Create Purchase Order
            </div>
            <div class="float-end">
                <a href="{{ route('purchase.index') }}" class="btn btn-success btn-sm my-2"><i
                        class="bi bi-plus-arrow-left"></i>
                    Back </a>
            </div>
        </div>
    </div>
@endsection
