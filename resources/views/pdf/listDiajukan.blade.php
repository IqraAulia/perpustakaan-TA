<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku yang Diajukan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2A2F5B;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f7f7f7;
            color: #333;
        }
        td {
            background-color: #fff;
        }
        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h2>Daftar Buku yang Diajukan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listDiajukan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->judul_buku }}</td>
                    <td>{{ $item->pengarang }}</td>
                    <td>{{ $item->penerbit }}</td>
                    <td>{{ $item->tahun_terbit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
