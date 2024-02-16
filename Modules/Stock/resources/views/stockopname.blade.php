<table class="table table-hover" id="tableopname">

    <thead>
        <tr>
            <th colspan="10">Report Stock Opname </th>
        </tr>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Code</th>
            <th>Product</th>
            <th>Unit</th>
            <th>Before </th>
            <th>After </th>
            <th>Difference </th>
            <th>Warehouse </th>
            <th>Location </th>
            <th> Note </th>
        </tr>
    </thead>
    <tbody>
        @forelse($report as $reports)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($reports->date_opname)->format('Y-m-d') }}</td>
                <td>{{ $reports->products?->code_product }}</td>
                <td>{{ $reports->products?->name }}</td>
                <td>{{ $reports->units?->name }}</td>
                <td>{{ $reports?->stock_before }}</td>
                <td>{{ $reports?->stock_after }}</td>
                <td>{{ $reports?->difference }}</td>
                <td>{{ $reports->warehouse?->name }}</td>
                <td>{{ $reports->location?->name_location }}</td>
                <td>{{ $reports?->note }}</td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
