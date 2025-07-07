<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Excel</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Ph</th>
                <th>Tds</th>
                <th>Turbidity</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->ph }}</td>
                    <td>{{ $item->tds }}</td>
                    <td>{{ $item->turbidity }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
