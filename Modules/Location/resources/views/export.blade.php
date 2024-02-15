<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Location </title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($location as $locations)
                <tr>
                    <td>{{ $loop->iteration }} </td>
                    <td>{{ $locations->id }}</td>
                    <td>{{ $locations->name_location }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
