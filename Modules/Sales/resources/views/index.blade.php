@extends('sales::layouts.master')

@section('content')
    <div class="card">
        <div class="card-header mt-3">
            <div class="float-start">
                Sales Order
            </div>
            <div class="float-end">
                @can('create-sales')
                    <a href="{{ route('sales.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
                        New Sales </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> Code </th>
                            <th> Date</th>
                            <th> Time </th>
                            <th> Total</th>
                            <th> Amount</th>
                            <th> Customer </th>
                            <th> Departement </th>
                            <th> Note </th>
                            <th> Method</th>
                            <th> Status </th>
                            <th> Due Date </th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                        @forelse ($transaction as $transactions)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ empty($transactions->code_transaction) ? '-' : $transactions->code_transaction }}
                                </td>
                                <td>{{ empty($transactions->date_sales) ? '-' : \Carbon\Carbon::parse($transactions->date_sales)->translatedFormat('d F Y') }}
                                </td>
                                <td>{{ empty($transactions->time_sales) ? '-' : \Carbon\Carbon::parse($transactions->time_sales)->translatedFormat('H:i:s') }}
                                </td>
                                <td>{{ empty($transactions->total_transaction) ? 0 : number_format($transactions->total_transaction, 0, ',', '.') }}
                                </td>
                                <td>{{ empty($transactions->amount) ? 0 : number_format($transactions->amount, 0, ',', '.') }}
                                </td>
                                <td>{{ empty($transactions->customer) ? '-' : $transactions->customer?->name }}</td>
                                <td>{{ empty($transactions->departement) ? '-' : $transactions->departement?->name }}</td>
                                <td>{{ empty($transactions->note) ? '-' : $transactions->note }}</td>
                                <td>{{ empty($transactions->methodpayment) ? '-' : $transactions->methodpayment?->name }}
                                </td>
                                <td>{{ $transactions->status == 1 ? 'Paid' : 'Pending ' }}</td>
                                <td>{{ empty($transactions->date_due) ? '-' : \Carbon\Carbon::parse($transactions->date_due)->translatedFormat('d F Y') }}
                                </td>
                                <td class="text-end ">
                                    <form action="{{ route('sales.destroy', $transactions->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="py-5">
                                            <a href="{{ route('sales.show', $transactions->id) }}"
                                                class="btn btn-default btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </a>

                                            @can('edit-sales')
                                                <a href="{{ route('sales.edit', $transactions->id) }}"
                                                    class="btn btn-default btn-warning btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-edit"></i>
                                                    </span>
                                                </a>
                                            @endcan

                                            @can('delete-sales')
                                                <button type="submit"
                                                    onclick ="return confirm('Do you want to cancel this Sales?')"
                                                    class="btn btn-default btn-danger btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </button>
                                            @endcan
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="13">
                                <span class="text-danger text-center">
                                    <strong>No Sales Found!</strong>
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
