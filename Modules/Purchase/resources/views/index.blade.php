@extends('purchase::layouts.master')
@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Purchase Order
            </div>
            <div class="float-end">
                @can('create-purchase')
                    <a href="{{ route('purchase.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
                        New Purchase </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> Code Transaction </th>
                            <th> Date Transaction</th>
                            <th> Time Transaction </th>
                            <th> Amount</th>
                            <th> Supplier </th>
                            <th> Departement </th>
                            <th> Note </th>
                            <th> Method Payment </th>
                            <th> Due Date </th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                        @forelse ($transaction as $transaction)
                        @empty
                            <td colspan="11">
                                <span class="text-danger text-center">
                                    <strong>No Purchase Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ empty($transaction->links) ? '' : $transaction->links }}
        </div>
    </div>
@endsection
