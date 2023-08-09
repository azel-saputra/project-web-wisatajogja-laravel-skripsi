<!doctype html>
<html lang="en">
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
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Fasilitas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
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
        <img src="image/logo_aplikasi.png" class="rounded-circle mx-auto d-block mt-3" style="width: 100px">
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
          </div>          </div>

          

      <main class="container">   
        <h3 class="mb-4 mt-4" style="text-align: left ">Data Fasilitas</h3>
        <!-- START DATA -->
        @if (session('status'))
        <div class="alert alert-success">
          {{session('status')}}

        </div>

        @endif
        <div class="my-3 p-3 bg-body rounded shadow-sm">
          
          <div class=" d-flex bd-highlight mb-3">

                <!-- TOMBOL TAMBAH DATA -->
                <div class="p-2 bd-highlight">
                  <a href='fasilitas/tambah' ><button type="button" class="btn btn-success"><img  src="image/plus.png" style="width: 25px" ></button> </a>
                </div>

                <div class=" p-2 bd-highlight">
                  <a href='/printdatafasilitas' ><button type="button" class="btn btn-success"><img src="image/printer.png" style="width: 25px" ></button> </a>
                </div>

                
                <!---search data-->
                <div class="ml-auto p-2 bd-highligh">
                  <form action="/fasilitas" method="GET">
                    <div class="row g-3 align-items-center">
                      <div class="col-auto">
                        <label for="inputPassword6" class="col-form-label">Search</label>
                      </div>
                      <div class="col-auto">
                        <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline">
                      </div>
                    </div>
                  </form>
                </div>
          </div>  
          
                <table class="table table-striped ">
                    <thead>
                        <tr>
                          <th style="width: 5%"> No</th>
                            <th  style="width: 65%">@sortablelink('nama_fasilitas', 'Nama Fasilitas') <img src="image/sort.png" width="15px"></th>
                            <th  style="width: 20%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($dataf as $index => $fasilitas)
                        <tr>
                          <td scope="row">{{$index + $dataf->firstItem()}}</td>
                                                 
                          <td>{{$fasilitas->nama_fasilitas}}</td>
                            <td class="d-flex justify-content-around" >
                                <a href="/fasilitas/{{$fasilitas ->id_fasilitas}}/edit"> <button type="button" class="btn btn-warning"><img  src="image/update.png" style="width: 25px" ></button> </a>
                                <form action="/fasilitas/{{$fasilitas ->id_fasilitas}}" method="POST" onsubmit="return confirmDelete(event)">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger"><img  src="image/delete.png" style="width: 25px" ></button>
                                </form>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
               
          </div>
          {!! $dataf->appends(\Request::except('page'))->render() !!}

          <!-- AKHIR DATA -->
    </main>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
      <script>
        function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
          title: 'Apakah Anda yakin ingin menghapus data fasilitas ini?',
          text: "Data yang dihapus tidak dapat dikembalikan!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#d333085d6',
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
            event.target.submit();
          }
        })
      }
      </script> 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>