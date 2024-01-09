@extends('productpos::layouts.master')

@section('content')
    <div class="card">
        <div class="card-header mt-3">Product List</div>
        <div class="card-body">
            @can('create-product')
                <a href="{{ route('productpos.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
                    Add
                    New Product</a>
            @endcan
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code Product </th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $product->code_product }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>


                                <a href="{{ route('productpos.show', $product->id) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-eye"></i> Show</a>

                                @can('edit-product')
                                    <a href="{{ route('productpos.edit', $product->id) }}" class="btn btn-primary btn-sm"><i
                                            class="bi bi-pencil-square"></i> Edit</a>
                                @endcan

                                @can('delete-product')
                                    <form action="{{ route('productpos.destroy', $product->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Do you want to delete this product?');"><i
                                                class="bi bi-trash"></i> Delete</button>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                    @empty
                        <td colspan="4">
                            <span class="text-danger">
                                <strong>No Product Found!</strong>
                            </span>
                        </td>
                    @endforelse
                </tbody>
            </table>

            {{ $products->links() }}

        </div>
    </div>
@endsection
