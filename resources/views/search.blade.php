<!doctype html>
<html lang="en">
<head>
    <title>Dashboard Analytic - Manajemen Karyawan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div>
    <p>Cari Data Pegawai :</p>
    <form action="/pegawai" method="GET">
        <input type="text" name="search" placeholder="Search by Nama, No. Badge, atau Nama Anggota Keluarga.." value="{{ old('search') }}">
        <input type="submit" value="search">
    </form>
</div>
<div>
    @if($results)
        @foreach($results as $result)
            <p>
                {{$result['NAMA']}}
                {{$result['NO_BADGE']}}
                {{$result['UNIT_KERJA']}}
            </p>
        @endforeach
    @endif
</div>

</body>
</html>
