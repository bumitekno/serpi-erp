<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Sample</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .container {
            display: block;
            width: 100%;
            background: #fff;
            max-width: 350px;
            padding: 25px;
            margin: 50px auto 0;
            box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
        }

        .receipt_header {
            padding-bottom: 40px;
            border-bottom: 1px dashed #000;
            text-align: center;
        }

        .receipt_header h1 {
            font-size: 20px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .receipt_header h1 span {
            display: block;
            font-size: 25px;
        }

        .receipt_header h2 {
            font-size: 14px;
            color: #727070;
            font-weight: 300;
        }

        .receipt_header h2 span {
            display: block;
        }

        .receipt_body {
            margin-top: 25px;
        }

        table {
            width: 100%;
        }

        thead,
        tfoot {
            position: relative;
        }

        thead th:not(:last-child) {
            text-align: left;
        }

        thead th:last-child {
            text-align: right;
        }

        thead::after {
            content: '';
            width: 100%;
            border-bottom: 1px dashed #000;
            display: block;
            position: absolute;
        }

        tbody td:not(:last-child),
        tfoot td:not(:last-child) {
            text-align: left;
        }

        tbody td:last-child,
        tfoot td:last-child {
            text-align: right;
        }

        tbody tr:first-child td {
            padding-top: 15px;
        }

        tbody tr:last-child td {
            padding-bottom: 15px;
        }

        tfoot tr:first-child td {
            padding-top: 15px;
        }

        tfoot::before {
            content: '';
            width: 100%;
            border-top: 1px dashed #000;
            display: block;
            position: absolute;
        }

        tfoot tr:first-child td:first-child,
        tfoot tr:first-child td:last-child {
            font-weight: bold;
            font-size: 20px;
        }

        .date_time_con,
        .payment {
            display: flex;
            justify-content: center;
            column-gap: 25px;
        }

        .payment,
        .hr {
            border-bottom: 1px dashed #000;
            padding-top: 5px;
        }

        .items {
            margin-top: 25px;
        }

        h3 {
            border-top: 1px dashed #000;
            padding-top: 10px;
            margin-top: 25px;
            text-align: center;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="receipt_header">
            @if (!empty($transaction->departement->image))
                <img alt="Logo" src="{{ Storage::url($transaction->departement->image) }}">
            @else
                <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/code-lab.svg') }}">
            @endif

            <h1>{{ Str::title($transaction->departement?->name) }}</h1>
            <h2>Address: {{ $transaction->departement?->address }} <span>Tel:
                    {{ $transaction->departement?->contact }}</span> <span>Email:
                    {{ $transaction->departement?->email }}</span></h2>
        </div>

        <div class="receipt_body">

            <div>{{ Str::title($transaction->customer?->name) }}</div>
            <div>{{ $transaction->customer?->address }}</div>
            <div>{{ $transaction->customer?->contact }}</div>
            <div>{{ $transaction->customer?->email }}</div>
            <div class="hr"></div>
            <br>
            <div>Invoice {{ $transaction->code_transaction }}</div>
            <div>Note {{ $transaction?->note }}</div>
            <br>
            <div class="payment">
                <div>Payment {{ $transaction->methodpayment?->name }}</div>
                <div>Status {{ $transaction->status == 1 ? 'Paid' : 'Pending ' }}</div>
                <div>Operator {{ $transaction->operator?->name }}</div>
            </div>
            <br>
            <div class="date_time_con">
                <div class="date">
                    Date
                    {{ empty($transaction->date_sales) ? '-' : \Carbon\Carbon::parse($transaction->date_sales)->format('d/m/Y') }}
                </div>
                <div class="time">
                    Time
                    {{ empty($transaction->time_sales) ? '-' : \Carbon\Carbon::parse($transaction->time_sales)->translatedFormat('H:i:s') }}
                </div>
                <div class="date">
                    Due
                    {{ empty($transaction->date_due) ? '-' : \Carbon\Carbon::parse($transaction->date_due)->format('d/m/Y') }}
                </div>
            </div>

            <div class="items">
                <table>

                    <thead>
                        <th>Name Item </th>
                        <th>Qty Item </th>
                        <th>Unit Item </th>
                        <th>Price Unit </th>
                        <th>Amount</th>
                    </thead>

                    <tbody>
                        @php
                            $subtotal = 0;
                        @endphp
                        @forelse($detail_transaction as $details)
                            <tr>
                                <td>{{ $details->products?->code_product }} {{ $details->products?->name }}</td>
                                <td>{{ $details->qty }}</td>
                                @if ($details->check_convert == false)
                                    <td>{{ $details->units?->name }}</td>
                                @else
                                    <td>{{ $details->units?->name }}
                                        {{ $details->qty_convert > 1 ? ' ( fill:' . $details->qty_convert . ')' : '' }}
                                    </td>
                                @endif
                                <td>{{ empty($details->price_sales) ? 0 : number_format($details->price_sales, 0, ',', '.') }}
                                </td>
                                @if ($details->check_convert == false)
                                    <td>
                                        {{ empty($details->price_sales) ? 0 : number_format($details->price_sales * $details->qty, 0, ',', '.') }}
                                    </td>
                                @else
                                    <td>
                                        {{ empty($details->price_sales) ? 0 : number_format($details->price_sales * $details->qty_convert, 0, ',', '.') }}
                                    </td>
                                @endif
                            </tr>
                            @php
                                if ($details->check_convert == false) {
                                    $subtotal += $details->price_sales * $details->qty;
                                } else {
                                    $subtotal += $details->price_sales * $details->qty_convert;
                                }

                            @endphp
                        @empty
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td>Subtotal</td>
                            <td>{{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>Discount</td>
                            <td> {{ empty($transaction->discount_amount) ? 0 : number_format($transaction->discount_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>Tax</td>
                            <td> {{ empty($transaction->tax_amount) ? 0 : number_format($transaction->tax_amount, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>Total</td>
                            <td> {{ empty($transaction->total_transaction) ? 0 : number_format($transaction->total_transaction, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>Nominal</td>
                            <td> {{ empty($transaction->amount) ? 0 : number_format($transaction->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>Changes</td>
                            <td>
                                @php
                                    $charge = $transaction->amount - $transaction->total_transaction;
                                    if ($charge < 0) {
                                        $charge = 0;
                                    }
                                @endphp
                                {{ number_format($charge, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>

                </table>
            </div>

        </div>


        <h3>Thank You!</h3>

    </div>

    <script>
        window.onload = function() {
            self.print();
        }

        var afterPrint = function() {
            @if ($route == 'new')
                window.location.href = "{{ route('sales.create') }}";
            @else
                window.location.href = "{{ route('sales.show', $transaction->id) }}";
            @endif
        };

        var beforeprint = function() {

        }

        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');
            mediaQueryList.addListener(function(mql) {
                if (mql.matches) {
                    beforeprint();
                } else {
                    afterPrint();
                }
            });
        }
        window.beforeprint = beforeprint;
        window.onafterprint = afterPrint;
    </script>

</body>

</html>
