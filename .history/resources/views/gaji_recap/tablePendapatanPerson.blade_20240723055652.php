{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title> --}}

        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> --}}

    <style>
        #myTable th, td {
            padding: 7px
        }
    </style>
{{-- </head>
<body> --}}
     
    <table class="table-bordered mt-3 text-center" id="myTable" style="background: #f0f0f0">
        
        <thead> 
            <th>No</th> 
            <th>Id Badge</th> 
            <th>Jabatan</th> 
            <th>Nama</th> 
            <th>Status Pekerja</th> 
            <th>Gaji Pokok</th> 
            <th>Upah Harian</th> 
            <th>Upah Lembur Perjam</th>
            <th>Total Gaji Harian</th>
            <th>Total Gaji Lembur</th>
            <th>Total Gaji Bersih</th>
            @if(auth()->user()->level == 'hrd' || auth()->user()->level == 'keuangan') 
                <th colspan="2">Aksi</th>
            @endif
        </thead>
        <tbody>

            <tr>
                <td>1</td>
                <td>{{ $dataSalary->manpower->nama_kartu_badge }}</td>
                <td>{{ $dataSalary->manpower->jabatan }}</td>
                <td>{{ $dataSalary->manpower->nama_pekerja }}</td>
                <td>{{ $dataSalary->manpower->status_pekerja }}</td>
                <td>{{ ($dataSalary->gaji_pokok != null) ? number_format($dataSalary->gaji_pokok, 0, ',', '.') : '-' }}</td>
                <td>{{ ($dataSalary->gaji_harian != null) ? number_format($dataSalary->gaji_harian, 0, ',', '.') : '-' }}</td>
                <td>{{ ($dataSalary->gaji_lembur != null) ? number_format($dataSalary->gaji_lembur, 0, ',', '.') : '-' }}</td>
                <td>
                    <span id="jumlahGajiHarian{{ $dataSalary->manpower->id }}">{{ ($dataSalary->jumlah_gaji_harian != null) ? number_format($dataSalary->jumlah_gaji_harian, 0, ',', '.') : '-' }}</span>
                    <input type="number" style="display: none" id="ubahJumlahGajiHarian{{ $dataSalary->manpower->id }}" onchange="ubahJumlahGajiHarian({{ $dataSalary->manpower->id }})" value="{{ $dataSalary->jumlah_gaji_harian }}">
                </td>
                <td>
                    <span id="jumlahGajiLembur{{ $dataSalary->manpower->id }}">{{ ($dataSalary->jumlah_gaji_lembur != null) ? number_format($dataSalary->jumlah_gaji_lembur, 0, ',', '.') : '-' }}</span>
                    <input type="number" style="display: none" id="ubahJumlahGajiLembur{{ $dataSalary->manpower->id }}" onchange="ubahJumlahGajiLembur({{ $dataSalary->manpower->id }})" value="{{ $dataSalary->jumlah_gaji_lembur }}">
                </td>
                <td>
                    @if($dataSalary->manpower->status_pekerja == 'Lepas')
                        <span id="jumlahGajiBersih{{ $dataSalary->manpower->id }}">{{ ($dataSalary->jumlah_gaji_bersih != null) ? number_format($dataSalary->jumlah_gaji_harian+$dataSalary->jumlah_gaji_lembur, 0, ',', '.') : '-' }}</span>
                        <input type="number" style="display: none" id="ubahJumlahGajiBersih{{ $dataSalary->manpower->id }}" onchange="ubahJumlahGajiBersih({{ $dataSalary->manpower->id }})" value="{{ $dataSalary->jumlah_gaji_harian+$dataSalary->jumlah_gaji_lembur }}">
                    @else
                        <span id="jumlahGajiBersih{{ $dataSalary->manpower->id }}">{{ ($dataSalary->jumlah_gaji_bersih != null) ? number_format($dataSalary->jumlah_gaji_bersih+$dataSalary->jumlah_gaji_lembur, 0, ',', '.') : '-' }}</span>
                        <input type="number" style="display: none" id="ubahJumlahGajiBersih{{ $dataSalary->manpower->id }}" onchange="ubahJumlahGajiBersih({{ $dataSalary->manpower->id }})" value="{{ $dataSalary->jumlah_gaji_bersih+$dataSalary->jumlah_gaji_lembur }}">
                    @endif
                    
                </td>
                @if(auth()->user()->level == 'hrd' || auth()->user()->level == 'keuangan') 
                    <td>
                        <div id="btnAksi{{ $dataSalary->manpower->id }}"> 
                            @if($confirmSalaryPerson->konfirmasi_hrd == true && Auth::user()->level == 'hrd')
                                <button class="btn btn-sm btn-danger" onclick="aksiCancelApproveByHRD({{ $dataSalary->manpower->id }})" style="width: 100%; display: flex; align-items: center; justify-content: space-evenly"><span class="material-symbols-outlined">delete_forever</span>Cancel Approve</button>
                            @elseif ($confirmSalaryPerson->konfirmasi_keuangan == true && Auth::user()->level == 'keuangan')
                                <button class="btn btn-sm btn-danger" onclick="aksiCancelApproveByKeuangan({{ $dataSalary->manpower->id }})" style="width: 100%; display: flex; align-items: center; justify-content: space-evenly"><span class="material-symbols-outlined">delete_forever</span>Cancel Approve</button>
                            @else
                                @if(Auth::user()->level == 'keuangan')
                                <span class="btn btn-sm btn-primary" style="width: 100%; display: flex; align-items: center; justify-content: space-evenly" onclick="aksiEdit({{ $dataSalary->manpower->id }})"><span class="material-symbols-outlined fs-6">edit</span>Edit</span>
                            @endif
                            
                        </div>
                        {{-- when aksi edit is clicked showing this button --}}
                        <div style="width: 100%; display: none" id="aksiChildEdit{{ $dataSalary->manpower->id }}">
                            <span style="width: 100%; display: flex; align-items: center; justify-content: space-evenly"  class="btn btn-sm btn-secondary mb-1" onclick="batalAksiEdit({{ $dataSalary->manpower->id }})"><span class="material-symbols-outlined">close_small</span>Batal Edit</span>
                            <span style="width: 100%; display: flex; align-items: center; justify-content: space-evenly"  class="btn btn-sm btn-primary mb-1" onclick="simpanAksiEdit({{ $dataSalary->manpower->id}})"><span class="material-symbols-outlined">check</span>Simpan</span>
                        </div>
                    </td>
                    <td>
                        @if($confirmSalaryPerson->konfirmasi_hrd == false && Auth::user()->level == 'hrd')
                            <button class="btn btn-sm btn-danger" onclick="aksiApproveByKeuangan({{ $dataSalary->manpower->id }})" style="width: 100%; display: flex; align-items: center; justify-content: space-evenly"><span class="material-symbols-outlined">check</span>Approve</button>
                        @elseif($confirmSalaryPerson->konfirmasi_keuangan == false && Auth::user()->level == 'keuangan')
                            @if($confirmSalaryPerson->konfirmasi_hrd == true)
                                <button class="btn btn-sm btn-danger" onclick="aksiApproveByKeuangan({{ $dataSalary->manpower->id }})" style="width: 100%; display: flex; align-items: center; justify-content: space-evenly"><span class="material-symbols-outlined">check</span>Approve</button>
                            @else
                                <button class="btn btn-sm btn-danger" onclick="aksiApproveByKeuangan({{ $dataSalary->manpower->id }})" style="width: 100%; display: flex; align-items: center; justify-content: space-evenly" disabled><span class="material-symbols-outlined">check</span>Approve</button>
                            @endif
                        @else
                            <span class="bg-success text-white p-1 rounded" style="width: 100%; display: flex; align-items: center; justify-content: space-evenly"><span class="material-symbols-outlined me-1">check_circle</span>Approved</span>
                        @endif
                        {{-- <button class="btn btn-sm btn-danger" onclick="aksiApprove({{ $dataSalary->manpower->id }})" style="width: 100%; display: flex; align-items: center; justify-content: space-evenly"><span class="material-symbols-outlined">check</span>Approve</button> --}}
                    </td>
                @endif
            </tr>
            
        </tbody>

    </table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c7b0ba9c3.js" crossorigin="anonymous"></script>


    <script>
        function ubahJumlahGajiHarian(id) {
            let valUbahGajiHarian = $(`#ubahJumlahGajiHarian${id}`).val();
            $(`#ubahJumlahGajiHarian${id}`).val(valUbahGajiHarian);
        }
        function ubahJumlahGajiLembur(id) {
            let valUbahGajiLembur = $(`#ubahJumlahGajiLembur${id}`).val();
            $(`#ubahJumlahGajiLembur${id}`).val(valUbahGajiLembur);
        }
        // function ubahJumlahGajiBersih(id) {
        //     let valUbahGajiBersih = $(`#ubahJumlahGajiBersih${id}`).val();
        //     $(`#ubahJumlahGajiBersih${id}`).val(valUbahGajiBersih);
        // }

        function aksiEdit(id) {
            // alert(id);
            $(`#btnAksi${id}`).hide();
            $(`#aksiChildEdit${id}`).show();

            $(`#jumlahGajiHarian${id}`).hide();
            $(`#ubahJumlahGajiHarian${id}`).show();
            $(`#jumlahGajiLembur${id}`).hide();
            $(`#ubahJumlahGajiLembur${id}`).show();
            // $(`#jumlahGajiBersih${id}`).hide();
            // $(`#ubahJumlahGajiBersih${id}`).show();
        }

        function batalAksiEdit(id) {
            // alert();
            $(`#btnAksi${id}`).show();
            $(`#aksiChildEdit${id}`).hide();

            $(`#jumlahGajiHarian${id}`).show();
            $(`#ubahJumlahGajiHarian${id}`).hide();
            $(`#jumlahGajiLembur${id}`).show();
            $(`#ubahJumlahGajiLembur${id}`).hide();
            // $(`#jumlahGajiBersih${id}`).show();
            // $(`#ubahJumlahGajiBersih${id}`).hide();
            // $(`#formDCU${id}`).attr('action', `/dashboard/storeDCU/${id}`);
            // $(`#formTimesheet${id}`).attr('action', `/dashboard/storeTimesheet/${id}/${dcurecap_id}`);

        }

        // function simpanAksiEdit(id) {
        //     // let actionUrl = `{{ route('updatePendapatanGaji', ':id') }}`;
        //     // actionUrl = actionUrl.replace(':id', id);

        //     // $(`#formPendapatan${id}`).attr('action', `/updatePendapatanGaji/${id}`);
        //     // $(`#formPendapatan${id}`).attr('action', actionUrl);

        //     $(`#formPendapatan${id}`).submit();
        // }
    </script>   
    
{{-- </body>
</html> --}}