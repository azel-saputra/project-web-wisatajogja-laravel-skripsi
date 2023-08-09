<!doctype html>
<html lang="en">
  <style>
    table td{
      height: 120px;

    }
  </style>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Data Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body class="bg-light">

    <!--sidebar-->        

      <main class="container">   
        <h3 class="mb-4 mt-4" style="text-align: center ">Data Wisata Jogja</h3>
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                
          
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                          <th class="col-md-1" > No</th>
                            <th class="col-md-1">Gambar</th>
                            <th class="col-md-2">Nama Wisata</th>
                            <th class="col-md-2">Alamat</th>
                            <th class="col-md-2">sejarah</th>
                            <th class="col-md-1">Kategori</th>
                            <th class="col-md-2">Fasilitas</th>
                            <th class="col-md-1">HTM</th>
                            <th class="col-md-2">Jam</th>
                            <th class="col-md-2">Lat\Lng</th>

                        </tr>
                    </thead>
                    <tbody>
                
                      @foreach ($cetakdatawisata as $cetakdata)
                      
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>
                            @php
                                $gambarPaths = explode(', ', $cetakdata->gambar);
                                $gambarPertama = reset($gambarPaths); // Mengambil elemen pertama dari array gambarPaths
                            @endphp
                            @if (!empty($gambarPertama))
                              <img src="{{ asset($gambarPertama) }}" style="width: 100px">
                            @endif
                          </td>
                           <td>{{$cetakdata->nama_wisata}}</td>
                            <td>{{$cetakdata->alamat}}</td>
                            <td>{{$cetakdata->sejarah}}</td>

                            <td>{{$cetakdata->kategori->nama_kategori}}</td>
                            <td>{{$cetakdata->fasilitas}}</td>
                            <td>{{$cetakdata->harga}}</td>
                            <td>{{$cetakdata->jam_buka}} - {{$cetakdata->jam_tutup}}</td>

                            <td>{{$cetakdata->latitude}}, {{$cetakdata->longitude}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               
          </div>
          <!-- AKHIR DATA -->
    </main>

    </div>

    <script type="text/javascript">
    window.print()

    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>