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

{{-- link untuk fitur export table html to pdf --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>

{{-- link date picker yang hanya dapa select atau pilih bulan dan tahun saja --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">

@endsection

@section('konten')
    {{-- content body --}}


      <div class="rounded bg-white p-2">
          <h5>Konfirmasi Perubahan Data Manpower</h5>
      </div>

      <div class="rounded bg-white mt-5 p-3" style="height: 70vh; overflow-x: scroll">
      {{-- title --}}
      <h4 class="fw-bolder mb-5">Konfirmasi Perubahan Data Manpower👷</h4>
    
      <br>
      
    
        {{-- <div class="card"><div class="card-body text-success">Data Manpower Person Sebelumnya</div></div> --}}

        
    <div class="card"><div class="card-body text-primary">Data Manpower Person Yang Sebelumnya</div></div>
    {{-- tabel manpower sebelum diubah--}}
    <table id="myTableBefore" class="display text-center">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Nama Pekerja</th>
                <th class="text-center">Tanggal Lahir</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">No KTP</th>
                <th class="text-center">Foto KTP</th>
                <th class="text-center">Foto Diri</th>
                <th class="text-center">Jenis Kelamin</th>
                <th class="text-center">Umur</th>
                {{-- <th class="text-center">Status Pekerja</th> --}}
                <th class="text-center">MCU</th>
                <th class="text-center">Kartu Induction</th>
                <th class="text-center">Kartu Badge</th>
                <th class="text-center">Keterangan</th>
                {{-- <th class="text-center">Lokasi Kerja</th> --}}
                <th class="text-center">SKCK</th>
                <th class="text-center">NPWP</th>
                <th class="text-center">CV</th>
                <th class="text-center">Sertifikat</th>
                <th class="text-center">Paklaring</th>
                <th class="text-center">Surat Vaksin</th>
            </tr>
        </thead>
        <tbody >
        {{-- @forelse ($dataManpowerBefore as $data) --}}
            <tr>
                <td class="text-center">1</td>
                <td class="text-center">{{ $manpowerBefore->jabatan }}</td>
                <td class="text-center">{{ $manpowerBefore->nama_pekerja }}</td>
                <td class="text-center">{{ $manpowerBefore->tanggal_lahir }}</td>
                <td class="text-center">{{ $manpowerBefore->alamat }}</td>
                <td class="text-center">{{ ($manpowerBefore->no_KTP == null) ? '-' : $manpowerBefore->no_KTP }}</td>
                <td class="text-center" >
                @if($manpowerBefore->foto_KTP != null) 
                    <img class="mb-2" src="{{ asset('storage/manpowers/fotoktp/'.$manpowerBefore->foto_KTP) }}" alt="foto ktp" style="max-width: 100px">
                    {{-- <span>Lihat</span> --}}
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_foto_ktp" onclick="click_lihat_foto_ktp({{ $manpowerBefore->id }})">visibility</span>
                    {{-- float image when click --}}
                    <div id="float_foto_ktp{{ $manpowerBefore->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;">
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%); width: 300px">
                            <img src="{{ asset('storage/manpowers/fotoktp/'.$manpowerBefore->foto_KTP) }}" alt="Foto KTP" style="max-width: 100%; scale: 2">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -180px; top: -130px; font-size: 50px; cursor: default" onclick="click_close_floating_documents()">
                            cancel
                            </span>
                        </div>
                        </div>
                    </div>
                @else
                    -
                @endif
                </td>
                <td class="text-center">
                @if($manpowerBefore->foto_diri != null)
                    <img class="border rounded" src="{{ asset('storage/manpowers/fotodiri/'.$manpowerBefore->foto_diri) }}" alt="foto-diri" style="width: 90px; height: 90px">
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_foto_diri" onclick="click_lihat_foto_diri({{ $manpowerBefore->id }})">visibility</span>
                    {{-- float image when click --}}
                    <div id="float_foto_diri{{ $manpowerBefore->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;">
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%); width: 300px">
                            <img src="{{ asset('storage/manpowers/fotodiri/'.$manpowerBefore->foto_diri) }}" alt="Foto diri" style="max-width: 100%;">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -40px; top: -30px; font-size: 50px; cursor: default" onclick="click_close_floating_documents()">
                            cancel
                            </span>
                        </div>
                        </div>
                    </div>
                @else
                        -
                @endif
                </td>
                <td class="text-center">{{ $manpowerBefore->jenis_kelamin }}</td>
                {{-- umur --}}
                <td class="text-center">{{ $manpowerBefore->umur }} tahun</td>
                {{-- status karyawan --}}
                {{-- <td class="text-center">
                @if($manpowerBefore->status_pekerja != null)
                    <span class="fw-bolder">{{ $manpowerBefore->status_pekerja }}</span><br>
                @else
                    -
                @endif
                </td> --}}

                <td>
                @if ($manpowerBefore->mcu !== null)
                    Sudah
                
                
                
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_mcu" onclick="click_lihat_surat_mcu({{ $manpowerBefore->id }})">Lihat</span> --}}

                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_mcu" onclick="click_lihat_surat_mcu({{ $manpowerBefore->id }})">visibility</span>
                    
                    <div id="float_surat_mcu{{ $manpowerBefore->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <embed src="{{ asset('storage/manpowers/suratmcu/'.$manpowerBefore->mcu) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                                cancel
                                </span>
                        </div>
                        </div>
                    </div>
                    @else
                    -
                    @endif
                </td>
                <td class="text-center">
                @if ($manpowerBefore->kartu_induction !== null)
                    <img src="{{ asset('storage/manpowers/foto_kartu_induction/'.$manpowerBefore->kartu_induction) }}" alt="foto kartu induction" style="max-width: 80px"> 
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_induction" onclick="click_lihat_kartu_induction({{ $manpowerBefore->id }})">Lihat</span>  --}}
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_induction" onclick="click_lihat_kartu_induction({{ $manpowerBefore->id }})">visibility</span>
                    {{-- float kartu induction --}}
                    <div id="float_kartu_induction{{ $manpowerBefore->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <img src="{{ asset('storage/manpowers/foto_kartu_induction/'.$manpowerBefore->kartu_induction) }}" alt="kartu induction" style="max-width: 100%; scale: 1.5">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -80px; top: -110px; font-size: 50px; cursor: default" onclick="click_close_floating_documents()">
                            cancel
                            </span>
                        </div>
                        </div>
                    </div>
                @else
                    -
                @endif
                </td>
                <td class="text-center">
                {{-- <b>{{ $manpowerBefore->no_kartu_badge }}</b>  --}}
                @if ($manpowerBefore->kartu_badge !== null)
                    <input style="border: none ; background: transparent; font-weight: 700; max-width: 100px" id="no_kartu_badge" type="text" value="{{ $manpowerBefore->no_kartu_badge }}" disabled>
                    <img src="{{ asset('storage/manpowers/foto_kartu_badge/'.$manpowerBefore->kartu_badge) }}" alt="kartu badge" style="max-width: 100px"> 
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_badge" onclick="click_lihat_kartu_badge({{ $manpowerBefore->id }})">Lihat</span>  --}}
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_badge" onclick="click_lihat_kartu_badge({{ $manpowerBefore->id }})">visibility</span>
                    {{-- float kartu badge --}}
                    <div id="float_kartu_badge{{ $manpowerBefore->id }}" style="display: none">
                    <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <img src="{{ asset('storage/manpowers/foto_kartu_badge/'.$manpowerBefore->kartu_badge) }}" alt="kartu badge" style="max-width: 100%; scale: 1.5">
                        <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -100px; top: -80px; font-size: 50px; cursor: default" onclick="click_close_floating_documents()">
                            cancel
                            </span>
                        </div>
                    </div>
                    </div>
                @else
                    -
                @endif
                </td>
                <td class="text-center">{{ ($manpowerBefore->keterangan == null) ? '-' : $manpowerBefore->keterangan }}</td>
                {{-- <td class="text-center">{{ ($manpowerBefore->lokasi_kerja == null) ? '-' : $manpowerBefore->lokasi_kerja }}</td> --}}
                <td class="text-center">
                @if ($manpowerBefore->skck !== null)
                    Ada
                    
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_skck" onclick="click_lihat_surat_skck({{ $manpowerBefore->id }})">Lihat</span> --}}
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_skck" onclick="click_lihat_surat_skck({{ $manpowerBefore->id }})">visibility</span>

                    <div id="float_surat_skck{{ $manpowerBefore->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <embed src="{{ asset('storage/manpowers/suratskck/'.$manpowerBefore->skck) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                                cancel
                                </span>
                        </div>
                        </div>
                    </div>
                @else
                    -
                @endif
                </td>
                <td class="text-center">
                @if ($manpowerBefore->npwp !== null)
                    Ada
                    
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_npwp" onclick="click_lihat_kartu_npwp({{ $manpowerBefore->id }})">Lihat</span> --}}
                    
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_npwp" onclick="click_lihat_kartu_npwp({{ $manpowerBefore->id }})">visibility</span>
                    
                    <div id="float_kartu_npwp{{ $manpowerBefore->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <embed src="{{ asset('storage/manpowers/kartunpwp/'.$manpowerBefore->npwp) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                                cancel
                                </span>
                        </div>
                        </div>
                    </div>  
                @else
                    -
                @endif
                </td>   
                <td class="text-center">
                @if ($manpowerBefore->cv !== null)
                    Ada
                    
                {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_cv" onclick="click_lihat_cv({{ $manpowerBefore->id }})">Lihat</span> --}}
                
                <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_cv" onclick="click_lihat_cv({{ $manpowerBefore->id }})">visibility </span>

                    <div id="float_cv{{ $manpowerBefore->id }}" style="display: none">
                    <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <embed src="{{ asset('storage/manpowers/cv/'.$manpowerBefore->cv) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                            cancel
                            </span>
                        </div>
                    </div>
                    </div> 
                @else
                    -
                @endif 
                </td>   
                <td class="text-center">
                @if ($manpowerBefore->sertifikat !== null)
                    Ada
                    
                    <br><span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_sertifikat" onclick="click_lihat_sertifikat({{ $manpowerBefore->id }})">Lihat</span>
                    
                    <div id="float_sertifikat{{ $manpowerBefore->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <embed src="{{ asset('storage/manpowers/sertifikat/'.$manpowerBefore->sertifikat) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                                cancel
                                </span>
                        </div>
                        </div>
                    </div>  
                @else
                    -
                @endif
                </td>   
                <td class="text-center">
                @if ($manpowerBefore->paklaring !== null)
                    Ada
                    
                    <br>
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_paklaring" onclick="click_lihat_paklaring({{ $manpowerBefore->id }})">Lihat --}}
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_paklaring" onclick="click_lihat_paklaring({{ $manpowerBefore->id }})">visibility</span>

                    <div id="float_paklaring{{ $manpowerBefore->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <embed src="{{ asset('storage/manpowers/paklaring/'.$manpowerBefore->paklaring) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                                cancel
                                </span>
                        </div>
                        </div>
                    </div>  
                @else
                -
                @endif 
                </td>
                <td class="text-center">
                @if ($manpowerBefore->surat_vaksin !== null)
                    Ada
                
                    <br>
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_vaksin" onclick="click_lihat_surat_vaksin({{ $manpowerBefore->id }})">Lihat</span> --}}
                    
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_vaksin" onclick="click_lihat_surat_vaksin({{ $manpowerBefore->id }})">visibility</span>

                    <div id="float_surat_vaksin{{ $manpowerBefore->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <embed src="{{ asset('storage/manpowers/suratvaksin/'.$manpowerBefore->surat_vaksin) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                                cancel
                                </span>
                        </div>
                        </div>
                    </div> 
                @else
                    -
                @endif
                </td>
            </tr>
            {{-- @empty --}}
            {{-- <div class="alert alert-danger">
                Data Manpower belum Tersedia.
            </div> --}}
        {{-- @endforelse --}}
        </tbody>
    </table>

    <div class="card"><div class="card-body text-danger">Data Manpower Person Yang Diubah</div></div>
    {{-- tabel manpower setelah diubah--}}
    <table id="myTableAfter" class="display text-center">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Nama Pekerja</th>
                <th class="text-center">Tanggal Lahir</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">No KTP</th>
                <th class="text-center">Foto KTP</th>
                <th class="text-center">Foto Diri</th>
                <th class="text-center">Jenis Kelamin</th>
                <th class="text-center">Umur</th>
                {{-- <th class="text-center">Status Pekerja</th> --}}
                <th class="text-center">MCU</th>
                <th class="text-center">Kartu Induction</th>
                <th class="text-center">Kartu Badge</th>
                <th class="text-center">Keterangan</th>
                {{-- <th class="text-center">Lokasi Kerja</th> --}}
                <th class="text-center">SKCK</th>
                <th class="text-center">NPWP</th>
                <th class="text-center">CV</th>
                <th class="text-center">Sertifikat</th>
                <th class="text-center">Paklaring</th>
                <th class="text-center">Surat Vaksin</th>
            </tr>
        </thead>
        <tbody >
        {{-- @forelse ($manpowerAfter as $data) --}}
            <tr>
                <td class="text-center">1</td>
                <td class="text-center">{{ $manpowerBefore->jabatan }}</td>
                <td class="text-center">{{ $manpowerAfter->nama_pekerja }}</td>
                <td class="text-center">{{ $manpowerAfter->tanggal_lahir }}</td>
                <td class="text-center">{{ $manpowerAfter->alamat }}</td>
                <td class="text-center">{{ ($manpowerAfter->no_KTP == null) ? '-' : $manpowerAfter->no_KTP }}</td>
                <td class="text-center" >
                @if($manpowerAfter->foto_KTP != null) 
                    <img class="mb-2" src="{{ asset('storage/manpowers/fotoktp/'.$manpowerAfter->foto_KTP) }}" alt="foto ktp" style="max-width: 100px">
                    {{-- <span>Lihat</span> --}}
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_foto_ktp" onclick="click_lihat_foto_ktp({{ $manpowerAfter->id }})">visibility</span>
                    {{-- float image when click --}}
                    <div id="float_foto_ktp{{ $manpowerAfter->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;">
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%); width: 300px">
                            <img src="{{ asset('storage/manpowers/fotoktp/'.$manpowerAfter->foto_KTP) }}" alt="Foto KTP" style="max-width: 100%; scale: 2">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -180px; top: -130px; font-size: 50px; cursor: default" onclick="click_close_floating_documents()">
                            cancel
                            </span>
                        </div>
                        </div>
                    </div>
                @else
                    -
                @endif
                </td>
                <td class="text-center">
                @if($manpowerAfter->foto_diri != null)
                    <img class="border rounded" src="{{ asset('storage/manpowers/fotodiri/'.$manpowerAfter->foto_diri) }}" alt="foto-diri" style="width: 90px; height: 90px">
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_foto_diri" onclick="click_lihat_foto_diri({{ $manpowerAfter->id }})">visibility</span>
                    {{-- float image when click --}}
                    <div id="float_foto_diri{{ $manpowerAfter->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;">
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%); width: 300px">
                            <img src="{{ asset('storage/manpowers/fotodiri/'.$manpowerAfter->foto_diri) }}" alt="Foto diri" style="max-width: 100%;">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -40px; top: -30px; font-size: 50px; cursor: default" onclick="click_close_floating_documents()">
                            cancel
                            </span>
                        </div>
                        </div>
                    </div>
                @else
                        -
                @endif
                </td>
                <td class="text-center">{{ $manpowerAfter->jenis_kelamin }}</td>
                {{-- umur --}}
                <td class="text-center">{{ $manpowerAfter->umur }} tahun</td>
                {{-- status karyawan --}}
                {{-- <td class="text-center">
                @if($manpowerAfter->status_pekerja != null)
                    <span class="fw-bolder">{{ $manpowerAfter->status_pekerja }}</span><br>
                @else
                    -
                @endif
                </td> --}}

                <td>
                @if ($manpowerAfter->mcu !== null)
                    Sudah
                
                
                
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_mcu" onclick="click_lihat_surat_mcu({{ $manpowerAfter->id }})">Lihat</span> --}}

                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_mcu" onclick="click_lihat_surat_mcu({{ $manpowerAfter->id }})">visibility</span>
                    
                    <div id="float_surat_mcu{{ $manpowerAfter->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <embed src="{{ asset('storage/manpowers/suratmcu/'.$manpowerAfter->mcu) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                                cancel
                                </span>
                        </div>
                        </div>
                    </div>
                    @else
                    -
                    @endif
                </td>
                <td class="text-center">
                @if ($manpowerAfter->kartu_induction !== null)
                    <img src="{{ asset('storage/manpowers/foto_kartu_induction/'.$manpowerAfter->kartu_induction) }}" alt="foto kartu induction" style="max-width: 80px"> 
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_induction" onclick="click_lihat_kartu_induction({{ $manpowerAfter->id }})">Lihat</span>  --}}
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_induction" onclick="click_lihat_kartu_induction({{ $manpowerAfter->id }})">visibility</span>
                    {{-- float kartu induction --}}
                    <div id="float_kartu_induction{{ $manpowerAfter->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <img src="{{ asset('storage/manpowers/foto_kartu_induction/'.$manpowerAfter->kartu_induction) }}" alt="kartu induction" style="max-width: 100%; scale: 1.5">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -80px; top: -110px; font-size: 50px; cursor: default" onclick="click_close_floating_documents()">
                            cancel
                            </span>
                        </div>
                        </div>
                    </div>
                @else
                    -
                @endif
                </td>
                <td class="text-center">
                {{-- <b>{{ $manpowerAfter->no_kartu_badge }}</b>  --}}
                @if ($manpowerAfter->kartu_badge !== null)
                    <input style="border: none ; background: transparent; font-weight: 700; max-width: 100px" id="no_kartu_badge" type="text" value="{{ $manpowerAfter->no_kartu_badge }}" disabled>
                    <img src="{{ asset('storage/manpowers/foto_kartu_badge/'.$manpowerAfter->kartu_badge) }}" alt="kartu badge" style="max-width: 100px"> 
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_badge" onclick="click_lihat_kartu_badge({{ $manpowerAfter->id }})">Lihat</span>  --}}
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_badge" onclick="click_lihat_kartu_badge({{ $manpowerAfter->id }})">visibility</span>
                    {{-- float kartu badge --}}
                    <div id="float_kartu_badge{{ $manpowerAfter->id }}" style="display: none">
                    <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <img src="{{ asset('storage/manpowers/foto_kartu_badge/'.$manpowerAfter->kartu_badge) }}" alt="kartu badge" style="max-width: 100%; scale: 1.5">
                        <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -100px; top: -80px; font-size: 50px; cursor: default" onclick="click_close_floating_documents()">
                            cancel
                            </span>
                        </div>
                    </div>
                    </div>
                @else
                    -
                @endif
                </td>
                <td class="text-center">{{ ($manpowerAfter->keterangan == null) ? '-' : $manpowerAfter->keterangan }}</td>
                {{-- <td class="text-center">{{ ($manpowerAfter->lokasi_kerja == null) ? '-' : $manpowerAfter->lokasi_kerja }}</td> --}}
                <td class="text-center">
                @if ($manpowerAfter->skck !== null)
                    Ada
                    
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_skck" onclick="click_lihat_surat_skck({{ $manpowerAfter->id }})">Lihat</span> --}}
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_skck" onclick="click_lihat_surat_skck({{ $manpowerAfter->id }})">visibility</span>

                    <div id="float_surat_skck{{ $manpowerAfter->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <embed src="{{ asset('storage/manpowers/suratskck/'.$manpowerAfter->skck) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                                cancel
                                </span>
                        </div>
                        </div>
                    </div>
                @else
                    -
                @endif
                </td>
                <td class="text-center">
                @if ($manpowerAfter->npwp !== null)
                    Ada
                    
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_npwp" onclick="click_lihat_kartu_npwp({{ $manpowerAfter->id }})">Lihat</span> --}}
                    
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_npwp" onclick="click_lihat_kartu_npwp({{ $manpowerAfter->id }})">visibility</span>
                    
                    <div id="float_kartu_npwp{{ $manpowerAfter->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <embed src="{{ asset('storage/manpowers/kartunpwp/'.$manpowerAfter->npwp) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                                cancel
                                </span>
                        </div>
                        </div>
                    </div>  
                @else
                    -
                @endif
                </td>   
                <td class="text-center">
                @if ($manpowerAfter->cv !== null)
                    Ada
                    
                {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_cv" onclick="click_lihat_cv({{ $manpowerAfter->id }})">Lihat</span> --}}
                
                <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_cv" onclick="click_lihat_cv({{ $manpowerAfter->id }})">visibility </span>

                    <div id="float_cv{{ $manpowerAfter->id }}" style="display: none">
                    <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <embed src="{{ asset('storage/manpowers/cv/'.$manpowerAfter->cv) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                            cancel
                            </span>
                        </div>
                    </div>
                    </div> 
                @else
                    -
                @endif 
                </td>   
                <td class="text-center">
                @if ($manpowerAfter->sertifikat !== null)
                    Ada
                    
                    <br><span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_sertifikat" onclick="click_lihat_sertifikat({{ $manpowerAfter->id }})">Lihat</span>
                    
                    <div id="float_sertifikat{{ $manpowerAfter->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <embed src="{{ asset('storage/manpowers/sertifikat/'.$manpowerAfter->sertifikat) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                                cancel
                                </span>
                        </div>
                        </div>
                    </div>  
                @else
                    -
                @endif
                </td>   
                <td class="text-center">
                @if ($manpowerAfter->paklaring !== null)
                    Ada
                    
                    <br>
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_paklaring" onclick="click_lihat_paklaring({{ $manpowerAfter->id }})">Lihat --}}
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_paklaring" onclick="click_lihat_paklaring({{ $manpowerAfter->id }})">visibility</span>

                    <div id="float_paklaring{{ $manpowerAfter->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <embed src="{{ asset('storage/manpowers/paklaring/'.$manpowerAfter->paklaring) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                                cancel
                                </span>
                        </div>
                        </div>
                    </div>  
                @else
                -
                @endif 
                </td>
                <td class="text-center">
                @if ($manpowerAfter->surat_vaksin !== null)
                    Ada
                
                    <br>
                    {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_vaksin" onclick="click_lihat_surat_vaksin({{ $manpowerAfter->id }})">Lihat</span> --}}
                    
                    <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_vaksin" onclick="click_lihat_surat_vaksin({{ $manpowerAfter->id }})">visibility</span>

                    <div id="float_surat_vaksin{{ $manpowerAfter->id }}" style="display: none">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <embed src="{{ asset('storage/manpowers/suratvaksin/'.$manpowerAfter->surat_vaksin) }}" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                                cancel
                                </span>
                        </div>
                        </div>
                    </div> 
                @else
                    -
                @endif
                </td>
            </tr>
            {{-- @empty --}}
            {{-- <div class="alert alert-danger">
                Data Manpower belum Tersedia.
            </div> --}}
        {{-- @endforelse --}}
        </tbody>
    </table>
    
    


    </div>

@endsection

@section('script')

<script>
    $(document).ready( function () {
        $('#myTableBefore').DataTable();
        $('#myTableAfter').DataTable();
    } );
  </script>

@endsection