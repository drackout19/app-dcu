<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body>
    <div> 
    <div class="container mx-auto border rounded mt-5 p-2 pt-3" style="width: 50%;">
        <div style="display: flex; align-items: center;">
            <img class="" src="/image/logo_mipcon.png" style="width: 150px; height: 50px">
            <div class="" style="width: 50%; margin: auto; margin-left: 50px;">
                <h5 class="text-center fw-bolder">PT. Mipcon Prima Industri</h5>
                <p class="text-center">Jl. Siaga II No.25, RT.2/RW.5, Pejaten Barat., Pasar Minggu, Jakarta Selatan, 12510</p>
            </div>
        </div>
        <hr>
        <h5 class="text-center fw-bolder mb-1">Slip Gaji Pekerja</h5>
        <h6 class="text-center">{{ $monthYear }}</h6>

        <div class="mt-3" style="display: flex; justify-content: space-between ;width: 100%">
            

            <div style="min-width: 30%; max-width: 50%;">
                <div class="" style="display: flex;">
                    <div class=" fw-bolder" style="width: 35%; display: flex; justify-content: space-between">
                        <span>Nama</span>
                        <span>:</span>
                    </div>
                    <span class="ms-2">{{ $dataManpower->nama_pekerja }}</span>
                </div>
                <div class="" style="display: flex;">
                    <div class=" fw-bolder" style="width: 35%; display: flex; justify-content: space-between">
                        <span>Jabatan</span>
                        <span>:</span>
                    </div>
                    <span class="ms-2">{{ $dataManpower->jabatan }}</span>
                </div>
                {{-- <div class="" style="display: flex;">
                    <div class=" fw-bolder" style="width: 35%; display: flex; justify-content: space-between">
                        <span>Status</span>
                        <span>:</span>
                    </div>
                    <span class="ms-2">{{ $dataManpower->status_pekerja }}</span>
                </div> --}}
            </div>
            <p class="text-end"><b>Dicetak tanggal :</b> {{ $tanggal_cetak }}</p>
        </div>
        <hr>

        <div class="row p-1">
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <div class="border p-2 rounded" style="height: 100%">
                    <h6 class="text-center fw-bolder mb-1">DATA ABSENSI</h6>
                    <hr>

                    <div style="display: flex; justify-content: space-between">
                        <span>Total Hari Masuk</span>
                        <span class="fw-bolder">{{ ($arrDataTimesheet['totalHariMasuk'] != null) ? $arrDataTimesheet['totalHariMasuk'].' Hari' : '-' }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between">
                        <span>Total Jam Lembur</span>
                        <span class="fw-bolder">{{ ($arrDataTimesheet['totalJamLembur'] != null) ? $arrDataTimesheet['totalJamLembur'].' Jam' : '-' }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <div class="border p-2 rounded" style="height: 100%">
                    <h6 class="text-center fw-bolder mb-1">PENDAPATAN</h6>
                    <hr>

                    {{-- <div style="display: flex; justify-content: space-between">
                        <span>Gaji Pokok</span>
                        <span class="fw-bolder">{{ ($dataSalary->gaji_pokok != null) ? number_format($dataSalary->gaji_pokok, 0, ',', '.') : '-' }}</span>
                    </div> --}}
                    <div style="display: flex; justify-content: space-between">
                        <span>Gaji Harian</span>
                        <span class="fw-bolder">{{ ($dataSalary->jumlah_gaji_harian != null) ? number_format($dataSalary->jumlah_gaji_harian, 0, ',', '.') : '-' }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between">
                        <span>Gaji Lembur</span>
                        {{-- <span class="fw-bolder">{{ ($arrDataTimesheet['jumlah_gaji_lembur'] != null) ? number_format($arrDataTimesheet['jumlah_gaji_lembur'], 0, ',', '.') : '-' }}</span> --}}
                        <span class="fw-bolder">{{ ($dataSalary->jumlah_gaji_lembur != null) ? number_format($dataSalary->jumlah_gaji_lembur, 0, ',', '.') : '-' }}</span>
                    </div>
                    <hr>
                    <div class="fw-bolder"  style="display: flex; justify-content: space-between">
                        <span>Total Gaji</span>
                        <span>{{ ($dataSalary->jumlah_gaji_bersih != null) ? number_format($dataSalary->jumlah_gaji_bersih, 0, ',', '.') : '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c7b0ba9c3.js" crossorigin="anonymous"></script>
    
</body>
</html>