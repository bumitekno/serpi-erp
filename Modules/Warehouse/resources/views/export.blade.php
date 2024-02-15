<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Warehouse </title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Warehouse</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($warehouse as $warehouses)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>{{ $warehouses->id }}</td>
                    <td>{{ $warehouses->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
