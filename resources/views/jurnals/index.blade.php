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
    <h1 class="text-center">Jurnal</h1>
    <div>
        @if (session()->has('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div>
        @if (count($jurnals) == 0)
            <h4>Data jurnal anda masih kosong.</h4>
        @endif

        <div class="text-center">
            <a href="{{ route('jurnal.create') }}">+ Create a Jurnal</a>
            <br>
            <br>
        </div>
        <div class="d-flex justify-content-center">
            <table class="table table-bordered" style="width: 95%">
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Abstrak</th>
                    <th>Edit</th>
                </tr>
                @foreach ($jurnals as $jurnal)
                    <tr>
                        <td>{{ $jurnal->id }}</td>
                        <td>{{ $jurnal->judul }}</td>
                        <td>{{ $jurnal->abstrak }}</td>
                        <td>
                            <a href="{{ route('jurnal.edit', ['jurnal' => $jurnal]) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>
