<!doctype html>
<html lang="en">
 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Wisata</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">


  </head>
      <style>
        table td{
          height: 120px;
    
        }
    
        a:link {
        text-decoration: none;
    
    }
    a:link:hover{
      text-decoration: none;
    }
    
    a:visited{
      color: black
    }
    
    a:visited:hover{
      color: black
    } 
      </style>
</head>
  <body class="bg-light">

    <!--navbar-->
    <nav class="navbar navbar-inverse bg-dark">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand text-light"  href="#">Dashboard</a>
        </div>
      </div>
    </nav>

    <!--sidebar-->
    <div class="d-flex" id="wrapper">
        <div class="border-end bg-white" id="sidebar-wrapper " style="width: 200px">
            <img src="/image/logo_aplikasi.png" class="rounded-circle mx-auto d-block mt-3" style="width: 100px">
            <h3 class="mb-4 mt-4" style="text-align: center ">@if(Auth::check())
                <p>Hallo, {{ Auth::user()->name }}</p>
             @endif
            </h3>
            <a class=" h5 list-group-item list-group-item-action list-group-item-light p-3 border " href="{{route('dasboard')}}" style="text-align: center">Dashboard</a>

            <a class=" h5 list-group-item list-group-item-action list-group-item-light p-3 border " href="{{route('dataWisata')}}" style="text-align: center">Data Wisata</a>
            <a class=" h5 list-group-item list-group-item-action list-group-item-light p-3 border " href="{{route('dataKategori')}}" style="text-align: center">Data Kategori</a>           
            <a class=" h5 list-group-item list-group-item-action list-group-item-light p-3 border " href="{{route('dataFasilitas')}}" style="text-align: center">Data Fasilitas</a>           

            <div >
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
  
                    <a class=" h5 list-group-item list-group-item-action list-group-item-light p-3 border " style="text-align: center; color: red" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        <img src="/image/logout.png" style="width: 25px"> {{ __('Log Out') }}
                    </a>
                </form>
            </div>          
        </div>

    <main class="container">
    <!-- START FORM -->
    <form action='/wisata' method='post' enctype="multipart/form-data">
        @csrf
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div class="mb-3 row">
                    <h3 class="col-sm-3" style="text-align: left ">Input Data Wisata</h3>
                    <div class="col-sm-9 ">
                        <div class="col text-end"><a><button type="submit" class="btn btn-primary " name="submit"><img  src="/image/save.png" style="width: 25px" ></button></a></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama_wisata" class="col-sm-2 col-form-label fw-bold">Nama Wisata</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nama_wisata' id="nama_wisata" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label fw-bold">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='alamat' id="alamat" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sejarah" class="col-sm-2 col-form-label fw-bold" >Sejarah</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" name='sejarah' style="height: 150px" id="sejarah" required></textarea> 
                    </div>
                </div>
         
                <div class="mb-3 row">
                    <label for="harga" class="col-sm-2 col-form-label fw-bold">HTM</label>
                    <div class="input-group" style="width: 200px">
                        <input type="text" class="form-control" name='harga' id="harga" required>
                    </div>
                </div>
    
                <div class="row g-3 mb-3">
                    <label for="jam" class="col-sm-2 col-form-label fw-bold">Jam</label>
                    <div class="col-auto">
                        <label class="col-form-label">Buka :</label>
                    </div>
                    <div class="col-auto">
                        <input type="time" class="form-control" style="width: 150px" name='jam_buka' id="jam_buka"  >
                    </div>
                    <div class="col-auto">
                        <label class="col-form-label">Tutup :</label>
                    </div>
                    <div class="col-auto">
                        <input type="time" class="form-control" style="width: 150px" name='jam_tutup' id="jam_tutup" >
                    </div>
                </div>
                
                
        
                <div class="mb-3 row">
                    <label for="id_kategori" class="col-sm-2 col-form-label fw-bold">Kategori</label>
                    <div class="col-sm-10">
                        <select class="btn btn-secondary dropdown-toggle" style="width: 200px; background-color: transparent; color:black; text-align: left" name='id_kategori' id="id_kategori" data-toggle="dropdown" >
                            <option>Pilih kategori</option>
                            @foreach ($datak as $kategori)
                                <option class="form-control" style="width: 60px" value="{{$kategori->id_kategori}}">{{$kategori->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="mb-3 row">                
                    @php
                        $all_fasilitas = \App\Models\Fasilitas::orderBy('nama_fasilitas')->pluck('nama_fasilitas')->toArray();
                    @endphp
                    
                    <label for="fasilitas" class="col-sm-2 col-form-label fw-bold">Fasilitas</label>

                    <div class="col-sm-10">
                        @foreach($all_fasilitas as $array_fasilitas)
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="fasilitas[]" value="{{ $array_fasilitas }}" > {{ $array_fasilitas }}
                                </label>
                                
                            </div>
                        @endforeach
                    </div>
                </div>  
                
                <div class="mb-3 row">
                    <label for="gambar" class="col-sm-2 col-form-label fw-bold">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="gambar" name="gambar[]" multiple>

                        {{-- <input type="file" class="form-control" name='gambar' id="gambar" required> --}}
                    </div>
                </div>

                <div class="row">
                    <label for="lokasi" class="col-sm-2 col-form-label fw-bold">Lat/Lng</label>
                
                    <div class="col-2">
                        <input type="text" class="form-control" name="nama_lokasi" id="nama_lokasi" placeholder="Cari lokasi...">
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control"  style="width: 200px"  placeholder="lat" name="latitude" id="latitude">
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control"  style="width: 200px"  placeholder="lng" name="longitude" id="longitude">
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-primary" id="btn-cari-lokasi">Cari Lokasi</button>
                    </div>
                 
                </div>
                
                <div class="mb-3 row">
                    <label for="gambar" class="col-sm-2 col-form-label fw-bold"></label>

                    <div class="col-sm-10">

                        <div id="map" style="height:400px; width: 800px;" class="my-3"></div>
                    </div>
                </div>
            </form>
            </div>
            <!-- AKHIR FORM -->
        </main>
    </div>



    <script>
        const hargaInput = document.querySelector('#harga');
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        });
        hargaInput.addEventListener('input', function() {
            let harga = hargaInput.value;
            harga = harga.replace(/[^0-9]/g, ''); // hanya mengambil angka dari input
            if (harga === '') {
                hargaInput.value = '';
                return;
            } else{
                harga = parseInt(harga, 10); // mengubah string menjadi integer
                hargaInput.value = formatter.format(harga); // format nilai uang menjadi format rupiah
            }
        });
    </script>


    <script>
        function initMap() {
            // Membuat objek peta baru
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -7.795719, lng: 110.369438}, 
                zoom: 12 // Zoom level
            });
    
            // Membuat marker
            var marker = new google.maps.Marker({
                position: {lat: -7.795719, lng: 110.369438},
                map: map,
                draggable: true // Menjadikan marker dapat di-drag
            });
    
            // Mengambil koordinat ketika marker di-drag
            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById('latitude').value = this.getPosition().lat();
                document.getElementById('longitude').value = this.getPosition().lng();
            });
    
            // Menangani event klik pada button Cari Lokasi
            document.getElementById('btn-cari-lokasi').addEventListener('click', function() {
                var geocoder = new google.maps.Geocoder();
                var address = document.getElementById('nama_lokasi').value;
              

    
                // Melakukan geocoding untuk mencari koordinat lokasi
                geocoder.geocode({'address': address}, function(results, status) {
                    if (status === 'OK') {
                        var latlng = results[0].geometry.location;
                        marker.setPosition(latlng);
                        map.setCenter(latlng);
                        document.getElementById('latitude').value = latlng.lat();
                        document.getElementById('longitude').value = latlng.lng();
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            });
        }
    </script>
    

        
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADTnc37f6G1bFsUUoW0vN9H9wFF584K6M&callback=initMap" type="text/javascript"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>