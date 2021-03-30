<!doctype html>
<html lang="en">
<head>
    <title>Dashboard Analytic - Manajemen Karyawan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container mx-auto " style="float: top; width:100%; margin: 50px;" >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form class="form" action="/pegawai" method="GET" style="margin-right:20px;">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search by Nama, No. Badge, atau Nama Anggota Keluarga.." value="{{ old('search') }}" aria-label="Search" style="width:80%; border-color:grey;">
            <button class="fa fa-search" type="submit" value="search" style="color: grey; padding-right:30px;">Search</button>
        </form>
    </div>
</div>
<div class="py-2 grid grid-cols-2" style="float: left; width: 50%; display:inline;" >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="flex">
                <div class="flex-auto text-2xl mb-4">Hasil Pencarian</div>
            </div>
            @if($results ?? '')
                @foreach($results ?? '' as $result)
                    <div  style="cursor: pointer; border-radius:25px; margin-bottom:20px;" id="pegawai" class="bg-white w-78 h-60 rounded shadow-lg flex card text-grey-darkest">
                        <div class="w-full flex flex-row">
                            <div class="p-4 pb-0 flex-1">
                                <h3 class="font-light mb-1 text-grey-darkest" style="font-size: 20px; font-weight:500;">{{$result['NAMA']}}</h3>
                                <span class="text-grey-darkest" style="color: grey;font-weight:500; font-size:20px; ">{{$result['NO_BADGE']}}</span>
                                <div class="flex items-center mt-4">
                                    <div class="pr-2 text-xs text-grey" style="font-size: 18px; color:#29C583;">
                                        {{$result['UNIT_KERJA']}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
</body>
</html>
