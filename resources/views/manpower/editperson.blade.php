@extends('layouts.main')

@section('konten')
    <div class="rounded bg-white p-2">
        <h5>Edit Data Manpower</h5>
    </div>
    <div class="card mx-auto p-5 mt-5" style="width: 60%">
        {{-- <h4 class="text-center">Edit Data Manpower</h4>
        <hr> --}}
        <div>
            <form action="{{ route('manpower.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- input jabatan --}}
                <div class="mb-3">
                    <label for="" ><h5 class="mb-0">1. Jabatan</h5></label>
                    <select class="form-select mt-2" id="inputJabatan" name="inputJabatan" aria-label="{{ $data->jabatan }}">
                        {{-- <option>Open this select menu</option> --}}
                        <option value="Supervisor">Supervisor</option>
                        <option value="Project Coordinator">Project Coordinator</option>
                        <option value="Safetyman">Safetyman</option>
                    </select>
                    {{-- <input type="text" class="form-control"  id="inputJabatan" name="inputJabatan"> --}}
                </div>
                {{-- input nama pekerja --}}
                <div class="mb-3">
                    <label for="inputNamaPekerja" class="form-label"><h5 class="mb-0">2. Nama Pekerja</h5></label>
                    <input type="text" class="form-control" id="inputNamaPekerja" name="inputNamaPekerja" value="{{ $data->nama_pekerja }}">
                </div>
                {{-- input tanggal lahir --}}
                <div class="mb-3">
                    <label for="inputTanggalLahir" class="form-label"><h5 class="mb-0">3. Tanggal Lahir</h5></label>
                    <input type="date" class="form-control" id="inputTanggalLahir" name="inputTanggalLahir" value="{{ $data->tanggal_lahir }}">
                    {{-- <input type="date" id="inputTanggalLahir" name="inputTanggalLahir"> --}}
                </div>
                {{-- input alamat --}}
                <div class="mb-3">
                    <label for="inputAlamat" class="form-label"><h5 class="mb-0">4. Alamat</h5></label>
                    <input type="text" class="form-control" id="inputAlamat" name="inputAlamat" value="{{ $data->alamat }}">
                </div>
                {{-- input no ktp --}}
                <div class="mb-3">
                    <label for="inputNoktp" class="form-label"><h5 class="mb-0">5. No KTP</h5></label>
                    <input type="number" class="form-control" id="inputNoktp" name="inputNoktp" value="{{ $data->no_KTP }}">
                </div>
                {{-- input foto ktp --}}
                <div class="mb-3">
                    <label class="form-label"><h5 class="mb-0">6. Foto KTP</h5></label>
                    <div class="mx-auto" style="max-width: 50%">
                        <img src="{{ asset('storage/manpowers/fotoktp/'.$data->foto_KTP) }}" alt="foto ktp" style="width: 100%">
                    </div>
                    <div class="ms-3">
                        <label class="form-label"><h6 class="mb-0 text-danger">Ubah Foto KTP</h6></label>
                        <input type="file" class="form-control" id="inputFotoktp" name="inputFotoktp">
                    </div>
                </div>
                {{-- input file mcu --}}
                <div class="mb-3">
                    <h5>7. MCU</h5>
                    <div class="mx-auto" style="width: max-content">
                        <embed src="{{ asset('storage/manpowers/suratmcu/'.$data->mcu) }}" width="500" height="600"  type="application/pdf">
                    </div>
                    <div class="ms-3">
                        <label for="inputFileMCU" class="form-label"><h6 class="mb-0 text-danger">Ubah Surat MCU</h6></label>
                        <input type="file" class="form-control" id="inputFileMCU" >
                    </div>
                </div>
                {{-- input kartu induction --}}
                <div class="mb-3">
                    <label class="form-label"><h5 class="mb-0">8. Kartu Induction</h5></label>
                    <div class="mx-auto" style="max-width: 30%">
                        <img src="{{ asset('storage/manpowers/foto_kartu_induction/'.$data->kartu_induction) }}" alt="kartu induction" style="width: 100%">
                    </div>
                    <div class="ms-3">
                        <label for="inputKartuInduction" class="form-label"><h6 class="mb-0 text-danger">Ubah Kartu Induction</h6></label>
                        <input type="file" class="form-control" id="inputKartuInduction">
                    </div>
                </div>
                {{-- input kartu badge --}}
                <div class="mb-3">
                    <label class="form-label"><h5 class="mb-0">9. Kartu Badge</h5></label>
                    <div class="mx-auto" style="max-width: 40%">
                        <img src="{{ asset('storage/manpowers/foto_kartu_badge/'.$data->kartu_badge) }}" alt="kartu badge" style="width: 100%">
                    </div>
                    <div class="ms-3">
                        <label for="inputKartuBadge" class="form-label"><h6 class="mb-0 text-danger">Ubah Kartu Badge</h6></label>
                        <input type="file" class="form-control" id="inputKartuBadge">
                    </div>
                </div>
                {{-- input file skck --}}
                <div class="mb-3">
                    <h5>10. SKCK</h5>
                    <div class="mx-auto" style="width: max-content">
                        <embed src="{{ asset('storage/manpowers/suratskck/'.$data->skck) }}" width="500" height="600"  type="application/pdf">
                    </div>
                    <div class="ms-3">
                        <label for="inputFileSKCK" class="form-label"><h6 class="mb-0 text-danger">Ubah SKCK</h6></label>
                        <input type="file" class="form-control" id="inputFileSKCK">
                    </div>
                </div>
                {{-- input file npwp --}}
                <div class="mb-3">
                    <label class="form-label"><h5 class="mb-0">11. NPWP</h5></label>
                    <div class="mx-auto" style="max-width: 40%">
                        <img src="{{ asset('storage/manpowers/kartunpwp/'.$data->npwp) }}" alt="kartu npwp" style="width: 100%">
                    </div>
                    <div class="ms-3">
                        <label for="inputFileNPWP" class="form-label"><h6 class="mb-0 text-danger">Ubah Kartu NPWP</h6></label>
                        <input type="file" class="form-control" id="inputFileNPWP">
                    </div>
                </div>
                {{-- input file cv --}}
                <div class="mb-3">
                    <h5>12. CV</h5>
                    <div class="mx-auto" style="width: max-content">
                        <embed src="{{ asset('storage/manpowers/cv/'.$data->cv) }}" width="500" height="600"  type="application/pdf">
                    </div>
                    <div class="ms-3">
                        <label for="inputFileCV" class="form-label"><h6 class="mb-0 text-danger">Ubah CV</h6></label>
                        <input type="file" class="form-control" id="inputFileCV">
                    </div>
                </div>
                {{-- input file sertifikat --}}
                <div class="mb-3">
                    <h5>13. Sertfikat</h5>
                    <div class="mx-auto" style="width: max-content">
                        <embed src="{{ asset('storage/manpowers/sertifikat/'.$data->sertifikat) }}" width="500" height="600"  type="application/pdf">
                    </div>
                    <div class="ms-3">
                        <label for="inputFileSertifikat" class="form-label"><h6 class="mb-0 text-danger">Ubah Sertifikat</h6></label>
                        <input type="file" class="form-control" id="inputFileSertifikat">
                    </div>
                </div>
                {{-- input file Paklaring --}}
                <div class="mb-3">
                    <h5>14. Paklaring</h5>
                    <div class="mx-auto" style="width: max-content">
                        <embed src="{{ asset('storage/manpowers/paklaring/'.$data->paklaring) }}" width="500" height="600"  type="application/pdf">
                    </div>
                    <div class="ms-3">
                        <label for="inputFilePaklaring" class="form-label"><h6 class="mb-0 text-danger">Ubah Paklaring</h6></label>
                        <input type="file" class="form-control" id="inputFilePaklaring">
                    </div>
                </div>
                {{-- input file SuratVaksin --}}
                <div class="mb-3">
                    <h5>15. Surat Vaksin</h5>
                    <div class="mx-auto" style="width: max-content">
                        <embed src="{{ asset('storage/manpowers/suratvaksin/'.$data->surat_vaksin) }}" width="500" height="600"  type="application/pdf">
                    </div>
                    <div class="ms-3">
                        <label for="inputFileSuratVaksin" class="form-label"><h6 class="mb-0 text-danger">Ubah Surat Vaksin</h6></label>
                        <input type="file" class="form-control" id="inputFileSuratVaksin">
                    </div>
                </div>
                {{-- input lokasi kerja --}}
                <div class="mb-3">
                    <label for=""><h5 class="mb-0">16. Lokasi Kerja</h5></label>
                    {{-- <select class="form-select mt-2" aria-label="Default select example" id="inputLokasiKerja" name="inputLokasiKerja" required>
                        <option hidden value="">Open this select menu</option>
                        <option value="RU VI Balongan">RU VI Balongan</option>
                        <option value="RU VI Balikpapan">RU V Balikpapan</option>
                    </select> --}}
                    <select class="form-select mt-2" id="inputLokasiKerja" name="inputLokasiKerja" aria-label="{{ $data->lokasi_kerja }}">
                        <option hidden value="" aria-label="default">Pilih Lokasi Kerja</option>
                        <option value="RU VI Balongan">RU VI Balongan</option>
                        <option value="RU VI Balikpapan">RU V Balikpapan</option>
                    </select>
                </div>
                {{-- input keterangan --}}
                <div class="mb-3">
                    <label for="inputKeterangan" class="form-label"><h5 class="mb-0">17. Keterangan</h5></label>
                    <input type="text" class="form-control" id="inputKeterangan" name="inputKeterangan" value="{{ $data->keterangan }}" placeholder="Opsional">
                </div>
                <hr>
                {{-- button kirim --}}
                <div class="mx-auto" style="width: max-content"><button type="submit" class="btn btn-success mx-auto ps-4 pe-4 ">Kirim Data</button></div>
            </form>
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