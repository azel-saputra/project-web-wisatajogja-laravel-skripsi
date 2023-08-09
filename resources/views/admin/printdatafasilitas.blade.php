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
    <title>Cetak Data Fasilitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body class="bg-light">

    <!--sidebar-->        

      <main class="container">   
        <h3 class="mb-4 mt-4" style="text-align: center ">Data Fasilitas Wisata</h3>
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                
          
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                          <th class="col-md-1" > No</th>
                            <th class="col-md-10">Nama Fasilitas</th>
                     
                        </tr>
                    </thead>
                    <tbody>
                
                      @foreach ($cetakdatafasilitas as $cetakdata)
                      
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                     
                           <td>{{$cetakdata->nama_fasilitas}}</td>
                     
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