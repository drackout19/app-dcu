@extends('layouts.main')

@section('konten')
    <div class="rounded bg-white p-2">
        <h5>Pengaturan Akun</h5>
    </div>
    <div class="card mx-auto p-5 mt-5" style="width: 60%">
        {{-- <h4 class="text-center">Edit Data Manpower</h4>
        <hr> --}}
        <div>
            <form action="{{ (Auth::user()->level === 'pekerja') ? route('updateProfilePersonPending', $data->id) : route('manpower.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                </div>
                {{-- input nama pekerja --}}
                <div class="mb-3">
                    <label for="inputPassword" class="form-label"><h5 class="mb-0">Ubah Password Akun</h5></label>
                    <input type="text" class="form-control" id="inputPassword" name="inputPassword" value="{{ $data->nama_pekerja }}">
                </div>
                {{-- input jenis kelamin --}}
                <div class="mb-3">
                    <label for="" ><h5 class="mb-0">3. Jenis Kelamin</h5></label>
                    <select class="form-select mt-2" id="inputJenisKelamin" name="inputJenisKelamin" aria-label="{{ $data->jenis_kelamin }}">
                        {{-- <option>Open this select menu</option> --}}
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                    {{-- <input type="text" class="form-control"  id="inputJabatan" name="inputJabatan"> --}}
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
                {{-- input umur --}}
                <div class="mb-3">
                    <label for="inputUmur" class="form-label"><h5 class="mb-0">5. No KTP</h5></label>
                    <input type="number" class="form-control" id="inputUmur" name="inputUmur" value="{{ $data->umur }}">
                </div>
                {{-- input no rekening --}}
                <div class="mb-3">
                    <label for="inputNoRekening" class="form-label"><h5 class="mb-0">6. No Rekening</h5></label>

                    <div class="mt-2 mb-2" id="divSelectNamaBank">
                        <select class="form-select" id="inputNamaBank" name="inputNamaBank" aria-label="{{ $data->nama_bank }}">
                            <option hidden value="">Pilih Nama Bank</option>
                            <option value="BCA">BCA</option>
                            <option value="MANDIRI">MANDIRI</option>
                            <option value="BNI">BNI</option>
                            <option value="BRI">BRI</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <input type="number" class="form-control" id="inputNoRekening" name="inputNoRekening" placeholder="No rekening" value="{{ $data->no_rekening }}">
                </div>
                {{-- input foto diri --}}
                <div class="mb-3">
                    <label class="form-label"><h5 class="mb-0">7. Foto Diri</h5></label>
                    <div class="mx-auto" style="max-width: 50%">
                        @if($data->foto_diri != null)
                            <img src="{{ asset('storage/manpowers/foto_diri/'.$data->foto_diri) }}" alt="foto diri" style="width: 100%">
                        @else
                            <p class="text-warning"><i>Belum ada Foto Diri yg diupload!</i></p>
                        @endif
                    </div>
                    <div class="ms-3">
                        <label class="form-label"><h6 class="mb-0 text-danger">*ubah/upload Foto KTP</h6></label>
                        <input type="file" class="form-control" id="inputFotoDiri" name="inputFotoDiri">
                    </div>
                </div>
                {{-- input foto ktp --}}
                <div class="mb-3">
                    <label class="form-label"><h5 class="mb-0">8. Foto KTP</h5></label>
                    <div class="mx-auto" style="max-width: 50%">
                        @if($data->foto_KTP != null)
                            <img src="{{ asset('storage/manpowers/fotoktp/'.$data->foto_KTP) }}" alt="foto ktp" style="width: 100%">
                        @else
                            <p class="text-warning"><i>Belum ada Foto KTP yg diupload!</i></p>
                        @endif
                    </div>
                    <div class="ms-3">
                        <label class="form-label"><h6 class="mb-0 text-danger">*ubah/upload Foto KTP</h6></label>
                        <input type="file" class="form-control" id="inputFotoktp" name="inputFotoktp">
                    </div>
                </div>
                {{-- input file mcu --}}
                <div class="mb-3">
                    <h5>9. MCU</h5>
                    <div class="mx-auto" style="width: max-content">
                        @if($data->mcu != null)
                            <embed src="{{ asset('storage/manpowers/suratmcu/'.$data->mcu) }}" width="500" height="600"  type="application/pdf">
                        @else
                            <p class="text-warning"><i>Belum ada MCU yg diupload!</i></p>
                        @endif
                    </div>
                    <div class="ms-3">
                        <label for="inputFileMCU" class="form-label"><h6 class="mb-0 text-danger">*ubah/upload Surat MCU</h6></label>
                        <input type="file" class="form-control" id="inputFileMCU" name="inputFileMCU">
                    </div>
                </div>
                {{-- input kartu induction --}}
                <div class="mb-3">
                    <label class="form-label"><h5 class="mb-0">10. Kartu Induction</h5></label>
                    <div class="mx-auto" style="max-width: 30%">
                        @if($data->kartu_induction != null)
                            <img src="{{ asset('storage/manpowers/foto_kartu_induction/'.$data->kartu_induction) }}" alt="kartu induction" style="width: 100%">
                        @else
                            <p class="text-warning"><i>Belum ada foto kartu induction yg diupload!</i></p>
                        @endif
                    </div>
                    <div class="ms-3">
                        <label for="inputKartuInduction" class="form-label"><h6 class="mb-0 text-danger">*ubah/upload Kartu Induction</h6></label>
                        <input type="file" class="form-control" id="inputKartuInduction" name="inputKartuInduction">
                    </div>
                </div>
                {{-- input kartu badge --}}
                <div class="mb-3">
                    <label class="form-label"><h5 class="mb-0">11. Kartu Badge</h5></label>
                    <div class="mb-3 ms-3">
                        <label for="inputNoBadge" class="form-label"><h6 class="mb-0">*No Kartu Badge</h6></label>
                        <input type="number" class="form-control" id="inputNoBadge" name="inputNoBadge" value="{{ $data->no_kartu_badge }}">
                    </div>
                    <label for="inputNoBadge" class="form-label ms-3"><h6 class="mb-0">*Foto Kartu Badge</h6></label>
                    <div class="mx-auto" style="max-width: 40%">
                        @if($data->kartu_badge != null)
                            <img src="{{ asset('storage/manpowers/foto_kartu_badge/'.$data->kartu_badge) }}" alt="kartu badge" style="width: 100%">
                       
                        @else
                            <p class="text-warning"><i>Belum ada foto kartu badge yg diupload!</i></p>
                        @endif
                    </div>
                    <div class="ms-3">
                        <label for="inputKartuBadge" class="form-label"><h6 class="mb-0 text-danger">*ubah/upload Kartu Badge</h6></label>
                        <input type="file" class="form-control" id="inputKartuBadge" name="inputKartuBadge">
                    </div>
                </div>
                {{-- input file skck --}}
                <div class="mb-3">
                    <h5>12. SKCK</h5>
                    <div class="mx-auto" style="width: max-content">

                        @if($data->skck != null)
                            <embed src="{{ asset('storage/manpowers/suratskck/'.$data->skck) }}" width="500" height="600"  type="application/pdf">

                        @else
                            <p class="text-warning"><i>Belum ada SKCK yg diupload!</i></p>
                        @endif
                    </div>
                    <div class="ms-3">
                        <label for="inputFileSKCK" class="form-label"><h6 class="mb-0 text-danger">*ubah/upload SKCK</h6></label>
                        <input type="file" class="form-control" id="inputFileSKCK" name="inputFileSKCK">
                    </div>
                </div>
                {{-- input file npwp --}}
                <div class="mb-3">
                    <label class="form-label"><h5 class="mb-0">13. NPWP</h5></label>
                    <div class="mx-auto" style="max-width: 40%">
                        @if($data->npwp != null)
                            <img src="{{ asset('storage/manpowers/kartunpwp/'.$data->npwp) }}" alt="kartu npwp" style="width: 100%">
                        @else
                            <p class="text-warning"><i>Belum ada NPWP yg diupload!</i></p>
                        @endif
                    </div>
                    <div class="ms-3">
                        <label for="inputFileNPWP" class="form-label"><h6 class="mb-0 text-danger">*ubah/upload Kartu NPWP</h6></label>
                        <input type="file" class="form-control" id="inputFileNPWP" name="inputFileNPWP">
                    </div>
                </div>
                {{-- input file cv --}}
                <div class="mb-3">
                    <h5>14. CV</h5>
                    <div class="mx-auto" style="width: max-content">
                        @if($data->cv != null)
                            <embed src="{{ asset('storage/manpowers/cv/'.$data->cv) }}" width="500" height="600"  type="application/pdf">
                        @else
                            <p class="text-warning"><i>Belum ada CV yg diupload!</i></p>
                        @endif
                    </div>
                    <div class="ms-3">
                        <label for="inputFileCV" class="form-label"><h6 class="mb-0 text-danger">*ubah/upload CV</h6></label>
                        <input type="file" class="form-control" id="inputFileCV" name="inputFileCV">
                    </div>
                </div>
                {{-- input file sertifikat --}}
                <div class="mb-3">
                    <h5>15. Sertfikat</h5>
                    <div class="mx-auto" style="width: max-content">
                        @if($data->sertifikat != null)
                            <embed src="{{ asset('storage/manpowers/sertifikat/'.$data->sertifikat) }}" width="500" height="600"  type="application/pdf">
                        @else
                            <p class="text-warning"><i>Belum ada Sertifikat yg diupload!</i></p>
                        @endif
                    </div>
                    <div class="ms-3">
                        <label for="inputFileSertifikat" class="form-label"><h6 class="mb-0 text-danger">*ubah/upload Sertifikat</h6></label>
                        <input type="file" class="form-control" id="inputFileSertifikat" name="inputFileSertifikat">
                    </div>
                </div>
                {{-- input file Paklaring --}}
                <div class="mb-3">
                    <h5>16. Paklaring</h5>
                    <div class="mx-auto" style="width: max-content">
                        @if($data->paklaring != null)
                            <embed src="{{ asset('storage/manpowers/paklaring/'.$data->paklaring) }}" width="500" height="600"  type="application/pdf">
                        @else
                            <p class="text-warning"><i>Belum ada Paklaring yg diupload!</i></p>
                        @endif
                    </div>
                    <div class="ms-3">
                        <label for="inputFilePaklaring" class="form-label"><h6 class="mb-0 text-danger">*ubah/upload Paklaring</h6></label>
                        <input type="file" class="form-control" id="inputFilePaklaring" name="inputFilePaklaring">
                    </div>
                </div>
                {{-- input file SuratVaksin --}}
                <div class="mb-3">
                    <h5>17. Surat Vaksin</h5>
                    <div class="mx-auto" style="width: max-content">
                        @if($data->surat_vaksin != null)
                            <embed src="{{ asset('storage/manpowers/suratvaksin/'.$data->surat_vaksin) }}" width="500" height="600"  type="application/pdf">
                        @else
                            <p class="text-warning"><i>Belum ada Surat Vaksin yg diupload!</i></p>
                        @endif
                    </div>
                    <div class="ms-3">
                        <label for="inputFileSuratVaksin" class="form-label"><h6 class="mb-0 text-danger">*ubah/upload Surat Vaksin</h6></label>
                        <input type="file" class="form-control" id="inputFileSuratVaksin" name="inputFileSuratVaksin">
                    </div>
                </div>
                {{-- input lokasi kerja --}}
                {{-- <div class="mb-3">
                    <label for=""><h5 class="mb-0">18. Lokasi Kerja</h5></label>
                    <select class="form-select mt-2" id="inputLokasiKerja" name="inputLokasiKerja" aria-label="{{ $data->lokasi_kerja }}">
                        <option hidden value="" aria-label="default">Pilih Lokasi Kerja</option>
                        <option value="RU VI Balongan">RU VI Balongan</option>
                        <option value="RU VI Balikpapan">RU V Balikpapan</option>
                    </select>
                </div> --}}
                {{-- input keterangan --}}
                <div class="mb-3">
                    <label for="inputKeterangan" class="form-label"><h5 class="mb-0">19. Keterangan</h5></label>
                    <input type="text" class="form-control" id="inputKeterangan" name="inputKeterangan" value="{{ $data->keterangan }}" placeholder="Opsional">
                </div>
                <hr>
                {{-- button kirim --}}
                <div class="mx-auto" style="width: max-content"><button type="submit" class="btn btn-success mx-auto ps-4 pe-4 ">Simpan Data</button></div>
                
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

        $("select#inputJenisKelamin option").map(function() {
            if($(this).val() === $('#inputJenisKelamin').attr('aria-label')) {
                $(this).attr('selected', true);
            }
        });

        $("select#inputNamaBank option").map(function() {
            if($(this).val() === $('#inputNamaBank').attr('aria-label')) {
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