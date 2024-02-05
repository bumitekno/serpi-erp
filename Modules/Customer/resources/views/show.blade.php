@extends('customer::layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header mt-3">
                    <div class="float-start">
                        Customer Information
                    </div>
                    <div class="float-end">
                        <a href="{{ route('customer.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="mb-3 row">
                        <label for="avatar" class="col-lg-4 fw-bold text-muted text-end"><strong>Image:</strong></label>
                        <div class="col-md-8">
                            <div class="symbol-label symbol symbol-circle symbol-150px">
                                @if (!empty($customer->image))
                                    <img src="{{ Storage::url($customer->image) }}" alt="Customer" class="w-100" />
                                @else
                                    <img src="https://fakeimg.pl/100x100" alt="Customer" class="w-100" />
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Name:</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $customer->name }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Contact
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $customer?->contact }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-lg-4 fw-bold text-muted text-end"><strong>Email
                                :</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $customer?->email }} </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="description"
                            class="col-lg-4 fw-bold text-muted text-end"><strong>Address:</strong></label>
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800"> {{ $customer?->address }} </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
