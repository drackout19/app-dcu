@extends('layouts.main')


@section('css')
{{-- link font lato google --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
{{-- link font rubik google --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Reenie+Beanie&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

{{-- ini style css untuk handle sticky notes jgn utak atik gw jga ga ngerti --}}
<style>
    
    .float-sticky-note h6, .float-sticky-note-masuk-kerja h6{
    font-family: 'Lato';
    font-weight: bold;
    }

    .float-sticky-note p, .float-sticky-note-masuk-kerja p{
    font-family: 'Rubik';
    font-weight: 400;
    }
    .float-sticky-note ul,li, .float-sticky-note-masuk-kerja ul{
    list-style:none;
    }
    ul{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    }
    .float-sticky-note ul li a, .float-sticky-note-masuk-kerja ul li a{
    text-decoration:none;
    color:#000;
    background:#ffc;
    display:block;
    min-height:10em;
    max-width:10em;
    padding:1em;
    box-shadow: 5px 5px 7px rgba(33,33,33,.7);
    transform: rotate(-6deg);
    transition: transform .15s linear;
    }

    .float-sticky-note ul li:nth-child(even) a, .float-sticky-note-masuk-kerja ul li:nth-child(even) a{
    transform:rotate(4deg);
    position:relative;
    top:5px;
    background:#cfc;
    }
    /* .float-sticky-note ul li:nth-child(3n) a{
    transform:rotate(-3deg);
    position:relative;
    top:-5px;
    background:#ccf;
    }
    .float-sticky-note ul li:nth-child(5n) a{
    transform:rotate(5deg);
    position:relative;
    top:-10px;
    } */

    .float-sticky-note ul li a:hover,ul li a:focus, .float-sticky-note-masuk-kerja ul li a:hover{
    box-shadow:10px 10px 7px rgba(0,0,0,.7);
    transform: scale(1.25);
    position:relative;
    z-index:5;
    }

    .float-sticky-note ul li, .float-sticky-note-masuk-kerja ul li{
    margin:1em;
    }
</style>


@endsection

@section('konten')

    {{-- {{ Session::get('nama')}}
    {{ Session::get('umur');}} --}}
    {{-- content body --}}
    {{-- @php echo if(Session::get('umur') ? echo "yes" : echo 'no' ) @endphp --}}
    {{-- @if (Session::get('umur')) {
        {{ 'none' }}
    }

    
        
    @else
        {{ '' }}
    @endif --}}
    
    {{-- {{ Session::get('dateThisDay') }} --}}
    {{ "Value resetTimesheet : " . Session::get('resetTimesheet') }}
    {{ ". Value isHiddenBtnDCU : " . Session::get('isHiddenBtnDCU') }}

        @php
            unset($_SESSION['id']);
            session_start();
 
            // if(!isset( $_SESSION['id'])) {
                
                // $_SESSION['id'] = array();
                // unset($_SESSION['id']);
            // }
            
        @endphp

      <div class="rounded bg-white p-2">
          <h5>Dashboard</h5>
      </div>

      <div class="rounded bg-white mt-5 p-3" style="height: 70vh; overflow-x: scroll">
      {{-- title --}}
      <h4 class="fw-bolder">Absensi Manpower Projek Turn Around Reaktor Balongan</h4>
      <br>
      {{-- tabel --}}
      <table id="myTable" class="display text-center">
          <thead>
              <tr>
                  <th class="text-center">No</th>
                  <th class="text-center" style="width: 150px">Tanggal</th>
                  <th class="text-center">Id Badge</th>
                  <th class="text-center">Jabatan</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Status DCU</th>
                  <th class="text-center">Absen Masuk</th>
                  <th class="text-center">Absen Lembur</th>
                  <th class="text-center">Absen Pulang</th>
                  <th class="text-center">Total Waktu Lembur</th>
                  <th class="text-center" style="width: 150px">Aksi</th>
              </tr>
          </thead>
          <tbody >
           

            @forelse ($manpowers as $data)
                
                <tr>
                    
                    <form action="{{ route('dashboard.storeDCU', $data->id) }}" id="formDCU{{ $data->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <section>
                        <td class="text-center">{{  $loop->iteration }}</td>
                        <td class="text-center"><input type="date" class="inputDate"  id="inputDate{{ $data->id }}"  name="inputDate{{ $data->id }}" style="background: transparent; max-width: 105px; border: none" readonly ></td>
                        <td class="text-center">{{ $data->no_kartu_badge }}</td>
                        <td class="text-start">{{ $data->jabatan }}</td>
                        <td class="text-start">{{ $data->nama_pekerja }}</td>
                    
                        <td class="text-center">
                            
                            <input type="hidden" id="inputStatusDCU{{ $data->id }}" name="inputStatusDCU{{ $data->id }}">
                            <input type="hidden" id="inputSuhuBadan{{ $data->id }}" name="inputSuhuBadan{{ $data->id }}">
                            <input type="hidden" id="inputKadarOksigenDarah{{ $data->id }}" name="inputKadarOksigenDarah{{ $data->id }}">
                            <input type="hidden" id="inputDetakJantung{{ $data->id }}" name="inputDetakJantung{{ $data->id }}">
                            <input type="hidden" id="inputTekananSistolik{{ $data->id }}" name="inputTekananSistolik{{ $data->id }}">
                            <input type="hidden" id="inputTekananDiastolik{{ $data->id }}" name="inputTekananDiastolik{{ $data->id }}">
                            
                            
                            <span>

                                {{-- {{ dd(Session::get('dateThisDay')) }} --}}
                                
                                {{-- kontol --}}
                                {{-- @if(Session::get('resetTimesheet') == 'false')  --}}
                                <span style="display: none" id="resetTimesheet" aria-label="{{ Session::get('resetTimesheet') }}"></span>
                                @if(Session::get('resetTimesheet') == 'false') 
                                    @forelse ($data->dcurecap->where('tanggal', Session::get('dateThisDay')) as $dataDCU ) 

                                                {{-- {{ $dataDCU->all() }} --}}
                                        
                                                @if($data->id == $dataDCU->manpower_id && $dataDCU->status_dcu != null)
                                                    
                                                {!! "<b>$dataDCU->status_dcu</b>" !!}
                                                
                                                <br>
                                                <span class="text-primary fw-bolder" style="cursor: pointer; display: none" id="ubahStatusDCU{{ $data->id }}" onclick="ubahStatusDCU({{ $data->id }})">ubah</span>
                                                {{-- @break --}}

                                                @else
                                                    {{-- @if ($data->id == $dataDCU->manpower_id && $dataDCU->tanggal == "2024-07-08") --}}
                                                        
                                                        {{-- <span class="btn btn-sm btn-success" style="display : {{ (Session::get('isHiddenBtnDCU') == 'false') ? '' : 'none' }}" id="btn-dcu{{ $data->id }}" onclick="activeFloatFormDcu({{ $data->id }})">DCU bang</span>  --}}
                                                    {{-- @endif --}}
                                                    
                                                        {{-- // Session::put('dateThisDay' , Session::get('dateThisDay'));
                                                        // Session::put('dateThisDay' , "2024-07-09"); --}}
                                                
                                                @endif

                                            
                                    @empty

                                    

                                        {{-- @if (Session::get('resetTimesheet') == 'false') --}}
                                            {{-- <span class="btn btn-sm btn-success" style="display : {{ (Session::get('isHiddenBtnDCU') == 'false') ? '' : 'none' }}" id="btn-dcu{{ $data->id }}" onclick="activeFloatFormDcu({{ $data->id }})">DCU brok</span>  --}}
                                            <span class="btn btn-sm btn-success" style="display : {{ (Session::get('isHiddenBtnDCU') == 'false') ? '' : 'none' }}"  id="btn-dcu{{ $data->id }}" onclick="activeFloatFormDcu({{ $data->id }})">DCU empty</span> 
                                            
                                           
                                            
                                            {{-- @php --}}
                                                {{-- // Session::put('dateThisDay' , Session::get('dateThisDay'));
                                                Session::put('dateThisDay' , "2024-07-09"); --}}
                                            {{-- @endphp --}}
                                        {{-- @endif --}}
                                        {{-- <span class="btn btn-sm btn-success" style="display : {{ (Session::get('isHiddenBtnDCU') == 'false') ? '' : 'none' }}" id="btn-dcu{{ $data->id }}" onclick="activeFloatFormDcu({{ $data->id }})">DCU brok</span>  --}}
                                    @endforelse
                                @else

                                    <span class="btn btn-sm btn-success" style="display : {{ (Session::get('isHiddenBtnDCU') == 'false') ? '' : 'none' }}" id="btn-dcu{{ $data->id }}" onclick="activeFloatFormDcu({{ $data->id }})">DCU baru</span> 
                                    
                                @endif
                                
                                
                            </span>
                            {{-- the function of this div to be float form when button DCU has clicked --}}
                            <div style="display: none" id="container-form-dcu{{ $data->id }}">
                                <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                                    <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                        <div class="card p-2" style="height: 80vh ;overflow-y: scroll">
                                            {{-- <h4>Ceklis Sesuai Kesehatan Pekerja</h4>
                                            <br>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radioDCU" id="radioFIT" value="FIT" onclick="handleRadioDCU('FIT')">
                                            <label class="form-check-label">
                                                FIT
                                            </label>
                                        </div>  
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="radio" name="radioDCU" id="radioFWN" value="FWN" onclick="handleRadioDCU('FWN')">
                                            <label class="form-check-label">
                                            FIT WITH NOTE
                                            </label> --}}
                                            {{-- textarea input untuk menuliskan note warning nya --}}
                                            {{-- <div class="rounded mt-1" style="width: max-content; display: none" id="container-input-note-dcu">
                                                <textarea class="rounded" name="" id="textarea-float-note" cols="20" rows="5" placeholder="Tuliskan catatan untuk pekerja disini..." ></textarea>
                                            </div> --}}
                                        {{-- </div> 
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="radio" name="radioDCU" id="radioUNFIT" value="UNFIT" onclick="handleRadioDCU('UNFIT')">
                                            <label class="form-check-label">
                                            UNFIT
                                            </label>
                                            </div>  --}}

                                            {{-- coba --}}
                                            <div class="p-2 rounded mx-auto mt-2" style="background: rgb(241, 241, 241); max-width: max-content;" >
                                                <h5>Ceklis Sesuai Kesehatan Pekerja</h5>

                                                {{-- suhu badan --}}
                                                <div class="mt-3" id="form-suhu-badan">
                                                    <h6>Suhu Badan</h6>
                                                    <div class="form-check ms-2">
                                                        <input class="form-check-input" type="radio" name="radioSuhuBadan" value="normal" checked onclick="handleRadioDCU('radio-suhu-badan-normal')">
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                        Normal
                                                        </label>
                                                    </div>
                                                    <div class="form-check ms-2">
                                                        <input class="form-check-input" type="radio" name="radioSuhuBadan" value="tdk-normal"  onclick="handleRadioDCU('radio-suhu-badan-tdk-normal')">
                                                        <label class="form-check-label">
                                                        Tidak Normal
                                                        </label>
                                                        {{--input untuk menuliskan suhu badannya --}}
                                                        <div class="rounded mt-1" style="width: max-content; display: none; " id="container-input-suhu-badan">
                                                            <input type="number" step="0.1" min="0" placeholder="Suhu badan" id="inputSuhuBadanCopy{{ $data->id }}" onkeyup="fillThisValue('inputSuhuBadanCopy{{ $data->id }}', 'inputSuhuBadan{{ $data->id }}')">
                                                            <span class="unit">&deg;C</span>
                                                            {{-- <textarea class="rounded" name="" id="textarea-float-note" cols="20" rows="5" placeholder="Isikan suhu badan pekerja" ></textarea> --}}
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- kadar oksigen darah --}}
                                                <div class="mt-3" id="form-kadar-oksigen">
                                                    <h6>Kadar Oksigen Darah</h6>
                                                    <div class="form-check ms-2">
                                                        <input class="form-check-input" type="radio" name="radioKadarOksigenDarah" value="normal"  checked onclick="handleRadioDCU('radio-oksigen-darah-normal')">
                                                        <label class="form-check-label">
                                                        Normal
                                                        </label>
                                                    </div>
                                                    <div class="form-check ms-2">
                                                        <input class="form-check-input" type="radio" name="radioKadarOksigenDarah" value="tdk-normal"  onclick="handleRadioDCU('radio-oksigen-darah-tdk-normal')">
                                                        <label class="form-check-label">
                                                        Tidak Normal
                                                        </label>
                                                        {{--input untuk menuliskan kadar oksigen darah --}}
                                                        <div class="rounded mt-1" style="width: max-content; display: none" id="container-input-oksigen-darah">
                                                            <input type="number" step="0.1" min="0" placeholder="kadar oksigen" id="inputKadarOksigenDarahCopy{{ $data->id }}" onkeyup="fillThisValue('inputKadarOksigenDarahCopy{{ $data->id }}', 'inputKadarOksigenDarah{{ $data->id }}')">
                                                            <span class="unit">%</span>
                                                            {{-- <textarea class="rounded" name="" id="textarea-float-note" cols="20" rows="5" placeholder="Isikan suhu badan pekerja" ></textarea> --}}
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- detak jantung --}}
                                                <div class="mt-3" id="form-detak-jantung">
                                                    <h6>Detak Jantung</h6>
                                                    <div class="form-check ms-2">
                                                        <input class="form-check-input" type="radio" name="radioDetakJantung" value="normal"  checked onclick="handleRadioDCU('radio-detak-jantung-normal')">
                                                        <label class="form-check-label">
                                                        Normal
                                                        </label>
                                                    </div>
                                                    <div class="form-check ms-2">
                                                        <input class="form-check-input" type="radio" name="radioDetakJantung" value="tdk-normal"  onclick="handleRadioDCU('radio-detak-jantung-tdk-normal')">
                                                        <label class="form-check-label">
                                                        Tidak Normal
                                                        </label>
                                                        {{--input untuk menuliskan detak jantungnya --}}
                                                        <div class="rounded mt-1" style="width: max-content; display: none" id="container-input-detak-jantung">
                                                            <input type="number" step="0.1" min="0" placeholder="Detak jantung" id="inputDetakJantungCopy{{ $data->id }}" onkeyup="fillThisValue('inputDetakJantungCopy{{ $data->id }}', 'inputDetakJantung{{ $data->id }}')">
                                                            <span class="unit">bpm</span>
                                                            {{-- <textarea class="rounded" name="" id="textarea-float-note" cols="20" rows="5" placeholder="Isikan suhu badan pekerja" ></textarea> --}}
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- tekanan darah --}}
                                                <div class="mt-3" id="form-tekanan-darah">
                                                    <h6>Tekanan Darah</h6>
                                                    <div class="form-check ms-2">
                                                        <input class="form-check-input" type="radio" name="radioTekananDarah" value="normal"  checked onclick="handleRadioDCU('radio-tekanan-darah-normal')">
                                                        <label class="form-check-label">
                                                        Normal
                                                        </label>
                                                    </div>
                                                    <div class="form-check ms-2">
                                                        <input class="form-check-input" type="radio" name="radioTekananDarah" value="tdk-normal"  onclick="handleRadioDCU('radio-tekanan-darah-tdk-normal')">
                                                        <label class="form-check-label">
                                                        Tidak Normal
                                                        </label>
                                                        {{--input untuk menuliskan tekanan darahnya --}}
                                                        <div class="rounded mt-1" style="width: max-content; display: none" id="container-input-tekanan-darah">
                                                            <input type="number" min="0" placeholder="Sistolik" style="max-width: 100px" id="inputTekananSistolikCopy{{ $data->id }}" onkeyup="fillThisValue('inputTekananSistolikCopy{{ $data->id }}', 'inputTekananSistolik{{ $data->id }}')">
                                                            <span class="unit">/</span>
                                                            <input type="number" min="0" placeholder="Diastolik" style="max-width: 100px" id="inputTekananDiastolikCopy{{ $data->id }}" onkeyup="fillThisValue('inputTekananDiastolikCopy{{ $data->id }}', 'inputTekananDiastolik{{ $data->id }}')">
                                                            <span class="unit">mmHg</span>
                                                            {{-- <textarea class="rounded" name="" id="textarea-float-note" cols="20" rows="5" placeholder="Isikan suhu badan pekerja" ></textarea> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="mx-auto" style="width: max-content">
                                                    <button class="btn btn-sm btn-success" type="submit" onclick="kirim_form_dcu({{  $data->id  }})">Kirim</button>
                                                </div>
                                            </div>
                            </div>
                        
                    </section>     
                </form>              

                                        {{-- button cancel popup dcu --}}
                                        <span class="material-symbols-outlined fw-bold" style="position: absolute; left: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_form_dcu()">
                                            cancel
                                        </span>
                                    </div>
                                </div>
                            </div>

                            

                        </td>
                        {{-- /////////////////////////////////////////////////////////////////////////// --}}
                        @php
                            $dcurecap_id = 0;
                            foreach ($data->dcurecap as $dataDCU) {
                                $dcurecap_id = $dataDCU->id;
                            }
                        @endphp

                        <form action="{{ route('dashboard.storeTimesheet',  [$data->id, $dcurecap_id]) }}" id="formTimesheet{{ $data->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <input type="hidden" id="inputJamMasuk{{ $data->id }}" name="inputJamMasuk{{ $data->id }}">
                            <input type="hidden" id="inputJamLembur{{ $data->id }}" name="inputJamLembur{{ $data->id }}">
                            <input type="hidden" id="inputJamPulang{{ $data->id }}" name="inputJamPulang{{ $data->id }}">
                            <input type="hidden" id="inputTotalWaktuLembur{{ $data->id }}" name="inputTotalWaktuLembur{{ $data->id }}">
                            <input type="hidden" id="inputKeteranganMasuk{{ $data->id }}" name="inputKeteranganMasuk{{ $data->id }}">
                            <input type="hidden" id="inputKeteranganLembur{{ $data->id }}" name="inputKeteranganLembur{{ $data->id }}">
                            <input type="hidden" id="inputKeteranganPulang{{ $data->id }}" name="inputKeteranganPulang{{ $data->id }}">
                            <input type="hidden" id="inputUbahJamMasuk{{ $data->id }}" name="inputUbahJamMasuk{{ $data->id }}">
                            <input type="hidden" id="inputUbahJamLembur{{ $data->id }}" name="inputUbahJamLembur{{ $data->id }}">
                            <input type="hidden" id="inputUbahJamPulang{{ $data->id }}" name="inputUbahJamPulang{{ $data->id }}">


                        {{-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
                    
                            {{-- btn masuk kerja  --}}
                            <td class="text-center">
                                
                                {{-- @foreach ($data->dcurecap as $dataDCU)
                                    @php
                                        $dcurecap_id = $dataDCU->id;
                                    @endphp
                                @endforeach --}}
                                {{-- <form action="{{ route('dashboard.storeTimesheet',  [$data->id, $dcurecap_id]) }}" id="formTimesheet{{ $data->id }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method("PUT")
                                    <input type="hidden" id="inputJamMasuk{{ $data->id }}" name="inputJamMasuk{{ $data->id }}">
                                    <input type="hidden" id="inputJamLembur{{ $data->id }}" name="inputJamLembur{{ $data->id }}">
                                    <input type="hidden" id="inputJamPulang{{ $data->id }}" name="inputJamPulang{{ $data->id }}">
                                    <input type="hidden" id="inputKeteranganMasuk{{ $data->id }}" name="inputKeteranganMasuk{{ $data->id }}"> --}}
                                    
                                    <div id="jamMasuk{{ $data->id }}">
                                        
                                        @php
                                            $loopBreakDataDCUMasuk = true;
                                        @endphp
                                        @if(Session::get('resetTimesheet') == 'false')
                                            @forelse ($data->dcurecap->where('tanggal', Session::get('dateThisDay')) as $dataDCU) 
                                                @if($data->id == $dataDCU->manpower_id && $dataDCU->status_dcu !== "UNFIT")
                                                        @foreach ($timesheet as $dataTimesheet)
                                                            {{-- {{ dd($dataTimesheet->dcurecap_id) }} --}}
                                                            {{-- {{ dd($dataDCU->id) }} --}}
                                                            @if($dataTimesheet->dcurecap_id == $dataDCU->id && $dataDCU->status_dcu !== "UNFIT" && $dataTimesheet->jamMasuk != null)
                                                                {{-- {!! "<b>$dataTimesheet->jamMasuk" !!} --}}
                                                                <span id="textJamMasuk{{ $data->id }}">{!! "<b>$dataTimesheet->jamMasuk" !!}</span>
                                                                <input type="time" style="display: none" id="ubahJamMasuk{{ $data->id }}" onchange="ubahJamMasuk({{ $data->id }})">
                                                                    
                                                                {{-- keterangan tapi di hidden --}}
                                                                <span style="display: none" id="keteranganMasuk{{ $data->id }}">{{ $dataTimesheet->keterangan_masuk }}</span>
                                                                
                                                                @if($dataTimesheet->keterangan_masuk != null)
                                                                    <span class="material-symbols-outlined m-2" style="cursor: default;" id="icon-showing-note-masuk-kerja{{ $data->id }}" onclick="showNoteMasukKerja({{$data->id }})">
                                                                        description
                                                                    </span>
                                                                @endif
                                                                @php
                                                                    
                                                                    $loopBreakDataDCUMasuk = false;

                                                                    // $_SESSION['id'][0]
                                                                    array_push($_SESSION['id'], $data->id);
                                                                    
                                                                @endphp
                                                                @break

                                                                {{-- <button type="button" class="btn btn-success p-1 pt-0"  id="btn-masuk-kerja{{ $data->id }}" onclick="startMasukKerja({{ $data->id }})">Masuk woy</button>
                                                                @break --}}
                                                            @endif
                                                        
                                                            {{-- <button class="btn btn-secondary p-1 pt-0" disabled>Masuk</button> --}}
                                                            {{-- <span class="btn btn-success p-1 pt-0" id="btn-masuk-kerja{{ $data->id }}" onclick="startMasukKerja({{ $data->id }})">Masuk</span> --}}
                                                        @endforeach
                                                        @if($loopBreakDataDCUMasuk == false) @break @endif

                                                        {{-- aktifin lagi ya --}}
                                                        <button type="button"  class="btn btn-success p-1 pt-0"  id="btn-masuk-kerja{{ $data->id }}" onclick="startMasukKerja({{ $data->id }})">Masuk</button>
                                                    {{-- @continue --}}
                                                
                                                @endif
                                            @empty
                                                <button type="button" style="display: none" class="btn btn-secondary p-1 pt-0" disabled>Masuk</button>
                                            @endforelse
                                        @endif
                                        {{-- <button class="btn btn-secondary p-1 pt-0" id="btn-masuk-kerja{{ $data->id }}" onclick="startMasukKerja({{ $data->id }})" disabled>Masuk</button> --}}
                                    </div>
                                    {{-- <span class="material-symbols-outlined m-2" style="display: none; cursor: default;" id="icon-showing-note-masuk-kerja{{ $data->id }}" onclick="showNoteMasukKerja({{$data->id }})">
                                        description
                                    </span> --}}
                                    {{-- The function of this float is showing input form when option selected is value 2 or Fit With Note --}}
                                    <div class="p-2 rounded" style="background: grey ;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%); width: max-content; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); display: none" id="float-note-masuk-kerja{{ $data->id }}">
                                        <textarea class="rounded" name="" id="textarea-float-note-masuk-kerja{{ $data->id }}" cols="20" rows="5" placeholder="*opsional, Ketikkan keterangan disini..." ></textarea>
                                        <div class="ms-auto" style="width: max-content">
                                            <span class="btn btn-sm btn-secondary" id="btn-cancel-float-note-masuk-kerja" onclick="cancelMasukKerja({{ $data->id }})">Cancel</span>
                                            <span class="btn btn-sm btn-primary" id="btn-yes-float-note-masuk-kerja" onclick="yesMasukKerja({{ $data->id }})">Masuk</span>
                                        </div>
                                    </div>
                                    {{-- The function of this float is showing sticky note of masuk kerja --}}
                                    <div class="float-sticky-note"  style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%); width: max-content; display: none" id="float-sticky-note-masuk-kerja{{ $data->id }}">
                                        <ul>
                                            <li>
                                            <a href="#">
                                                <h6>Keterangan Absen Masuk</h6>
                                                <hr>
                                                <p id="konten-sticky-note-masuk-kerja{{ $data->id }}"></p>
                                            </a>
                                            
                                            </li>
                                            <span class="material-symbols-outlined fw-bold text-danger" style="position: absolute; right: 3px; top: -12px; font-size: 30px; cursor: default; z-index: 6;" id="click_close_sticky_note_masuk_kerja" onclick="closeStickyNoteMasukKerja({{ $data->id }})">
                                                cancel
                                            </span>
                                        </ul>
                                        
                                    </div>
                                
                            </td>
                        
                            {{-- btn lembur kerja--}}
                            <td class="text-center" >
                                <div id="jamLembur{{ $data->id }}">
                                    @php
                                        $loopBreakDataDCULembur = true;
                                    @endphp
                                    @if(Session::get('resetTimesheet') == 'false')
                                        @forelse ($data->dcurecap->where('tanggal', Session::get('dateThisDay')) as $dataDCU) 
                                                    @foreach ($timesheet as $dataTimesheet)
                                                        @if($dataTimesheet->dcurecap_id == $dataDCU->id && $dataDCU->status_dcu !== "UNFIT"  && $dataTimesheet->jamLembur != null) 
                                                            <span id="textJamLembur{{ $data->id }}">{!! "<b>$dataTimesheet->jamLembur</b>" !!}</span>
                                                            <input type="time" style="display: none" id="ubahJamLembur{{ $data->id }}" onchange="ubahJamLembur({{ $data->id }})">

                                                            {{-- keterangan tapi di hidden --}}
                                                            <span style="display: none" id="keteranganLembur{{ $data->id }}" aria-label="ambilLembur">{{ $dataTimesheet->keterangan_lembur }}</span>
                                                            

                                                            @if($dataTimesheet->keterangan_lembur != null)
                                                                <span class="material-symbols-outlined m-2" style="cursor: default;" id="icon-showing-note-lembur-kerja{{ $data->id }}" onclick="showNoteLemburKerja({{$data->id }})">
                                                                    description
                                                                </span>
                                                            @endif
                                                            @php
                                                                $loopBreakDataDCULembur = false;
                                                                
                                                            @endphp
                                                            @break
                                                        @endif
                                                    @endforeach
                                                    @if($loopBreakDataDCULembur == false) @break @endif

                                                    {{-- aktifin lagi aja --}}
                                                    {{-- <button type="button" style="display: none" class="btn btn-success p-1 pt-0" id="btn-lembur-kerja{{ $data->id }}" onclick="startLemburKerja({{ $data->id }})">Lembur</button> --}}
                                                    
                                                    {{-- coba --}}
                                                    @php
                                                        $loopBreakDataDCUTotalLembur = true;
                                                    @endphp
                                                    @forelse ($data->dcurecap->where('tanggal', Session::get('dateThisDay')) as $dataDCU) 
                                                        @foreach ($timesheet->where('dcurecap_id', '') as $dataTimesheet)
                                                            @if($dataTimesheet->dcurecap_id == $dataDCU->id && $dataTimesheet->totalWaktuLembur == null && $dataTimesheet->jamPulang != null )
                                                                {{ "-" }}
                                                                @php
                                                                    $loopBreakDataDCULembur = false;
                                                                @endphp
                                                                @break
                                                            @endif
                                                        @endforeach
                                                            @if($loopBreakDataDCULembur == false) @break @endif
                                                            @if($dataDCU->status_dcu != "UNFIT")
                                                                <button type="button" style="display: 'none'" class="btn btn-success p-1 pt-0" id="btn-lembur-kerja{{ $data->id }}" onclick="startLemburKerja({{ $data->id }})">Lembur</button>
                                                            @endif
                                                        @empty
                                                        {{ "-" }}
                                                    @endforelse
                                                    {{-- end coba --}}
                                        @empty
                                            <button style="display: none" class="btn btn-secondary p-1 pt-0" disabled>Lembur</button>      
                                        @endforelse
                                    @endif
                                </div>
                                {{-- <span class="material-symbols-outlined m-2" style="display: none; cursor: default;" id="icon-showing-note-lembur-kerja{{ $data->id }}">
                                    description
                                </span> --}}
                                {{-- The function of this float is showing input form when option selected is value 2 or Fit With Note --}}
                                <div class="p-2 rounded" style="background: grey;position: absolute; top: 50%;left: 60%;transform: translate(-50%, -50%); width: max-content; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); display: none" id="float-note-lembur-kerja{{ $data->id }}">
                                    <textarea class="rounded" name="" id="textarea-float-note-lembur-kerja{{ $data->id }}" cols="20" rows="5" placeholder="*opsional, Ketikkan keterangan disini..." ></textarea>
                                    <div class="ms-auto" style="width: max-content">
                                        <span class="btn btn-sm btn-secondary" id="btn-cancel-float-note-lembur-kerja" onclick="cancelLemburKerja({{ $data->id }})">Cancel</span>
                                        <span class="btn btn-sm btn-primary" id="btn-yes-float-note-lembur-kerja" onclick="yesLemburKerja({{ $data->id }})">Lembur</span>
                                    </div>
                                </div>
                                {{-- The function of this float is showing sticky note of masuk kerja --}}
                                <div class="float-sticky-note"  style="position: absolute;top: 50%;left: 60%;transform: translate(-50%, -50%); width: max-content; display: none" id="float-sticky-note-lembur-kerja{{ $data->id }}">
                                    <ul>
                                        <li>
                                        <a href="#">
                                            <h6>Keterangan Masuk Lembur</h6>
                                            <hr>
                                            <p id="konten-sticky-note-lembur-kerja{{ $data->id }}"></p>
                                        </a>
                                        
                                        </li>
                                        <span class="material-symbols-outlined fw-bold text-danger" style="position: absolute; right: 3px; top: -12px; font-size: 30px; cursor: default; z-index: 6;" id="click_close_sticky_note_lembur_kerja" onclick="closeStickyNoteLemburKerja({{ $data->id }})">
                                            cancel
                                        </span>
                                    </ul>
                                    
                                </div>
                            </td>
                        
                            <td class="text-center">
                                <div id="jamPulang{{ $data->id }}">

                                @php
                                    $loopBreakDataDCUPulang = true;
                                @endphp
                                @if(Session::get('resetTimesheet') == 'false')
                                    @forelse ($data->dcurecap->where('tanggal', Session::get('dateThisDay')) as $dataDCU) 
                                        
                                        @foreach ($timesheet as $dataTimesheet)
                                            @if($dataTimesheet->dcurecap_id == $dataDCU->id && $dataDCU->status_dcu !== "UNFIT"  && $dataTimesheet->jamPulang != null && Session::get('resetTimesheet') == 'false') 
                                                {{-- {!! "<b>$dataTimesheet->jamPulang</b>" !!} --}}
                                                <span id="textJamPulang{{ $data->id }}">{!! "<b>$dataTimesheet->jamPulang</b>" !!}</span>
                                                <input type="time" style="display: none" id="ubahJamPulang{{ $data->id }}" onchange="ubahJamPulang({{ $data->id }})">

                                                {{-- <span id="textJamPulang{{ $data->id }}" >{!! "<b>$dataTimesheet->jamPulang</b>" !!}</span> --}}

                                                {{-- keterangan tapi di hidden --}}
                                                <span style="display: none" id="keteranganPulang{{ $data->id }}">{{ $dataTimesheet->keterangan_pulang }}</span>
                                                @if($dataTimesheet->keterangan_pulang != null)
                                                    <span class="material-symbols-outlined m-2" style="cursor: default;" id="icon-showing-note-pulang-kerja{{ $data->id }}" onclick="showNotePulangKerja({{$data->id }})">
                                                        description
                                                    </span>
                                                @endif
                                                @php
                                                    $loopBreakDataDCUPulang = false;
                                                @endphp
                                                @break
                                            @endif
                                        @endforeach
                                        @if($loopBreakDataDCUPulang == false) @break @endif

                                        @if($dataDCU->status_dcu != "UNFIT")
                                            <button type="button" style="display: none" aria-label="{{ Session::get('isPulang'.$data->id) }}" class="btn btn-success p-1 pt-0" id="btn-pulang-kerja{{ $data->id }}" onclick="startPulangKerja({{ $data->id }})">Pulang Bae</button>
                                        @endif
                                    
                                        
                                    @empty
                                        <button style="display: none" class="btn btn-secondary p-1 pt-0" disabled >Pulang AJa</button>
                                    @endforelse
                                @endif
                                    {{-- <span class="btn btn-success p-1 pt-0" id="btn-pulang-kerja" onclick="startPulangKerja({{ $data->id }})">Pulang</span> --}}
                                </div>
                                {{-- <span class="material-symbols-outlined m-2" style="display: none; cursor: default;" id="icon-showing-note-pulang-kerja{{ $data->id }}">
                                    description
                                </span> --}}
                                {{-- The function of this float is showing input form when option selected is value 2 or Fit With Note --}}
                                <div class="p-2 rounded" style="background: grey;position: absolute; top: 50%;left: 75%;transform: translate(-50%, -50%); width: max-content; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); display: none" id="float-note-pulang-kerja{{ $data->id }}">
                                    <textarea class="rounded" name="" id="textarea-float-note-pulang-kerja{{ $data->id }}" cols="20" rows="5" placeholder="*opsional, Ketikkan keterangan disini..." ></textarea>
                                    <div class="ms-auto" style="width: max-content">
                                        <span class="btn btn-sm btn-secondary" id="btn-cancel-float-note-pulang-kerja" onclick="cancelPulangKerja({{ $data->id }})">Cancel</span>
                                        <span class="btn btn-sm btn-primary" id="btn-yes-float-note-pulang-kerja{{ $data->id }}" onclick="yesPulangKerja({{ $data->id }})">Pulang</span>
                                    </div>
                                </div>
                                {{-- The function of this float is showing sticky note of masuk kerja --}}
                                <div class="float-sticky-note"  style="position: absolute;top: 50%;left: 75%;transform: translate(-50%, -50%); width: max-content; display: none" id="float-sticky-note-pulang-kerja{{ $data->id }}">
                                    <ul>
                                        <li>
                                        <a href="#">
                                            <h6>Keterangan Pulang Kerja</h6>
                                            <hr>
                                            <p id="konten-sticky-note-pulang-kerja{{ $data->id }}"></p>
                                        </a>
                                        
                                        </li>
                                        <span class="material-symbols-outlined fw-bold text-danger" style="position: absolute; right: 3px; top: -12px; font-size: 30px; cursor: default; z-index: 6;" id="click_close_sticky_note_pulang_kerja" onclick="closeStickyNotePulangKerja({{ $data->id }})">
                                            cancel
                                        </span>
                                    </ul>
                                    
                                </div>
                            </td>
                            <td class="text-center text-success fw-bolder" id="totalWaktuLembur{{ $data->id }}">
                                @php
                                    $loopBreakDataDCUTotalLembur = true;
                                @endphp
                                @if(Session::get('resetTimesheet') == 'false')
                                    @foreach($data->dcurecap->where('tanggal', Session::get('dateThisDay')) as $dataDCU) 
                                        @foreach ($timesheet as $dataTimesheet)
                                            @if($dataTimesheet->dcurecap_id == $dataDCU->id && $dataDCU->status_dcu !== "UNFIT"  && $dataTimesheet->totalWaktuLembur != null)
                                                {{ $dataTimesheet->totalWaktuLembur }}
                                                @php
                                                    $loopBreakDataDCUTotalLembur = false;
                                                @endphp
                                                @break
                                            @endif
                                        @endforeach
                                        @if($loopBreakDataDCUTotalLembur == false) @break @endif
                                        {{ "-" }}
                                    @endforeach
                                @endif
                            </td>
                        </form>
                    
                    <td class="text-center" style="cursor: default" id="aksi{{ $data->id }}">
                        @if(($data->dcurecap->where('manpower_id', $data->id)->first()) != null)

                            <div id="btnAksi{{ $data->id }}">
                                <span class="btn btn-sm btn-danger" onclick="aksiHapus({{ $data->id }}, {{ $dcurecap_id }})">Hapus</span>  
                                <span class="btn btn-sm btn-primary" onclick="aksiEdit({{ $data->id }})">Edit</span>
                            </div>
                            {{-- when aksi edit is clicked showing this button --}}
                            <div style="width: 100%; display: none" id="aksiChildEdit{{ $data->id }}">
                                <span style="width: 100%; display: flex; align-items: center; justify-content: space-evenly"  class="btn btn-sm btn-secondary mb-1" onclick="batalAksiEdit({{ $data->id }})"><span class="material-symbols-outlined">close_small</span>Batal Edit</span>
                                <span style="width: 100%; display: flex; align-items: center; justify-content: space-evenly"  class="btn btn-sm btn-primary mb-1" onclick="simpanAksiEdit({{ $data->id }}, {{ $dcurecap_id }})"><span class="material-symbols-outlined">check</span>Simpan</span>
                            </div>

                        @endif
                        
                    </td>
                    
                </tr>
            
            @empty

            
            @endforelse
              {{-- <tr>
                  <td class="text-center">2</td>
                  <td class="text-center">19-06-2024</td>
                  <td class="text-center">27501</td>
                  <td class="text-start">Projek Koordinator</td>
                  <td class="text-start">Kicu Freeze</td>
                  <td class="text-center">FIT</td>
                  <td class="text-center"><span class="btn btn-success p-1 pt-0">Masuk</span></td>
                  <td class="text-center"><span class="btn btn-secondary p-1 pt-0" disabled>Lembur</span></td>
                  <td class="text-center"><span class="btn btn-secondary p-1 pt-0" disabled>Pulang</span></td>
                  <td class="text-center">-</td>
                  <td class="text-center" style="cursor: default"><span class="text-danger">Hapus</span> | <span class="text-warning">Edit</span></td>
              </tr> --}}
          </tbody>
      </table>


      </div>

      {{-- @php
        print_r($_SESSION['id']);
      @endphp --}}
    @php
        $_SESSION['id'] = array();
    @endphp

    @foreach ($manpowers as $data)
        @php
            
            array_push($_SESSION['id'], $data->id);
        @endphp
    @endforeach

@endsection

@section('script')

<script>
    // $('document').ready(function() {

        // $('body').unload()

        // function hideWhenLoading() {
        getDate();
        

        let value = <?= json_encode($_SESSION['id']); ?>;
        // array_unique(value);
        console.log(value);
        // console.log('idnya : '+ id);
        value.forEach(function(id) {
            setInterval(async () => {
                
                await checkTime(id);
                $(document).ready(function() {
                    $(`#btn-masuk-kerja${id}`).show();
                    $(`#btn-lembur-kerja${id}`).show();
                    $(`#btn-pulang-kerja${id}`).show();
                });
            }, 5000);
        });

    function fillThisValue(sendInputName, acceptInputName) {
        // console.log($(`#${e}`).val());
        $(`#${acceptInputName}`).val($(`#${sendInputName}`).val());
        // $(`#inputKadarOksigenDarah${id}`).val($(`#inputKadarOksigenDarahCopy${id}`).val());
        // $(`#inputDetakJantung${id}`).val($(`#inputDetakJantungCopy${id}`).val());
        // $("#container-input-suhu-badan").css({"display": "block"});
        //     $("#container-form-dcu").css({"display": "block"});
    }

    // handle form float DCU
        function activeFloatFormDcu(id) {
            let kontenFromFormDcu =  $(`#container-form-dcu${id}`).html();
            $("#floating-form-dcu").html(kontenFromFormDcu);
            $("#floating-form-dcu").fadeIn(500);
            
            
            
        }

        function click_close_floating_form_dcu() {
            $("#floating-form-dcu").fadeOut(300);
        }

        // Function to handle the change event radio button DCU
        function handleRadioDCU(value) {
            switch (value) {
                case 'radio-suhu-badan-tdk-normal':
                    $("#container-input-suhu-badan").fadeIn(300);
                    break;
                case 'radio-oksigen-darah-tdk-normal':
                    $("#container-input-oksigen-darah").fadeIn(300);
                    break;
                case 'radio-detak-jantung-tdk-normal':
                    $("#container-input-detak-jantung").fadeIn(300);
                    break;
                case 'radio-tekanan-darah-tdk-normal':
                    $("#container-input-tekanan-darah").fadeIn(300);
                    break;

                case 'radio-suhu-badan-normal':
                    $("#container-input-suhu-badan").fadeOut(300);
                    break;
                case 'radio-oksigen-darah-normal':
                    $("#container-input-oksigen-darah").fadeOut(300);
                    break;
                case 'radio-detak-jantung-normal':
                    $("#container-input-detak-jantung").fadeOut(300);
                    break;
                case 'radio-tekanan-darah-normal':
                    $("#container-input-tekanan-darah").fadeOut(300);
                    break;
                default:
                // $("#container-input-note-dcu").fadeOut(300);
                    break;
            }
        }

        function kirim_form_dcu(id) {

            const radiosSuhuBadan = document.querySelectorAll('input[name="radioSuhuBadan"]');
            const radiosKadarOksigen = document.querySelectorAll('input[name="radioKadarOksigenDarah"]');
            const radiosDetakJantung = document.querySelectorAll('input[name="radioDetakJantung"]');
            const radiosTekananDarah = document.querySelectorAll('input[name="radioTekananDarah"]');

            const arrRadios = [radiosSuhuBadan, radiosKadarOksigen, radiosDetakJantung, radiosTekananDarah];

            let selectedValue = [];

            for(let i = 0; i < arrRadios.length; i++) {
                let radios = arrRadios[i];
                radios.forEach(radios => {
                if (radios.checked) {
                    selectedValue.push(radios.value);
                }
            });
            }

            if(selectedValue.includes('tdk-normal')) {
                $("#floating-form-dcu").fadeOut(300);
                // $(`#btn-dcu${$id}`).html("<b>UNFIT</b>");
                $(`#inputStatusDCU${id}`).val("UNFIT");
                $(`#btn-pulang-kerja${id}`).hide();
            } else {
                $("#floating-form-dcu").fadeOut(300);
                // $(`#btn-dcu${$id}`).html("<b>FIT</b>");
                $(`#inputStatusDCU${id}`).val("FIT");

                // ubah warna button masuk menjadi hijau dan dapat di klik
                // $(`#btn-masuk-kerja${id}`).removeAttr("disabled");
                // $(`#btn-masuk-kerja${id}`).removeClass("btn-secondary");
                // $(`#btn-masuk-kerja${id}`).addClass("btn-success");
            }

            
            let formDCU = document.getElementById(`formDCU${id}`);
            

            // update session date
            let getDayThisDay = $(`#inputDate${id}`).val();
            // kontol
            // let getDayThisDay = "2024-07-10";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                // 
                // Send data to Laravel using AJAX
            jQuery.ajax({
                url: '{{ route('updateDateSession') }}',
                type: 'POST',
                data: { // Add CSRF token
                    dateThisDay: getDayThisDay,
                },
                success: function(response) {
                    console.log('Data sent successfully:', response);
                    formDCU.submit();
                    // location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error sending data:', error);
                }
            });

            
        }

    // handle action button masuk kerja
        // $("#btn-masuk-kerja").click(function(){
        //     $("#float-note-masuk-kerja").fadeIn(500);
        // });

        function startMasukKerja(id) {
            $(`#float-note-masuk-kerja${id}`).fadeIn(500);
        }

        function yesMasukKerja(id) {
            let jamMasuk;

            updateClock().then((result) => {
                jamMasuk = result;
                // $(`#jamMasuk${id}`).html(`<b>${jamMasuk}</b>`);
                $(`#inputJamMasuk${id}`).val(`${jamMasuk}`);
                $("#container-form-select-dcu").html((`<b>${$("#form-select-dcu").val()}</b>`));
                // let valueTextareaFloatNote = $("#textarea-float-note").val();
                // $("#form-select-dcu option:selected").attr("aria-label", valueTextareaFloatNote);
                $(`#float-note-masuk-kerja${id}`).fadeOut(300);
                // Check the time every second
                // setInterval(checkTime(id), 1000);


                // alert($("#form-select-dcu option:selected").attr("aria-label"));
                if($(`#textarea-float-note-masuk-kerja${id}`).val() == "") {
                    $(`#icon-showing-note-masuk-kerja${id}`).hide();
                } else {
                    $(`#inputKeteranganMasuk${id}`).val($(`#textarea-float-note-masuk-kerja${id}`).val());
                    $(`#icon-showing-note-masuk-kerja${id}`).show();
                }

                let formTimeSheet = document.getElementById(`formTimesheet${id}`);
                formTimeSheet.submit(); 
                $(`#jamMasuk${id}`).html(`<b>${jamMasuk}</b>`);

                

                
            });

            
        }

        function cancelMasukKerja(id) {
            $(`#float-note-masuk-kerja${id}`).fadeOut(300);
        }
        // $("#btn-cancel-float-note-masuk-kerja").click(function(){
        //     $("#float-note-masuk-kerja").fadeOut(300);
        // });

        function showNoteMasukKerja(id) {
            let valueTextAreaMasukKerja = $(`#keteranganMasuk${id}`).text();
            $(`#konten-sticky-note-masuk-kerja${id}`).text(valueTextAreaMasukKerja);
            $(`#float-sticky-note-masuk-kerja${id}`).fadeIn(300);
        }

        function closeStickyNoteMasukKerja(id) {
            $(`#float-sticky-note-masuk-kerja${id}`).fadeOut(300);
        }

    // handle action button masuk lembur
        function startLemburKerja(id) {
            $(`#float-note-lembur-kerja${id}`).fadeIn(500);
        }
        // $("#btn-lembur-kerja").click(function(){
        //     $("#float-note-lembur-kerja").fadeIn(500);
        // });

        function yesLemburKerja(id) {
            let jamLembur;
            updateClock().then((result) => {
                jamLembur = result;
                // $(`#jamLembur${id}`).attr("aria-label", "ambilLembur");
                $(`#inputJamLembur${id}`).val(`${jamLembur}`);
                // $("#container-form-select-dcu").html((`<b>${$("#form-select-dcu").val()}</b>`));
                // let valueTextareaFloatNote = $("#textarea-float-note").val();
                // $("#form-select-dcu option:selected").attr("aria-label", valueTextareaFloatNote);
                $(`#float-note-lembur-kerja${id}`).fadeOut(300);
                // alert($("#form-select-dcu option:selected").attr("aria-label"));

                $("#btn-pulang-kerja").attr("disabled", true);
                $("#btn-pulang-kerja").removeClass("btn-success");
                $("#btn-pulang-kerja").addClass("btn-secondary");

                // to handle show and hide icon showing floating sticky note
                if($(`#textarea-float-note-lembur-kerja${id}`).val() == "") {
                    $(`#icon-showing-note-lembur-kerja${id}`).hide();
                } else {
                    $(`#inputKeteranganLembur${id}`).val($(`#textarea-float-note-lembur-kerja${id}`).val());
                    $(`#icon-showing-note-lembur-kerja${id}`).show();
                }
                
                let formTimeSheet = document.getElementById(`formTimesheet${id}`);
                formTimeSheet.submit(); 

                // $(`#jamLembur${id}`).html(`<b>${jamLembur}</b>`);
            });;

            
        }

        function cancelLemburKerja(id) {
            $(`#float-note-lembur-kerja${id}`).fadeOut(300);
        }


        function showNoteLemburKerja(id) {
            let valueTextArealemburKerja = $(`#keteranganLembur${id}`).text();
            $(`#konten-sticky-note-lembur-kerja${id}`).text(valueTextArealemburKerja);
            $(`#float-sticky-note-lembur-kerja${id}`).fadeIn(300);
        }

        function closeStickyNoteLemburKerja(id) {
            $(`#float-sticky-note-lembur-kerja${id}`).fadeOut(300);
        }

    // handle action button pulang kerja

        function startPulangKerja(id) {
            $(`#float-note-pulang-kerja${id}`).fadeIn(500);
        }

        function yesPulangKerja(id) {
            let jamPulang;
            updateClock().then((result) => {
                jamPulang = result;
                $(`#jamPulang${id}`).html(`<b>${jamPulang}</b>`);

                
                // $(`#textJamPulang${id}`).text(`<b>${jamPulang}</b>`);
               

                // $(`#textJamPulang${id}`).text(`<b>${jamPulang}</b>`);
                

                $(`#inputJamPulang${id}`).val(`${jamPulang}`);

                let getAriaLabelJamLembur = $(`#keteranganLembur${id}`).attr("aria-label");

                if(getAriaLabelJamLembur === "ambilLembur") {
                    // alert();
                    // Function to parse a time string in the format "HH:MM"
                    function parseTime(timeStr) {
                        let parts = timeStr.split(':');
                        let date = new Date();
                        date.setHours(parseInt(parts[0], 10));
                        date.setMinutes(parseInt(parts[1], 10));
                        date.setSeconds(0);
                        date.setMilliseconds(0);
                        return date;
                    }

                    // Function to calculate the difference between two times
                    function calculateTimeDifference(startTimeStr, endTimeStr) {
                        let startTime = parseTime(startTimeStr);
                        let endTime = parseTime(endTimeStr);

                        // Calculate the difference in milliseconds
                        let diff = endTime - startTime;

                        // If the difference is negative, it means the end time is on the next day
                        if (diff < 0) {
                            endTime.setDate(endTime.getDate() + 1);
                            diff = endTime - startTime;
                        }

                        // Convert the difference to hours, minutes, and seconds
                        let hours = Math.floor(diff / (1000 * 60 * 60));
                        let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        let seconds = Math.floor((diff % (1000 * 60)) / 1000);

                        return {
                            hours: hours,
                            minutes: minutes,
                            seconds: seconds
                        };
                    }

                    // Example usage
                    let getJamLembur = $(`#jamLembur${id}`).text();
                    let getJamPulang = $(`#jamPulang${id}`).text();
                    // let getJamPulang = $(`#textJamPulang${id}`).text();
                    // alert(`jam lembur : ${getJamLembur}`);
                    // alert(`jam pulang : ${getJamPulang}`);

                    let diff = calculateTimeDifference(getJamLembur, getJamPulang);
                    let totalWaktuLembur = `${diff.hours} Jam ${diff.minutes} Menit`;

                    // alert(`Time difference: ${diff.hours} hours, ${diff.minutes} minutes, ${diff.seconds} seconds`);
                    $(`#totalWaktuLembur${id}`).text(totalWaktuLembur);

                    $(`#inputTotalWaktuLembur${id}`).val(totalWaktuLembur);

                    // console.log(totalWaktuLembur);exit();
                } else {
                    $(`#jamLembur${id}`).html('-');
                    $(`#totalWaktuLembur${id}`).text('-');
                    // alert();
                }

                // to handle show and hide icon showing floating sticky note
                if($(`#textarea-float-note-pulang-kerja${id}`).val() == "") {
                    $(`#icon-showing-note-pulang-kerja${id}`).hide();
                } else {
                    $(`#inputKeteranganPulang${id}`).val($(`#textarea-float-note-pulang-kerja${id}`).val());
                    $(`#icon-showing-note-pulang-kerja${id}`).show();
                }

                $(`#float-note-pulang-kerja${id}`).fadeOut(300);

                let formTimeSheet = document.getElementById(`formTimesheet${id}`);
                formTimeSheet.submit(); 
            });

            
        }


        function cancelPulangKerja(id) {
            $(`#float-note-pulang-kerja${id}`).fadeOut(300);
        }

        function showNotePulangKerja(id) {
            let valueTextAreapulangKerja = $(`#keteranganPulang${id}`).text();
            $(`#konten-sticky-note-pulang-kerja${id}`).text(valueTextAreapulangKerja);
            $(`#float-sticky-note-pulang-kerja${id}`).fadeIn(300);
        }

        function closeStickyNotePulangKerja(id) {
            $(`#float-sticky-note-pulang-kerja${id}`).fadeOut(300);
        }



    async function getDate() {

        try {
            // throw new Error("fghj");
            const response =  await fetch('https://worldtimeapi.org/api/ip');
            if(response.ok) {
                const data = await response.json();
            
                const dateTime = data.datetime;

                // Extracting the date part
                const date = new Date(dateTime);
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
                const year = String(date.getFullYear()); // Get last two digits of the year

                const formattedDate = `${year}-${month}-${day}`;
                // alert(formattedDate);
                // $("#inputDate").val("2024-07-01");
                $(".inputDate").val(formattedDate);

                // hapus aja
                // send ajax to create new session hari
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                // //
                //     // Send data to Laravel using AJAX
                // jQuery.ajax({
                //     url: '{{ route('handleSession') }}',
                //     type: 'POST',
                //     data: { // Add CSRF token
                //         dateThisDay: "Seninnn" ,
                //         dateThisDay: 
                //     },

                //     success: function(response) {
                //         console.log('Data sent successfully tai:', response);
                //     },
                //     error: function(xhr, status, error) {
                //         console.error('Error sending data tai:', error);
                //     }
                // });
                

                
                return formattedTime;
            }
    
        } catch (error) {

        //    alert("Error, mungkin koneksi internet anda kurang bagus. Silahkan refresh");

            console.log( "<i>Error, Silahkan refresh</i>");

            // $('#myTable').hide();
            // window.stop();
            // if(confirm('Jaringan Koneksi Internet Anda Kurang Baik, silahkan refresh...')) {
                // window.location.reload();
            // }
        } 
    }


    async function updateClock() {
        try {
            // Fetch the current time from the World Time API
            const response = await fetch('https://worldtimeapi.org/api/ip');
            const data = await response.json();

            // Extract the current datetime from the response
            const currentTime = new Date(data.datetime);
            const hours = currentTime.getHours();
            const minutes = currentTime.getMinutes();
            const seconds = currentTime.getSeconds();
            const formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            
            return formattedTime;

        } catch (error) {
            // console.error('Error fetching the online time:', error);
            // document.getElementById('currentTime').textContent = 'Failed to fetch current time.';

            // $('#myTable').hide();
            // window.stop();
            // if(confirm('Jaringan Koneksi Internet Anda Kurang Baik, silahkan refresh...')) {
                // window.location.reload();
            // }
            // return "<i>Error, Silahkan refresh</i>";
        }
        
    }

    async function checkTime(id) {
        let hours;
        let minutes;
        let seconds;

        
        
        try {
            // Fetch the current time from the World Time API
            let response = await fetch('https://worldtimeapi.org/api/ip');

            // if(!response.ok) {
            //     $('body').hide();
            // } else {
            //     $('body').show();
            //     // exit();
            // }
            let data = await response.json();

            

            // Extract the current datetime from the response
            let currentTime = new Date(data.datetime);
            hours = currentTime.getHours();
            minutes = currentTime.getMinutes();
            seconds = currentTime.getSeconds();
            // const formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

            
       
        

            // if((hours >= 8 && hours <= 8) && minutes <= 30) {
            //     $(`#btn-dcu${id}`).show();
            // }

            // kontol
            let getDayThisDay = $(`#inputDate${id}`).val();
            // let getDayThisDay = "2024-07-13";
            // alert(getDayThisDay);

            if((hours >= 8 && hours <= 8) && minutes <= 30) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // 
                    // Send data to Laravel using AJAX
                jQuery.ajax({
                    url: '{{ route('handleSession') }}',
                    type: 'POST',
                    data: { // Add CSRF token
                        isHiddenBtnDCU: 'false' ,
                        dateThisDay: getDayThisDay,
                    },
                    success: function(response) {
                        // console.log('Data sent successfully:', response);
                        if($('#resetTimesheet').attr('aria-label') != response.resetTimesheet) {
                            window.location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error sending data:', error);
                    }
                });

            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // 
                    // Send data to Laravel using AJAX
                jQuery.ajax({
                    url: '{{ route('handleSession') }}',
                    type: 'POST',
                    data: { // Add CSRF token
                        // isHiddenBtnDCU: 'true' ,//ini aktifin lagi, ini yg bener
                        isHiddenBtnDCU: 'false' ,
                        dateThisDay: getDayThisDay, 
                    },

                    success: function(response) {
                        // console.log('Data sent successfully:', response);
                        if($('#resetTimesheet').attr('aria-label') != response.resetTimesheet) {
                            window.location.reload();
                        }
                        // console.log('kirik'+response.resetTimesheet);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error sending data:', error);


                    }
                });

            }
            

            // Check if the time is exactly 5:00:00 PM
            // console.log($(`#textJamMasuk${id}`).text());
            let timeStringJamMasuk = $(`#textJamMasuk${id}`).text();
            let getHourJamMasuk = timeStringJamMasuk.split(':')[0];
            // alert(getHourJamMasuk);
            // console.log(getHourJamMasuk);
            if(getHourJamMasuk != "") {
                // if (hours >= getHourJamMasuk && hours < 17) {
                if (false) {
                    // $(`#btn-dcu${id}`).show();
                    // enableBtnLemburAndBtnPulang();
                    disableBtnLemburAndBtnPulang(id);
                    // console.log($(`#jamLembur${id}`).text());
                    // console.log($("#jamLembur").attr("aria-label"));

                    // console.log("button lembur dan pulang jalan");
                    // alert("dobol");
                } else {
                    let getAriaLabelJamLembur = $(`#keteranganLembur${id}`).attr("aria-label");
                    // alert(`${getAriaLabelJamLembur}${id}`);

                    
                    // enableBtnLemburAndBtnPulang();
                
                    // if (true) {
                    //     enableBtnLemburAndBtnPulang(id);
                    //     // alert("enable button lembur dan pulang oke..");
                    // } 
                    

                    if(getAriaLabelJamLembur === "ambilLembur") {
                        console.log(`ambilLembur ceunah si id : ${id}`);
                        console.log("===================================");
                        // Calculate the future time (1 hour from time lembur)
                        // Time string (clock only)
                        // const timeString = $(`#jamLembur${id}`).text();
                        const timeString = $(`#textJamLembur${id}`).text();
                        console.log(timeString.replace(/\s/g, ""));
                        const currentDate = new Date();

                        // Extract the date components (year, month, day)
                        const year = currentDate.getFullYear();
                        const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Months are zero-based, so add 1
                        const day = String(currentDate.getDate()).padStart(2, '0');

                        // Combine the date components with the time string
                        const dateTimeString = `${year}-${month}-${day}T${timeString}`;
                        let date = new Date(dateTimeString);
                        date = date.getTime() + 1 * 60 * 60 * 1000;
                        const hoursUTC = Math.floor((date / (1000 * 60 * 60)) % 24);

                        // Convert milliseconds to hours in local time
                        const dateFromMilliseconds = new Date(date);
                        const hoursLocal = dateFromMilliseconds.getHours();
                        const minutesLocal = dateFromMilliseconds.getMinutes();
                        const secondsLocal = dateFromMilliseconds.getSeconds();

                        // console.log(`hours local setelah lembur skrng : ${hoursLocal} : ${minutesLocal} : ${secondsLocal}`);

                        // $(`#btn-pulang-kerja${id}`).attr("disabled", true);
                        // $(`#btn-pulang-kerja${id}`).removeClass("btn-success");
                        // $(`#btn-pulang-kerja${id}`).addClass("btn-secondary");
                        
                        if (hours >= hoursLocal) {
                            if(minutes >= minutesLocal) {
                                console.log('minutes local : ' + minutesLocal);
                                if(seconds >= secondsLocal) {
                                    enableBtnPulang(id);

                                    // if(hours >= 22 && minute)
                                } 
                            } else {
                                disableBtnPulang(id);
                            }

                            if(hours >= 2) {
                                const timeFormat = /\b([01]\d|2[0-3]):([0-5]\d):([0-5]\d)\b/g;
                                let getJamPulang = ($(`#jamPulang${id}`).text()).match(timeFormat);
                                // let getJamPulang = ($(`#textJamPulang${id}`).text()).match(timeFormat);
                                // console.log(`jam pulang tai : ${getJamPulang}`);

                                let getAriaBtnPulang =  $(`#btn-pulang-kerja${id}`).attr('aria-label');
                                console.log('isi pulang ' + getAriaBtnPulang);
                                if(getAriaBtnPulang == 'true') {
                                    // alert("sekali doang babik");
                                    let btnYesJamPulang = document.getElementById(`btn-yes-float-note-pulang-kerja${id}`);
                                    
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    // 
                                        // Send data to Laravel using AJAX
                                    jQuery.ajax({
                                        url: `/updatePulangSession/${id}`,
                                        type: 'POST',
                                        data: { // Add CSRF token
                                            // isHiddenBtnDCU: 'true' ,
                                            isPulang: 'false',
                                        },

                                        success: function(response) {
                                            console.log('Data sent pulang successfully:', response);
                                            console.log('kirik');
                                            btnYesJamPulang.click();
                                        },
                                        error: function(xhr, status, error) {
                                            console.error('Error sending data pulang:', error);
                                        }
                                    });
                                }
                            }
                            // alert("berhasil");
                        } else {
                            // disableBtnPulang(id);
                            // debug
                            enableBtnPulang(id);
                            // end debug
                        }
                        // if (true) {
                        //     enableBtnPulang(id);
                        // } else {
                        //     disableBtnPulang(id);
                        // }
                        // if (true) {
                        //     enableBtnPulang();
                        // } 
                    } else {
                        enableBtnLemburAndBtnPulang(id);
                        //set session bahwa nilai session pulang nya true
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        
                            // Send data to Laravel using AJAX
                        jQuery.ajax({
                            url: `/updatePulangSession/${id}`,
                            type: 'POST',
                            data: { // Add CSRF token
                                // isHiddenBtnDCU: 'true' ,
                                isPulang: 'true',
                            },

                            success: function(response) {
                                console.log('Data sent pulang successfully:', response);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error sending data pulang:', error);
                            }
                        });
                    }
                }
            } else {
                
                disableBtnLemburAndBtnPulang(id);
            }

            // throw new Error("Something went wrong");
            
        } catch (error) {
            console.error('Error fetching the online time:', error);
            // window.location.reload();
            // $('document').hide();
            // window.stop();
            // window.addEventListener('beforeunload', function (e) {
            //     e.preventDefault();
            //     e.returnValue = '';
            // });
            
            setInterval(() => {
                $('#myTable').hide();
            }, 5000);
            
           
            if(confirm('Jaringan Koneksi Internet Anda Kurang Baik, silahkan refresh...')) {
                window.location.reload();
            } else {
                $('#myTable').hide();
            }
            // console.log('Failed to fetch current time.');
        }

    }

    // function hideBtnDCU(id) {
    //     $(`#btn-dcu${id}`).hide();
    // }

    function disableBtnLemburAndBtnPulang(id) {
        // alert("kirik");
        
        $(`#btn-lembur-kerja${id}`).attr("disabled", true);
        $(`#btn-lembur-kerja${id}`).addClass("btn-secondary");
        $(`#btn-lembur-kerja${id}`).removeClass("btn-success");

        $(`#btn-pulang-kerja${id}`).attr("disabled", true);
        $(`#btn-pulang-kerja${id}`).addClass("btn-secondary");
        $(`#btn-pulang-kerja${id}`).removeClass("btn-success");
    }

    function enableBtnLemburAndBtnPulang(id) {
        // alert("kirik");
        
        $(`#btn-lembur-kerja${id}`).removeAttr("disabled");
        $(`#btn-lembur-kerja${id}`).removeClass("btn-secondary");
        $(`#btn-lembur-kerja${id}`).addClass("btn-success");
        $(`#btn-pulang-kerja${id}`).removeAttr("disabled");
        $(`#btn-pulang-kerja${id}`).removeClass("btn-secondary");
        $(`#btn-pulang-kerja${id}`).addClass("btn-success");
    }

    function disableBtnPulang(id) {
        // alert("boleh pualng");
        $(`#btn-pulang-kerja${id}`).attr("disabled", true);
        $(`#btn-pulang-kerja${id}`).removeClass("btn-success");
        $(`#btn-pulang-kerja${id}`).addClass("btn-secondary");
    }

    function enableBtnPulang(id) {
        // alert("boleh pualng");
        $(`#btn-pulang-kerja${id}`).removeAttr("disabled");
        $(`#btn-pulang-kerja${id}`).removeClass("btn-secondary");
        $(`#btn-pulang-kerja${id}`).addClass("btn-success");
    }

    function aksiHapus(id, dcurecap_id) {

        $(`#formTimesheet${id}`).attr('action', `/dashboard/destroyDcuTimesheet/${dcurecap_id}`);

        $(`#formTimesheet${id}`).submit();
    }

    function aksiEdit(id) {
        // alert(id);
        $(`#btnAksi${id}`).hide();
        $(`#aksiChildEdit${id}`).show();
        $(`#ubahStatusDCU${id}`).show();
        $(`#textJamMasuk${id}`).hide();
        $(`#ubahJamMasuk${id}`).show();
        $(`#textJamLembur${id}`).hide();
        $(`#ubahJamLembur${id}`).show();
        $(`#textJamPulang${id}`).hide();
        $(`#ubahJamPulang${id}`).show();
    }

    function batalAksiEdit(id) {
        // alert();
        $(`#btnAksi${id}`).show();
        $(`#aksiChildEdit${id}`).hide();
        $(`#ubahStatusDCU${id}`).hide();
        $(`#textJamMasuk${id}`).show();
        $(`#ubahJamMasuk${id}`).hide();
        $(`#textJamLembur${id}`).show();
        $(`#ubahJamLembur${id}`).hide();
        $(`#textJamPulang${id}`).show();
        $(`#ubahJamPulang${id}`).hide();
        
        $(`#formDCU${id}`).attr('action', `/dashboard/storeDCU/${id}`);
        $(`#formTimesheet${id}`).attr('action', `/dashboard/storeTimesheet/${id}/${dcurecap_id}`);

    }

    function simpanAksiEdit(id, dcurecap_id) {

        $(`#formTimesheet${id}`).attr('action', `/dashboard/updateTimesheet/${id}/${dcurecap_id}`);

        $(`#formTimesheet${id}`).submit();
    }

    function ubahStatusDCU(id) {
        // alert(id);
        $(`#formDCU${id}`).attr('action', `/dashboard/updateDCU/${id}`);

        activeFloatFormDcu(id);
    }

    function ubahJamMasuk(id) {
        // alert(id);
        let ubahJamMasuk = $(`#ubahJamMasuk${id}`).val();
        $(`#inputUbahJamMasuk${id}`).val(`${ubahJamMasuk}:00`);
    }

    function ubahJamLembur(id) {
        // alert(id);
        let ubahJamLembur = $(`#ubahJamLembur${id}`).val();
        $(`#inputUbahJamLembur${id}`).val(`${ubahJamLembur}:00`);
    }

    function ubahJamPulang(id) {
        // alert(id);
        let ubahJamPulang = $(`#ubahJamPulang${id}`).val();
        $(`#inputUbahJamPulang${id}`).val(`${ubahJamPulang}:00`);
    }
    
</script>


{{-- script untuk handle sticky note jangan utak atik ga ngerti jga gw --}}
<script>
    $(document).ready(function () {
        all_notes = $("#sticky-note li a");

        all_notes.on("keyup", function () {
            note_title = $(this).find("h2").text();
            note_content = $(this).find("p").text();

            item_key = "list_" + $(this).parent().index();

            data = {
            title: note_title,
            content: note_content
            };

            window.localStorage.setItem(item_key, JSON.stringify(data));
    });

    all_notes.each(function (index) {
        data = JSON.parse(window.localStorage.getItem("list_" + index));

        if (data !== null) {
        note_title = data.title;
        note_content = data.content;

        $(this).find("h2").text(note_title);
        $(this).find("p").text(note_content);
        }
    });
});
</script>



<script>
  //message with toastr
  @if(session()->has('success'))
  
      toastr.success('{{ session('success') }}', 'BERHASIL!'); 

  @elseif(session()->has('error'))

      toastr.error('{{ session('error') }}', 'GAGAL!'); 

  @elseif(session()->has('info'))

      toastr.info('{{ session('info') }}', 'Info!'); 
      
  @endif
</script>
@endsection