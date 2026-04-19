<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>SMBSM</title>
</head>

<body>
    <h1 class="text-center">Skripsi</h1>
    <div>
        @if (session()->has('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div>
        @if (count($skripsis) == 0)
            <h4>Data skripsi anda masih kosong.</h4>
            <div>
                <a href="{{ route('skripsi.create') }}">Create a Skripsi</a>
            </div>
        @endif
        <div class="d-flex justify-content-center">

            @foreach ($skripsis as $skripsi)
                <table class="table table-bordered" style="width: 90%">
                    <tr>
                        <th>Judul</th>
                        <th>Abstrak</th>
                        <th>Edit</th>
                    </tr>
                    <tr>
                        <td>{{ $skripsi->judul }}</td>
                        <td>{{ $skripsi->abstrak }}</td>
                        <td>
                            <a href="{{ route('skripsi.edit', ['skripsi' => $skripsi]) }}">Edit</a>
                        </td>
                    </tr>
                </table>
            @endforeach

        </div>
    </div>
    <h1 class="text-center">Rekomendasi Jurnal</h1>
    <div class="d-flex justify-content-center">
        <table class="table table-bordered" style="width: 90%">
            <tr>
                <th style="width: 20px">No.</th>
                <th>Judul</th>
                <th style="width: 200px">Kemiripan</th>
            </tr>
            @foreach ($data_jurnal as $jurnal)
                <tr>
                    <td>{{ $jurnal[0] }}</td>
                    <td>{{ $jurnal[1] }}</td>
                    <td>{{ $jurnal[2] }}%</td>
                </tr>
            @endforeach
        </table>
    </div>

    <h1 class="text-center">Rekomendasi Keyword</h1>
    <div class="d-flex justify-content-center">
        <table class="table table-bordered w-75">
            <tr>
                <th width="3%">No.</th>
                <th>Keyword</th>
            </tr>
            @php
                $i = 1;
            @endphp
            @foreach ($data_keyword as $keyword)
                <tr>

                    <td>{{ $i++ }}</td>
                    <td>{{ $keyword }}</td>
                </tr>
            @endforeach
        </table>
    </div>

</body>

</html>
