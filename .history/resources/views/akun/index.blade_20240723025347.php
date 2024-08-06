@extends('layouts.main')

@section('konten')
    <div class="rounded bg-white p-2">
        <h5>Pengaturan Akun</h5>
    </div>
    <div class="card mx-auto p-5 mt-5" style="width: 70%">
        <div>
            <div class="border rounded p-4">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                        <h5 class="mb-4">1. Jabatan</h5>
                        <h5 class="mb-4">2. Nama</h5>
                        <h5 class="mb-4">3. Jenis Kelamin</h5>
                        <h5 class="mb-4">4. Tanggal Lahir</h5>
                        <h5 class="mb-4">5. Alamat</h5>
                        <h5 class="mb-4">6. No KTP</h5>
                        <h5 class="mb-4">7. No Rekening</h5>
                        <h5 class="mb-4">8. Lokasi Kerja</h5>
                        <h5 class="mb-4">9. Keterangan</h5>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                        <h5 class="mb-4" style="font-weight: 400">: {{ $data->jabatan }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ $data->nama_pekerja }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ $data->jenis_kelamin }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ $data->tanggal_lahir }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ $data->alamat }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ ($data->no_KTP != null) ? $data->no_KTP : '-' }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ ($data->no_rekening != null) ? $data->no_rekening.' ('. $data->nama_bank.')' : '-' }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ ($data->lokasi_kerja != null) ? $data->lokasi_kerja : '-' }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ ($data->keterangan != null) ? $data->keterangan : '-' }}</h5>
                        {{-- <div class="border" style="max-width: 50%;">
                            <img src="{{ asset('storage/manpowers/fotoktp/'.$data->foto_KTP) }}" alt="foto ktp" style="width: 100%; height: 100%;">
                        </div> --}}
                    </div>
                </div>
                <div class="mb-4">
                    <h5>10. Foto KTP</h5>
                    @if ($data->foto_KTP !== null)
                        <div class="border mx-auto" style="max-width: 50%;">
                            <img src="{{ asset('storage/manpowers/fotoktp/'.$data->foto_KTP) }}" alt="foto ktp" style="width: 100%; height: 100%;">
                        </div>
                    @else
                        <p class="text-warning text-center"><i>Belum ada KTP yg diupload!</i></p>
                    @endif
                </div>
                <div class="mb-4">
                    <h5>11. MCU</h5>
                    @if ($data->mcu !== null)
                        <div class="mx-auto" style="width: max-content">
                            <embed src="{{ asset('storage/manpowers/suratmcu/'.$data->mcu) }}" width="500" height="600"  type="application/pdf">
                        </div>
                    @else
                        <p class="text-warning text-center"><i>Belum ada MCU yg diupload!</i></p>
                    @endif
                </div>
                <div class="mb-4">
                    <h5>12. Kartu Induction</h5>
                    @if ($data->kartu_induction !== null)
                        <div class="mx-auto" style="max-width: 30%">
                            <img src="{{ asset('storage/manpowers/foto_kartu_induction/'.$data->kartu_induction) }}" alt="kartu induction" style="width: 100%">
                        </div>
                    @else
                        <p class="text-warning text-center"><i>Belum ada Kartu Induction yg diupload!</i></p>
                    @endif
                </div>
                <div class="mb-4">
                    <h5>13. Kartu Badge</h5>
                    @if ($data->kartu_badge !== null)
                        <div class="mx-auto" style="max-width: 40%">
                            <img src="{{ asset('storage/manpowers/foto_kartu_badge/'.$data->kartu_badge) }}" alt="kartu badge" style="width: 100%">
                        </div>
                    @else
                        <p class="text-warning text-center"><i>Belum ada Kartu Badge yg diupload!</i></p>
                    @endif
                </div>
                <div class="mb-4">
                    <h5>14. SKCK</h5>
                    @if ($data->skck !== null)
                        <div class="mx-auto" style="width: max-content">
                            <embed src="{{ asset('storage/manpowers/suratskck/'.$data->skck) }}" width="500" height="600"  type="application/pdf">
                        </div>
                    @else
                        <p class="text-warning text-center"><i>Belum ada SKCK yg diupload!</i></p>
                    @endif
                </div>
                <div class="mb-4">
                    <h5>15. Kartu NPWP</h5>
                    @if ($data->npwp !== null)
                        <div class="mx-auto" style="max-width: 40%">
                            <img src="{{ asset('storage/manpowers/kartunpwp/'.$data->npwp) }}" alt="kartu npwp" style="width: 100%">
                        </div>
                    @else
                        <p class="text-warning text-center"><i>Belum ada NPWP yg diupload!</i></p>
                    @endif
                </div>
                <div class="mb-4">
                    <h5>16. CV</h5>
                    @if ($data->cv !== null)
                        <div class="mx-auto" style="width: max-content">
                            <embed src="{{ asset('storage/manpowers/cv/'.$data->cv) }}" width="500" height="600"  type="application/pdf">
                        </div>
                    @else
                        <p class="text-warning text-center"><i>Belum ada CV yg diupload!</i></p>
                    @endif
                </div>
                <div class="mb-4">
                    <h5>17. Sertifikat</h5>
                    @if ($data->sertifikat !== null)
                        <div class="mx-auto" style="width: max-content">
                            <embed src="{{ asset('storage/manpowers/sertifikat/'.$data->sertifikat) }}" width="500" height="600"  type="application/pdf">
                        </div>
                    @else
                        <p class="text-warning text-center"><i>Belum ada Sertifikat yg diupload!</i></p>
                    @endif
                </div>
                <div class="mb-4">
                    <h5>18. Paklaring</h5>
                    @if ($data->paklaring !== null)
                        <div class="mx-auto" style="width: max-content">
                            <embed src="{{ asset('storage/manpowers/paklaring/'.$data->paklaring) }}" width="500" height="600"  type="application/pdf">
                        </div>
                    @else
                        <p class="text-warning text-center"><i>Belum ada Paklaring yg diupload!</i></p>
                    @endif
                </div>
                <div class="mb-4">
                    <h5>19. Surat Vaksin</h5>
                    @if ($data->surat_vaksin !== null)
                        <div class="mx-auto" style="width: max-content">
                            <embed src="{{ asset('storage/manpowers/suratvaksin/'.$data->surat_vaksin) }}" width="500" height="600"  type="application/pdf">
                        </div>
                    @else
                        <p class="text-warning text-center"><i>Belum ada Surat Vaksin yg diupload!</i></p>
                    @endif
                </div>
                <hr>
                <a href="/updateProfilePerson/{{ Auth::user()->manpower_id }}"><button class="btn btn-primary">Edit Profile</button></a>
            </div>
        </div>
    </div>
@endsection

@section('script')

<script>
    $(document).ready(function() {
        $("select#inputJabatan option").map(function() {
            if($(this).val() === $('#inputJabatan').attr('aria-label')) {
                $(this).attr('selected', true);
            }
        });

        $("select#inputLokasiKerja option").map(function() {
            if($(this).val() === $('#inputLokasiKerja').attr('aria-label')) {
                $(this).attr('selected', true);
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
        
    @elseif(session()->has('warning'))
  
        toastr.warning('{{ session('warning') }}', 'Berhasil!'); 
        
    @endif
  </script>

@endsection