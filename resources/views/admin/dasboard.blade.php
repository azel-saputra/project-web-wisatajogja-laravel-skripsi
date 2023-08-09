<!doctype html>
<html lang="en">
  <style>
    table td{
      height: 120px;

    }
    body{margin-top:20px;}				              


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

.container{
    margin-top: 20px;
}

.counter-box {
	display: block;
	background: #f6f6f6;
	padding: 40px 20px 37px;
	text-align: center
    
}

.counter-box p {
	margin: 5px 0 0;
	padding: 0;
	color: #909090;
	font-size: 18px;
	font-weight: 500
}

.counter-box i {
	font-size: 60px;
	margin: 0 0 15px;
	color: #d2d2d2
}

.counter { 
	display: block;
	font-size: 32px;
	font-weight: 700;
	color: #666;
	line-height: 28px
}

.counter-box.colored {
      background: #3acf87;
}

.counter-box.colored p,
.counter-box.colored i,
.counter-box.colored .counter {
	color: #fff
}
  
  </style>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body class="bg-light" onload="initMap()">

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
          <img src="image/logo_aplikasi.png" class="rounded-circle mx-auto d-block mt-3" style="width: 100px">
            <h3 class="mb-4 mt-4" style="text-align: center ">@if(Auth::check())
                <p>Hallo, {{ Auth::user()->name }}</p>
             @endif
            </h3>
            <a class=" h5 list-group-item list-group-item-action list-group-item-light p-3 border " href="{{route('dasboard')}}" style="text-align: center">Dashboard</a>
            <a class=" h5 list-group-item list-group-item-action list-group-item-light p-3 border " href="{{route('dataWisata')}}" style="text-align: center">Data Wisata</a>
            <a class=" h5 list-group-item list-group-item-action list-group-item-light p-3 border " href="{{route('dataKategori')}}" style="text-align: center">Data Kategori</a>
            <a class=" h5 list-group-item list-group-item-action list-group-item-light p-3 border " href="{{route('dataFasilitas')}}" style="text-align: center">Data Fasilitas</a>           

            {{-- <a class=" h5 list-group-item list-group-item-action list-group-item-light p-3 border" href="{{route('logout')}}" style="text-align: center">Logout</a> --}}
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
        <h3 class="mb-4 mt-4" style="text-align: left ">Dashboard</h3>

        @if (session('status'))
        <div class="alert alert-success">
          {{session('status')}}

        </div>

        @endif

        <!-- START DATA -->
          
        <div class="my-3 p-3 bg-body rounded shadow-sm ">            
            <div class="container ">
                <div class="row ">
                    <div class="d-flex justify-content-around">
                        <div class="four col-md-3">
                            <a class="dasboard" href="{{route('dataWisata')}}">
                                <div class="counter-box">
                                    <i class="fa"><img src="/image/database.png" style="width: 70px"></i>
                                    <span class="counter">{{$wisata}}</span>
                                    <p>Wisata</p>
                                </div>
                            </a>   
                        </div>
                        <div class="four col-md-3">
                            <a class="dasboard" href="{{route('dataKategori')}}">
                                <div class="counter-box">
                                    <i class="fa"><img src="/image/categories.png" style="width: 70px"></i>
                                    <span class="counter">{{$kategori}}</span>
                                    <p>Kategori</p>
                                </div>
                            </a>
                        </div>
                        <div class="four col-md-3">
                          <a class="dasboard" href="{{route('dataFasilitas')}}">
                              <div class="counter-box">
                                  <i class="fa"><img src="/image/fasilitas.png" style="width: 70px"></i>
                                  <span class="counter">{{$fasilitas}}</span>
                                  <p>Fasilitas</p>
                              </div>
                          </a>
                      </div>
                    </div>
              </div>	
            </div>

          </div>        
          <h3 class="mb-4 mt-4" style="text-align: left ">Maps Wisata</h3>
          <div class="mb-5" id="map" style="height: 500px;"></div>

        </div>


    </main>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADTnc37f6G1bFsUUoW0vN9H9wFF584K6M"></script>
    <script type="text/javascript">
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -7.795719, lng: 110.369438},
          zoom: 10
        });
    
        var locations = @json($location);
    
        // Loop melalui setiap lokasi dan tambahkan penanda ke peta
        locations.forEach(function (location) {
            var marker = new google.maps.Marker({
                position: { lat: parseFloat(location.latitude), lng: parseFloat(location.longitude) },
                map: map,
                title: location.nama_wisata // Ganti dengan atribut yang sesuai dari objek lokasi
            });

            // Tambahkan informasi (info window) jika diperlukan
            // Contoh: Ketika pengguna mengklik penanda, munculkan informasi lokasi
            var infoWindow = new google.maps.InfoWindow({
                content: location.nama_wisata // Ganti dengan informasi yang sesuai
            });

            marker.addListener('click', function () {
                infoWindow.open(map, marker);
            });
        });
      }
    
      initMap();
    </script>

    {{-- <script type="text/javascript">
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -7.795719, lng: 110.369438},
          zoom: 10
        });
    
        var markers = {!! json_encode($location) !!};
    
        for (var i = 0; i < markers.length; i++) {
          var marker = new google.maps.Marker({
            position: {lat: markers[1].latitude, lng: markers[1].longitude},
            map: map,
            title: markers[i].nama_wisata
          });
    
          var infowindow = new google.maps.InfoWindow({
            content: markers[i].nama_wisata
            
          });       
        
          infowindow.open(map, marker);

   
        }
      }
    
      initMap();
    </script> --}}
    
    
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADTnc37f6G1bFsUUoW0vN9H9wFF584K6M&callback=initMap" async defer></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    
    </script>

  </body>
</html>