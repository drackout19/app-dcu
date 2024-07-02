@extends('layouts.main')

@section('konten')
    <div class="rounded bg-white p-2">
        <h5>Detail Data Personal</h5>
    </div>
    <div class="card mx-auto p-5 mt-5" style="width: 70%">
        <div>
            {{-- foto diri personal --}}
            <div class="mb-5" style="display: flex; align-items: center;">
                <img src="https://picsum.photos/id/237/200/250" alt="foto diri {{ $data->nama_pekerja }}">
                {{--  --}}
                <p class="fs-1" style="margin-left: 20%">Personal Profile</p>
            </div>
            <hr>
            <div class="border rounded p-4">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                        <h5 class="mb-4">1. Jabatan</h5>
                        <h5 class="mb-4">2. Nama</h5>
                        <h5 class="mb-4">3. Tanggal Lahir</h5>
                        <h5 class="mb-4">4. Alamat</h5>
                        <h5 class="mb-4">5. No KTP</h5>
                        <h5 class="mb-4">5. Lokasi Kerja</h5>
                        <h5 class="mb-4">5. Keterangan</h5>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                        <h5 class="mb-4" style="font-weight: 400">: {{ $data->jabatan }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ $data->nama_pekerja }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ $data->tanggal_lahir }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ $data->alamat }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ $data->no_KTP }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ $data->lokasi_kerja }}</h5>
                        <h5 class="mb-4" style="font-weight: 400">: {{ $data->keterangan }}</h5>
                        {{-- <div class="border" style="max-width: 50%;">
                            <img src="{{ asset('storage/manpowers/fotoktp/'.$data->foto_KTP) }}" alt="foto ktp" style="width: 100%; height: 100%;">
                        </div> --}}
                    </div>
                </div>
                <div class="mb-4">
                    <h5>6. Foto KTP</h5>
                    <div class="border mx-auto" style="max-width: 50%;">
                        <img src="{{ asset('storage/manpowers/fotoktp/'.$data->foto_KTP) }}" alt="foto ktp" style="width: 100%; height: 100%;">
                    </div>
                </div>
                <div class="mb-4">
                    <h5>7. MCU</h5>
                    <div class="mx-auto" style="width: max-content">
                        <embed src="{{ asset('storage/manpowers/suratmcu/'.$data->mcu) }}" width="500" height="600"  type="application/pdf">
                    </div>
                </div>
                <div class="mb-4">
                    <h5>8. Kartu Induction</h5>
                    <div class="mx-auto" style="max-width: 30%">
                        <img src="{{ asset('storage/manpowers/foto_kartu_induction/'.$data->kartu_induction) }}" alt="kartu induction" style="width: 100%">
                    </div>
                </div>
                <div class="mb-4">
                    <h5>9. Kartu Badge</h5>
                    <div class="mx-auto" style="max-width: 40%">
                        <img src="{{ asset('storage/manpowers/foto_kartu_badge/'.$data->kartu_badge) }}" alt="kartu badge" style="width: 100%">
                    </div>
                </div>
                <div class="mb-4">
                    <h5>10. SKCK</h5>
                    <div class="mx-auto" style="width: max-content">
                        <embed src="{{ asset('storage/manpowers/suratskck/'.$data->skck) }}" width="500" height="600"  type="application/pdf">
                    </div>
                </div>
                <div class="mb-4">
                    <h5>11. Kartu NPWP</h5>
                    <div class="mx-auto" style="max-width: 40%">
                        <img src="{{ asset('storage/manpowers/kartunpwp/'.$data->npwp) }}" alt="kartu npwp" style="width: 100%">
                    </div>
                </div>
                <div class="mb-4">
                    <h5>12. CV</h5>
                    <div class="mx-auto" style="width: max-content">
                        <embed src="{{ asset('storage/manpowers/cv/'.$data->cv) }}" width="500" height="600"  type="application/pdf">
                    </div>
                </div>
                <div class="mb-4">
                    <h5>13. Sertifikat</h5>
                    <div class="mx-auto" style="width: max-content">
                        <embed src="{{ asset('storage/manpowers/sertifikat/'.$data->sertifikat) }}" width="500" height="600"  type="application/pdf">
                    </div>
                </div>
                <div class="mb-4">
                    <h5>14. Paklaring</h5>
                    <div class="mx-auto" style="width: max-content">
                        <embed src="{{ asset('storage/manpowers/paklaring/'.$data->paklaring) }}" width="500" height="600"  type="application/pdf">
                    </div>
                </div>
                <div class="mb-4">
                    <h5>15. Surat Vaksin</h5>
                    <div class="mx-auto" style="width: max-content">
                        <embed src="{{ asset('storage/manpowers/suratvaksin/'.$data->surat_vaksin) }}" width="500" height="600"  type="application/pdf">
                    </div>
                </div>
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

@endsection