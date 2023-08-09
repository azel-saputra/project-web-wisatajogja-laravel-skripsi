<!doctype html>
<html lang="en">
 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
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
      <div class="border-end bg-white" id="sidebar-wrapper " style="width: 200px; height: 100vh">
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
            </div>          </div>

    <main class="container">

    <!-- START FORM -->
    <form action='/kategori' method='post' enctype="multipart/form-data">
        @csrf
            <div class="my-3 p-3 bg-body rounded shadow-sm">
              <div class="mb-3 row">
                <h3 class="col-sm-3" style="text-align: left ">Input Data Kategori</h3>
                <div class="col-sm-9 ">
                    <div class="col text-end"><a><button type="submit" class="btn btn-primary " name="submit"><img  src="/image/save.png" style="width: 25px" ></button></a></div>
                </div>
            </div>
                <div class="mb-3 row">
                    <label for="nama_kategori" class="col-sm-2 col-form-label fw-bold">Nama Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nama_kategori' id="nama_kategori" required>
                    </div>
                </div>
                <div class="mb-3 row">
                  <label for="gambar_kategori" class="col-sm-2 col-form-label fw-bold">Gambar</label>
                  <div class="col-sm-10">
                      <input type="file" class="form-control" name='gambar_kategori' id="gambar_kategori" required>
                  </div>
              </div>
            </form>
            </div>
            <!-- AKHIR FORM -->
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>