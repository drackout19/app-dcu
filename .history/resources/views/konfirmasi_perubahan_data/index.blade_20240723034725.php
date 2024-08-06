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

        
    <div class="card"><div class="card-body text-danger">Data Manpower Person Yang Diubah</div></div>
    {{-- tabel manpower setelah diubah--}}
    <div id="table-container">
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
                    <th class="text-center" style="width: 150px">Aksi</th>
                </tr>
            </thead>
            <tbody >
            
            @forelse ($manpowers as $data)
                @if($updatePending->where('manpower_id', $data->id)->last() != null && $updatePending->where('manpower_id', $data->id)->last()->status_konfirmasi == false)
                    @php
                        $dataAfterPending = $updatePending->where('manpower_id', $data->id)->last();
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $data->jabatan }}</td>
                        <td class="text-center">{{ $data->nama_pekerja }}</td>
                        <td class="text-center">{{ $data->tanggal_lahir }}</td>
                        <td class="text-center">{{ $data->alamat }}</td>
                        <td class="text-center">{{ ($data->no_KTP == null) ? '-' : $data->no_KTP }}</td>
                        <td class="text-center" >
                        @if($data->foto_KTP != null) 
                            <img class="mb-2" src="{{ asset('storage/manpowers/fotoktp/'.$data->foto_KTP) }}" alt="foto ktp" style="max-width: 100px">
                            {{-- <span>Lihat</span> --}}
                            <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_foto_ktp" onclick="click_lihat_foto_ktp({{ $data->id }})">visibility</span>
                            {{-- float image when click --}}
                            <div id="float_foto_ktp{{ $data->id }}" style="display: none">
                                <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;">
                                <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%); width: 300px">
                                    <img src="{{ asset('storage/manpowers/fotoktp/'.$data->foto_KTP) }}" alt="Foto KTP" style="max-width: 100%; scale: 2">
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
                        @if($data->foto_diri != null)
                            <img class="border rounded" src="{{ asset('storage/manpowers/fotodiri/'.$data->foto_diri) }}" alt="foto-diri" style="width: 90px; height: 90px">
                            <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_foto_diri" onclick="click_lihat_foto_diri({{ $data->id }})">visibility</span>
                            {{-- float image when click --}}
                            <div id="float_foto_diri{{ $data->id }}" style="display: none">
                                <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;">
                                <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%); width: 300px">
                                    <img src="{{ asset('storage/manpowers/fotodiri/'.$data->foto_diri) }}" alt="Foto diri" style="max-width: 100%;">
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
                        <td class="text-center">{{ $data->jenis_kelamin }}</td>
                        {{-- umur --}}
                        <td class="text-center">{{ $data->umur }} tahun</td>
                        {{-- status karyawan --}}
                        {{-- <td class="text-center">
                        @if($data->status_pekerja != null)
                            <span class="fw-bolder">{{ $data->status_pekerja }}</span><br>
                        @else
                            -
                        @endif
                        </td> --}}

                        <td>
                        @if ($data->mcu !== null)
                            Sudah
                        
                        
                        
                            {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_mcu" onclick="click_lihat_surat_mcu({{ $data->id }})">Lihat</span> --}}

                            <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_mcu" onclick="click_lihat_surat_mcu({{ $data->id }})">visibility</span>
                            
                            <div id="float_surat_mcu{{ $data->id }}" style="display: none">
                                <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                                <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                    <embed src="{{ asset('storage/manpowers/suratmcu/'.$data->mcu) }}" width="500" height="600"  type="application/pdf">
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
                        @if ($data->kartu_induction !== null)
                            <img src="{{ asset('storage/manpowers/foto_kartu_induction/'.$data->kartu_induction) }}" alt="foto kartu induction" style="max-width: 80px"> 
                            {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_induction" onclick="click_lihat_kartu_induction({{ $data->id }})">Lihat</span>  --}}
                            <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_induction" onclick="click_lihat_kartu_induction({{ $data->id }})">visibility</span>
                            {{-- float kartu induction --}}
                            <div id="float_kartu_induction{{ $data->id }}" style="display: none">
                                <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                                <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                    <img src="{{ asset('storage/manpowers/foto_kartu_induction/'.$data->kartu_induction) }}" alt="kartu induction" style="max-width: 100%; scale: 1.5">
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
                        {{-- <b>{{ $data->no_kartu_badge }}</b>  --}}
                        @if ($data->kartu_badge !== null)
                            <input style="border: none ; background: transparent; font-weight: 700; max-width: 100px" id="no_kartu_badge" type="text" value="{{ $data->no_kartu_badge }}" disabled>
                            <img src="{{ asset('storage/manpowers/foto_kartu_badge/'.$data->kartu_badge) }}" alt="kartu badge" style="max-width: 100px"> 
                            {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_badge" onclick="click_lihat_kartu_badge({{ $data->id }})">Lihat</span>  --}}
                            <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_badge" onclick="click_lihat_kartu_badge({{ $data->id }})">visibility</span>
                            {{-- float kartu badge --}}
                            <div id="float_kartu_badge{{ $data->id }}" style="display: none">
                            <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                                <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                <img src="{{ asset('storage/manpowers/foto_kartu_badge/'.$data->kartu_badge) }}" alt="kartu badge" style="max-width: 100%; scale: 1.5">
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
                        <td class="text-center">{{ ($data->keterangan == null) ? '-' : $data->keterangan }}</td>
                        {{-- <td class="text-center">{{ ($data->lokasi_kerja == null) ? '-' : $data->lokasi_kerja }}</td> --}}
                        <td class="text-center">
                        @if ($data->skck !== null)
                            Ada
                            
                            {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_skck" onclick="click_lihat_surat_skck({{ $data->id }})">Lihat</span> --}}
                            <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_skck" onclick="click_lihat_surat_skck({{ $data->id }})">visibility</span>

                            <div id="float_surat_skck{{ $data->id }}" style="display: none">
                                <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                                <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                    <embed src="{{ asset('storage/manpowers/suratskck/'.$data->skck) }}" width="500" height="600"  type="application/pdf">
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
                        @if ($data->npwp !== null)
                            Ada
                            
                            {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_npwp" onclick="click_lihat_kartu_npwp({{ $data->id }})">Lihat</span> --}}
                            
                            <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_npwp" onclick="click_lihat_kartu_npwp({{ $data->id }})">visibility</span>
                            
                            <div id="float_kartu_npwp{{ $data->id }}" style="display: none">
                                <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                                <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                    <embed src="{{ asset('storage/manpowers/kartunpwp/'.$data->npwp) }}" width="500" height="600"  type="application/pdf">
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
                        @if ($data->cv !== null)
                            Ada
                            
                        {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_cv" onclick="click_lihat_cv({{ $data->id }})">Lihat</span> --}}
                        
                        <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_cv" onclick="click_lihat_cv({{ $data->id }})">visibility </span>

                            <div id="float_cv{{ $data->id }}" style="display: none">
                            <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                                <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                <embed src="{{ asset('storage/manpowers/cv/'.$data->cv) }}" width="500" height="600"  type="application/pdf">
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
                        @if ($data->sertifikat !== null)
                            Ada
                            
                            <br><span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_sertifikat" onclick="click_lihat_sertifikat({{ $data->id }})">Lihat</span>
                            
                            <div id="float_sertifikat{{ $data->id }}" style="display: none">
                                <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                                <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                    <embed src="{{ asset('storage/manpowers/sertifikat/'.$data->sertifikat) }}" width="500" height="600"  type="application/pdf">
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
                        @if ($data->paklaring !== null)
                            Ada
                            
                            <br>
                            {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_paklaring" onclick="click_lihat_paklaring({{ $data->id }})">Lihat --}}
                            <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_paklaring" onclick="click_lihat_paklaring({{ $data->id }})">visibility</span>

                            <div id="float_paklaring{{ $data->id }}" style="display: none">
                                <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                                <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                    <embed src="{{ asset('storage/manpowers/paklaring/'.$data->paklaring) }}" width="500" height="600"  type="application/pdf">
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
                        @if ($data->surat_vaksin !== null)
                            Ada
                        
                            <br>
                            {{-- <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_vaksin" onclick="click_lihat_surat_vaksin({{ $data->id }})">Lihat</span> --}}
                            
                            <span class="material-symbols-outlined text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_vaksin" onclick="click_lihat_surat_vaksin({{ $data->id }})">visibility</span>

                            <div id="float_surat_vaksin{{ $data->id }}" style="display: none">
                                <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                                <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                    <embed src="{{ asset('storage/manpowers/suratvaksin/'.$data->surat_vaksin) }}" width="500" height="600"  type="application/pdf">
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
                        {{-- <td class="text-center" style="cursor: default"><span class="text-danger fw-bolder" onclick="location.href='/manpower/{{ $data->id }}'">Hapus</span> | <span class="text-warning fw-bolder">Edit </span> | <span class="text-primary fw-bolder">Detail</span></td> --}}
                        <td class="text-center">
                            <a href="{{ route('getViewCompareDataPersonBeforeAfter', $data->id) }}" class="btn btn-sm btn-dark mt-1 mb-1" style="width: 100%">Data Sebelumnya</a>
                            <a href="{{ route('approveUpdatePerubahanData', $data->id) }}" class="btn btn-sm btn-danger mt-1 mb-1" style="width: 100%"><span class="material-symbols-outlined">check</span>Approve</a>
                        </td>
                    </tr>
                @endif
            @empty
            <div class="alert alert-danger">
                Data Manpower belum Tersedia.
            </div>
            @endforelse
            </tbody>
        </table>
    </div>
    
    


    </div>

@endsection

@section('script')

<script>
    
</script>



<script>
    $(document).ready( function () {
        $('#myTableBefore').DataTable();
        $('#myTableAfter').DataTable();
    } );
  </script>

  <script>
      //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 

        @elseif(session()->has('warning'))

            toastr.warning('{{ session('warning') }}', 'GAGAL!'); 
        
        @endif
  </script>

@endsection