@extends('expense::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Edit {{ Str::title($expense->name) }}
            </div>
            <div class="float-end">
                <a href="{{ route('expense.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('expense.update', $expense->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control " id="name" name="name_input" required
                            placeholder="Insert Name " value="{{ $expense->name }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection