<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    {{-- <script>
      window.Laravel = {!! json_encode([
          'csrfToken' => csrf_token(),
      ]) !!};
  </script> --}}
    {{-- <title>{{ $title }}</title> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    {{-- link datatables --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />

    {{-- link toastr --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  
    @yield('css')
    
  </head>
  <body style="background-color: rgba(227, 227, 227, 0.5);">
    <nav class="row border pe-2">
      <div class="col-2 border" style="display: flex; align-items: center;  justify-content: center; ">
        <img src="{{URL::asset('/image/logo_mipcon.png')}}" width="70%">
      </div>
      <div class="col-10 border" style="background-color: rgba(254, 133, 0, 0.7); height: 50px; display: flex;align-items: center">
        <div class="text-white ms-auto border" style="width: max-content;">
          {{-- <span class="fw-semibold">Selamat Datang, HRD</span> --}}
          <span class="fw-semibold">Logout</span>
          <i class="fa-solid fa-right-from-bracket ms-2"></i>
        </div>
      </div>
    </nav>

    {{-- this yield for Accommodate a ktp image for floated over body --}}
    @yield('floating-div')

    {{-- this yield for Accommodate a ktp image for floated over body --}}
    <div id="floating-form-dcu" style="display: none; z-index: 9999999;"></div>

    {{-- this yield for Accommodate a documents for floated over body --}}
    @yield('floating-documents')
    <div id="floating-documents" style="display: none; z-index: 999999;"></div>

    <div class="row">
      <div class="col-2 border p-0" style="background-color: rgba(8, 158, 121, 0.7); min-height: 100vh">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-sm-12 col-12 border">
            <img src="https://picsum.photos/50/50" class="border m-4" width="50px" height="50px" style="border-radius: 50%;">
          </div>
          <div class="col-lg-7 col-md-7 col-sm-12 col-12 border" style="display: flex; align-items: center; justify-content: flex-start">
            <span class="fw-semibold text-white">Selamat Datang, HRD</span>
          </div>
        </div>
        <div class="ps-4" style="height: 30px; background-color: rgba(0, 0, 0, 0.7); display: flex; align-items: center">
          <span class="text-white">Menu</span>
        </div>
        {{-- item side bar --}}
        <div class="text-white mt-4" style="display: flex; align-items: center; flex-direction: column" > 
            {{-- <span style="width: 70%" onclick="location.href='/dashboard'" >
              <p class="border" style="display: flex; align-items: center; cursor: default"><span class="material-symbols-outlined pe-3">
                house
                </span>Beranda</p>
            </span> --}}
            <span class="mt-3" style="width: 70%" onclick="location.href='/hrd/manpower'">
              <p class="border" style="display: flex; align-items: center; cursor: default"><span class="material-symbols-outlined pe-3">
                groups
                </span>Manpower</p>
            </span>
            <span class="mt-3" style="width: 70%" onclick="location.href='/dcu-recap'">
              <p class="border" style="display: flex; align-items: center; cursor: default"><span class="material-symbols-outlined pe-3">
                health_and_safety
                </span>Rekap DCU</p>
            </span>            
            <span class="mt-3" style="width: 70%" onclick="location.href='/rekap-absensi'">  
              <p class="border" style="display: flex; align-items: center; cursor: default"><span class="material-symbols-outlined pe-3">
                clinical_notes
                </span>Rekap Absensi</p>
            </span>            
            <span class="mt-3" style="width: 70%" onclick="location.href='/rekap-slip-gaji'">
              <p class="border" style="display: flex; align-items: center; cursor: default"><span class="material-symbols-outlined pe-3">
                universal_currency
                </span>Rekap Slip Gaji</p>
            </span>
        </div>

        
      </div>
      
      <div class="col-10 border p-3" >
        
        {{-- untuk konten --}}
        @yield('konten')
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c7b0ba9c3.js" crossorigin="anonymous"></script>

    {{-- script datatables --}}
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>

    <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
      } );
    </script>

    {{-- untuk konten --}}
     @yield('script')
  </body>
</html>