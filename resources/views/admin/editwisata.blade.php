<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <title>Ubah Data Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
      </div>      </div>
    <main class="container">
    <form action="/wisata/{{ $edit->id_wisata }} " method="POST"  enctype="multipart/form-data">
      @csrf
      @method('PUT')
          <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
              <h3 class="col-sm-3" style="text-align: left ">Update Data Wisata</h3>
              <div class="col-sm-9 ">
                  <div class="col text-end"><a><button type="submit" class="btn btn-primary " name="submit"><img  src="/image/save.png" style="width: 25px" ></button></a></div>
              </div>
          </div>
              <div class="mb-5 row">
               
                <div class="image-container">        
                  @foreach(explode(', ', $edit->gambar) as $gambarPath)
                    <div class="image-item">
                      <img src="{{ asset($gambarPath) }}" alt="Gambar Wisata" style="width: 400px">
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="mb-3 row">
                  <label for="nama_wisata" class="col-sm-2 col-form-label fw-bold" >Nama Wisata</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_wisata" class="form-control" value="{{ $edit->nama_wisata }}" required>
                  </div>
              </div>
              <div class="mb-3 row">
                  <label for="alamat" class="col-sm-2 col-form-label fw-bold">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" name="alamat" class="form-control" value="{{ $edit->alamat }}" required>
                  </div>
              </div>

              <div class="mb-3 row">
                  <label for="sejarah" class="col-sm-2 col-form-label fw-bold">Sejarah</label>
                  <div class="col-sm-10">
                    <textarea type="text" name="sejarah" class="form-control" required>{{ $edit->sejarah }}</textarea>
                  </div>
              </div>
     
              <div class="mb-3 row">
                  <label for="harga" class="col-sm-2 col-form-label fw-bold">HTM</label>
                  <div class="col-sm-10">
                    <input type="text" name="harga" class="form-control" style="width: 200px" value="{{ $edit->harga }}" required>
                  </div>
              </div>
            
              
            <div class="row g-3 mb-3">
              <label for="jam" class="col-sm-2 col-form-label fw-bold">Jam</label>
              <div class="col-auto">
                <label class="col-form-label">Buka :</label>
            </div>
              <div class="col-auto">
                <input type="time" name="jam_buka" class="form-control" style="width: 200px" value="{{ $edit->jam_buka }}" required>
              </div>
              <div class="col-auto">
                <label class="col-form-label">Tutup :</label>
            </div>
              <div class="col-auto">
                <input type="time" name="jam_tutup" class="form-control" style="width: 200px"  value="{{ $edit->jam_tutup }}" required>
              </div>
          </div>

              
              <div class="mb-3 row">
                  <label for="id_kategori" class="col-sm-2 col-form-label fw-bold">Kategori</label>
                  <div class="col-sm-10">
                    <select class="btn btn-secondary dropdown-toggle" style="width: 200px; background-color: transparent; color:black; text-align: left" name='id_kategori' id="id_kategori" data-toggle="dropdown" >
                      @foreach ($datak as $kategori)
                          <option class="form-control" style="width: 60px" value="{{$kategori->id_kategori}}" {{$edit->id_kategori == $kategori->id_kategori ? 'selected':''}}>{{$kategori->nama_kategori}}</option>
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
                              <input class="form-check-input" type="checkbox" name="fasilitas[]" value="{{ $array_fasilitas }}" {{ in_array($array_fasilitas, explode(', ', $edit->fasilitas)) ? 'checked' : '' }}> {{ $array_fasilitas }}
                          </label>
                      </div>
                  @endforeach
                </div>
              </div>
                

              <div class="mb-3 row">
                  <label for="gambar" class="col-sm-2 col-form-label fw-bold">Gambar</label>
                  <div class="col-sm-10">
                    <input type="file" name="gambar[]" id="gambar" class="form-control" multiple>

                      {{-- <input type="file" class="form-control" name='gambar' id="gambar"> --}}
                    
                  </div>
              </div>
                <div class="row g-3">
                  <label for="jam" class="col-sm-2 col-form-label fw-bold">Lat/Lng</label>
                  <div class="col-2">
                    <input type="text" class="form-control" name="nama_lokasi" id="nama_lokasi" placeholder="Cari lokasi...">
                </div>
                  <div class="col-auto">
                    <input type="text" name="latitude" id="latitude" class="form-control" style="width: 200px" value="{{ $edit->latitude }}" required>
                  </div>
                  <div class="col-auto">
                    <input type="text" name="longitude" id="longitude"class="form-control"  style="width: 200px"value="{{ $edit->longitude }}" required>
                  </div>
                  <div class="col-3">
                    <button type="button" class="btn btn-primary" id="btn-cari-lokasi">Cari Lokasi</button>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="map" class="col-sm-2 col-form-label fw-bold"></label>
                <div class="col-sm-10">
                  <div id="map" style="height:400px; width: 800px;" class="my-3"></div>

                </div>
            </div>

            <script>
              const hargaInput = document.querySelector('input[name="harga"]');
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
                  var longitude = <?php echo $edit->longitude ?? '110.369438' ?>; 
                  var latitude = <?php echo $edit->latitude ?? '-7.795719' ?>; 
    
                  var map = new google.maps.Map(document.getElementById('map'), {
                      center: {lat: latitude, lng: longitude}, 
                      zoom: 12 // Zoom level
                  });
          
                  // Membuat marker
                  var marker = new google.maps.Marker({
                      position: {lat: latitude, lng: longitude},
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
              
            </form>
            </div>
            <!-- AKHIR FORM -->
        </main>
        
    
        
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADTnc37f6G1bFsUUoW0vN9H9wFF584K6M&callback=initMap" type="text/javascript"></script>    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> --}}
</body>
</html>