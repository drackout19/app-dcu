<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>

    <style>
        .btn-color{
        background-color: #0e1c36;
        color: #fff;
        
        }

        .profile-image-pic{
        height: 150px;
        width: 150px;
        object-fit: cover;
        }



        .cardbody-color{
        background: white;
        }

        a{
        text-decoration: none;
        }
    </style>
</head>
<body style="background-image: url('/image/bg-kilang-1.png')">
    <div class="ms-auto me-3 mt-3" style="max-width: max-content">
        <a href="/login"><button class="btn btn-md btn-dark" >Login Pekerja</button></a>
    </div>
    <div class="container" style="background: transparent">
        <div class="row">
          <div class="col-md-6 offset-md-3" >
            <h1 class="text-center text-white mt-5 fw-bolder" style="text-shadow: 0px 20px 30px black;">LOGIN STAFF</h1>
            
            <div class=" mt-5" style=" box-shadow: 0px 0px 40px rgba(88, 88, 88, 0.7); border-radius: 20px; background: rgba(1, 1, 1, 0.5);">
    
              <form action="{{ route('postLoginStaff') }}" method="post" class="card-body cardbody-color p-5 pb-1 pt-2" style="border-radius: 20px; background: rgba(255, 255, 255, 0.5);">
                @csrf
                <div class="text-center">
                  <img src="/image/logo_mipcon_half.png" class="profile-image-pic rounded-circle my-3 border"
                    alt="profile" style="max-width: 100px; max-height: 100px">
                </div>
    
                <div class="mb-3 mt-5">
                  <input type="text" class="form-control" id="nama_staff" name="nama_staff"
                    placeholder="Username">
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button></div>
                <div id="emailHelp" class="text-center mb-5 text-white fw-bold">Belum Punya Akun? <a href="/register" class="text-primary fw-bold">Buat Akun</a>
                </div>
              </form>
            </div>
    
          </div>
        </div>
    </div>
</body>
</html>