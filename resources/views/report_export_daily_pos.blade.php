<table class="table align-middle table-row-dashed fs-6 gy-5">
    <thead>
        <tr>
            <td colspan="2">Daily Report</td>
        </tr>
        <tr>
            <td colspan="2">{{ $report['departement_default'] }}</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>Beginning Balance</td>
            <td>{{ $report['open_balance'] }}</td>
        </tr>
        <tr>
            <td>Income</td>
            <td>{{ $report['daily_income'] }}</td>
        </tr>
        <tr>
            <td>Sales</td>
            <td>{{ $report['daily_sales'] }}</td>
        </tr>
        <tr>
            <td>Purchase</td>
            <td>{{ $report['daily_purchase'] }}</td>
        </tr>
        <tr>
            <td>Expense</td>
            <td>{{ $report['daily_expense'] }}</td>
        </tr>
        <tr>
            <td>Ending Balance</td>
            <td>{{ $report['close_balance'] }}</td>
        </tr>
    </tbody>
</table>
