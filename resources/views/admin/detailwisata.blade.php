<html lang="en">
  <head>
    <style>
      .li .a:hover{
        background-color: #FCC;
      }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Data Wisata</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
   
  
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

  .image-container {
  display: flex;
  flex-wrap: nowrap; /* Agar gambar berjejer dalam satu baris */
  overflow-x: auto; /* Agar gambar yang melebihi lebar container dapat digeser */
  width: 100%;
  gap: 10px; /* Jarak antar gambar */
  padding: 10px 0;
}

/* Sesuaikan ukuran gambar dengan lebar yang diinginkan */
.image-item img {
  width: 450px;
  height: 250px;
}

    </style>
  </head>
  <body>
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
        <h3 class="mb-4 mt-4" style="text-align: center ">
          @if(Auth::check())
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
    <div class="container mt-3">
      <div class="row justify-content-center">
        <div class="col-15">
          <div class="card">
            <div class="card-body">
              <form action="/wisata/{{ $data->id_wisata }}" method="GET"  enctype="multipart/form-data">
                @csrf
                @method('GET')
                <table class="table table-borderless">
                    <thead >
                          <tr>
                            <h2 class="mt-2 mb-3">Data Wisata {{$data->nama_wisata}} </h2>                 
                        </tr>
                 
                        <tr>
                            <th class="col-md-1">Nama Wisata</th>
                            <td>{{$data->nama_wisata}}</td>
                        </tr>
                        <tr>
                            <th class="col-md-1">Alamat</th>
                            <td>{{$data->alamat}}</td>

                        </tr>
                        <tr>
                            <th class="col-sm-2 col-form-label align-baseline">Sejarah</th>
                            <td><textarea type="text" name="sejarah" class="form-control" readonly="readonly" style="height:auto; min-height:100px">{{ $data->sejarah }}</textarea>  </td>
                        </tr>
                        {{-- <tr>
                          <th class="col-md-1">Rating</th>
                          <td>{{$data->totalRating->average}}</td>
                        </tr> --}}
                        <tr>
                          <th class="col-md-1">HTM</th>
                          <td>{{$data->harga}}</td>
                        </tr>
                        <tr>
                          <th class="col-md-1">JAM</th>
                          <td>{{$data->jam_buka}} - {{$data->jam_tutup}}</td>
                        </tr>
                        <tr>
                            <th class="col-md-1">Kategori</th>
                            <td>{{$data->kategori->nama_kategori}}</td>
                        </tr>                
                        <tr>
                            <th class="col-md-1">Fasilitas</th>
                            <td>{{$data->fasilitas}}</td>
                        </tr>
                        
                      
                        <tr>
                            <th class="col-md-1" style="vertical-align: top;">Lat/Lng</th>
                            <td>{{$data->latitude}}, {{$data->longitude}}</td>

                        </tr>
                        <tr>
                          <th></th>
                          <td id="map" style="height:400px; width: 800px;" class="my-3"></td>

                        </tr>
                        
                        <div class="image-container">
                          @foreach(explode(', ', $data->gambar) as $gambarPath)
                            <div class="image-item">
                              <img src="{{ asset($gambarPath) }}" alt="Gambar Wisata" style="width: 400px">
                            </div>
                          @endforeach
                        </div>
                    
                        </tr>
                    </thead>
              </form>
            </div>
        </div>
        </div>
      </div>
    </div>


    <script>
    
      function initMap() {
          // Membuat objek peta baru
          var longitude = <?php echo $data->longitude ?>; 
          var latitude = <?php echo $data->latitude ?>; 

          var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: latitude, lng: longitude}, 
              zoom: 12 // Zoom level
          });
  
          // Membuat marker
          var marker = new google.maps.Marker({
              position: {lat: latitude, lng: longitude},
              map: map,
              draggable: false // Menjadikan marker dapat di-drag
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
   
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> --}}
</body>
</html>