<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Product</th>
            <th>Code</th>
            <th>Category</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($product as $product)
            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->code_product }}</td>
                <td>{{ $product->category_product?->name }}</td>
                <td>{{ $product->description }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
