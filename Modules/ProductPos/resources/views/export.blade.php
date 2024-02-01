<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Product</th>
            <th>Code</th>
            <th>Category</th>
            <th>Description</th>
            <th>Unit Price Purchase</th>
            <th>Unit Price Sell</th>
            <th>Stock Last</th>
            <th>Stock Min </th>
            <th>Stock Max</th>
            <th>Expired Date </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($product as $product)
            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{ $product?->name }}</td>
                <td>{{ $product?->code_product }}</td>
                <td>{{ $product?->category_product?->name }}</td>
                <td>{{ $product?->description }}</td>
                <td>{{ $product?->price_purchase }}</td>
                <td>{{ $product?->price_sell }}</td>
                <td>{{ $product?->stock_last }}</td>
                <td>{{ $product?->stock_min }}</td>
                <td>{{ $product?->stock_max }}</td>
                <td>{{ empty($product->date_expired) ? '-' : \Carbon\Carbon::parse($product->date_expired)->translatedFormat('d F Y') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
