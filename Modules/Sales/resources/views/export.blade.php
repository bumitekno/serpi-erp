<table class="table align-middle table-row-dashed fs-6 gy-5">
    <thead>
        <tr>
            <th>#</th>
            <th> Code </th>
            <th> Date</th>
            <th> Total</th>
            <th> Amount</th>
            <th> Customer </th>
            <th> Departement </th>
            <th> Method</th>
            <th> Status </th>
            <th> Due Date </th>
            <th> Notes </th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        @forelse ($transaction as $transactions)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ empty($transactions->code_transaction) ? '-' : $transactions->code_transaction }}
                </td>
                <td>{{ empty($transactions->date_sales) ? '-' : \Carbon\Carbon::parse($transactions->date_sales)->translatedFormat('d F Y') }}
                    {{ empty($transactions->time_sales) ? '-' : \Carbon\Carbon::parse($transactions->time_sales)->translatedFormat('H:i:s') }}
                </td>
                <td>{{ empty($transactions->total_transaction) ? 0 : number_format($transactions->total_transaction, 0, '.', ',') }}
                </td>
                <td>{{ empty($transactions->amount) ? 0 : number_format($transactions->amount, 0, '.', ',') }}
                </td>
                <td>{{ empty($transactions->customer) ? '-' : $transactions->customer?->name }}</td>
                <td>{{ empty($transactions->departement) ? '-' : $transactions->departement?->name }}
                </td>

                <td>{{ empty($transactions->methodpayment) ? '-' : $transactions->methodpayment?->name }}
                </td>
                @if ($transactions->status == 1)
                    <td>
                        <span class="badge badge-light-success">Paid</span>
                    </td>
                @else
                    @if ($transactions->note == 'cancel')
                        <td><span class="badge badge-light-danger">Cancel</span></td>
                    @else
                        <td><span class="badge badge-light-warning">Pending</span></td>
                    @endif
                @endif
                <td>{{ empty($transactions->date_due) ? '-' : \Carbon\Carbon::parse($transactions->date_due)->translatedFormat('d F Y') }}
                </td>
                <td>{{ $transactions?->note }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="13">
                    <span class="text-danger text-center">
                        <strong>No Sales Found!</strong>
                    </span>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
