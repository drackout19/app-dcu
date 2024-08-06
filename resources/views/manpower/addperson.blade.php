@extends('layouts.main')

@section('konten')
    <div class="card mx-auto p-5" style="width: 60%">
        <h4 class="text-center">Form Tambah Data Baru Manpower</h4>
        <hr>
        <div>
            <form action="{{ route('manpower.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- input jabatan --}}
                <div class="mb-3">
                    <label for="inputJabatan">
                        <h6 class="mb-0">Jabatan</h6>
                    </label>
                    <select class="form-select mt-2" aria-label="Default select example" id="inputJabatan" required
                        name="inputJabatan">
                        <option hidden value="">Pilih Jabatan</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Project Coordinator">Project Coordinator</option>
                        <option value="Safetyman">Safetyman</option>
                    </select>
                    {{-- <input type="text" class="form-control"  id="inputJabatan" name="inputJabatan"> --}}
                </div>
                {{-- input nama pekerja --}}
                <div class="mb-3">
                    <label for="inputNamaPekerja" class="form-label">
                        <h6 class="mb-0">Nama Pekerja</h6>
                    </label>
                    <input type="text" class="form-control" id="inputNamaPekerja" name="inputNamaPekerja" required>
                </div>
                {{-- input tanggal lahir --}}
                <div class="mb-3">
                    <label for="inputTanggalLahir" class="form-label">
                        <h6 class="mb-0">Tanggal Lahir</h6>
                    </label>
                    <input type="date" class="form-control" id="inputTanggalLahir" name="inputTanggalLahir" required>
                    {{-- <input type="date" id="inputTanggalLahir" name="inputTanggalLahir"> --}}
                </div>
                {{-- input alamat --}}
                <div class="mb-3">
                    <label for="inputAlamat" class="form-label">
                        <h6 class="mb-0">Alamat</h6>
                    </label>
                    <input type="text" class="form-control" id="inputAlamat" name="inputAlamat" required>
                </div>
                {{-- input no ktp --}}
                <div class="mb-3">
                    <label for="inputNoktp" class="form-label">
                        <h6 class="mb-0">No KTP</h6>
                    </label>
                    <input type="number" class="form-control" id="inputNoktp" name="inputNoktp">
                </div>
                {{-- input jenis kelamin --}}
                <div class="mb-3">
                    <label class="" for="inputJenisKelamin" class="form-label">
                        <h6 class="mb-0">Jenis Kelamin</h6>
                    </label>
                    {{-- dropdown jenis kelamin --}}
                    <select class="form-select mt-2 mb-2" aria-label="Default select example" id="inputJenisKelamin" required
                        name="inputJenisKelamin">
                        <option hidden value="">Pilih Jenis Kelamin</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>
                {{-- input umur --}}
                <div class="mb-3">
                    <label for="inputUmur" class="form-label">
                        <h6 class="mb-0">Umur</h6>
                    </label>
                    <input type="number" class="form-control" id="inputUmur" name="inputUmur">
                </div>
                {{-- input status karyawan --}}
                {{-- <div class="mb-3">
                    <label class="" for="inputStatusPekerja" class="form-label">
                        <h6 class="mb-0">Status Pekerja</h6>
                    </label>
                    <select class="form-select mt-2 mb-2" aria-label="Default select example" id="inputStatusPekerja" required
                        name="inputStatusPekerja">
                        <option hidden value="">Pilih Status Pekerja</option>
                        <option value="Tetap">Tetap</option>
                        <option value="Lepas">Lepas</option>
                    </select>
                </div> --}}
                {{-- input gaji pokok --}}
                {{-- <div class="mb-3" id="divGajiPokok" style="display: none">
                    <label for="inputGajiPokok" class="form-label">
                        <h6 class="mb-0">Gaji Pokok</h6>
                    </label>
                    <input type="number" class="form-control" id="inputGajiPokok" name="inputGajiPokok">
                </div> --}}
                {{-- input gaji harian --}}
                <div class="mb-3"  id="divGajiHarian">
                    <label for="inputGajiHarian" class="form-label">
                        <h6 class="mb-0">Upah Harian</h6>
                    </label>
                    <input type="number" class="form-control" id="inputGajiHarian" name="inputGajiHarian" required>
                </div>
                {{-- input gaji lembur --}}
                <div class="mb-3"  id="divGajiLembur">
                    <label for="inputGajiLembur" class="form-label">
                        <h6 class="mb-0">Upah Lembur</h6>
                    </label>
                    <input type="number" class="form-control" id="inputGajiLembur" name="inputGajiLembur" required>
                </div>
                {{-- input no rekening bank --}}
                <div class="mb-3">
                    <label class="" for="inputNamaBank" class="form-label">
                        <h6 class="mb-0">No Rekening</h6>
                    </label>
                    {{-- dropdown nama bank --}}
                    <div class="mt-2 mb-2" id="divSelectNamaBank">
                        <select class="form-select" aria-label="Default select example" id="inputNamaBank"
                            name="inputNamaBank">
                            <option hidden value="">Pilih Nama Bank</option>
                            <option value="BCA">BCA</option>
                            <option value="MANDIRI">MANDIRI</option>
                            <option value="BNI">BNI</option>
                            <option value="BRI">BRI</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <input type="number" class="form-control" id="inputNoRekening" name="inputNoRekening" placeholder="No rekening">
                </div>
                {{-- input foto ktp --}}
                <div class="mb-3">
                    <label for="inputFotoktp" class="form-label">
                        <h6 class="mb-0">Foto KTP</h6>
                    </label>
                    <input type="file" class="form-control" id="inputFotoktp" name="inputFotoktp" value="hfdfd">
                </div>
                {{-- input foto Diri --}}
                <div class="mb-3">
                    <label for="inputFotoDiri" class="form-label">
                        <h6 class="mb-0">Foto Diri</h6>
                    </label>
                    <input type="file" class="form-control" id="inputFotoDiri" name="inputFotoDiri" value="hfdfd">
                </div>
                {{-- input file mcu --}}
                <div class="mb-3">
                    <label for="inputFileMCU" class="form-label">
                        <h6 class="mb-0">MCU</h6>
                    </label>
                    <input type="file" class="form-control" id="inputFileMCU" name="inputFileMCU" value="fdfd">
                </div>
                {{-- input kartu induction --}}
                <div class="mb-3">
                    <label for="inputKartuInduction" class="form-label">
                        <h6 class="mb-0">Kartu Induction</h6>
                    </label>
                    <input type="file" class="form-control" id="inputKartuInduction" name="inputKartuInduction">
                </div>
                {{-- input no kartu badge --}}
                <div class="mb-3">
                    <label for="inputNoBadge" class="form-label">
                        <h6 class="mb-0">No Kartu Badge</h6>
                    </label>
                    <input type="number" class="form-control" id="inputNoBadge" name="inputNoBadge" required>
                </div>
                {{-- input kartu badge --}}
                <div class="mb-3">
                    <label for="inputKartuBadge" class="form-label">
                        <h6 class="mb-0">Kartu Badge</h6>
                    </label>
                    <input type="file" class="form-control" id="inputKartuBadge" name="inputKartuBadge" required>
                </div>
                {{-- input file skck --}}
                <div class="mb-3">
                    <label for="inputFileSKCK" class="form-label">
                        <h6 class="mb-0">SKCK</h6>
                    </label>
                    <input type="file" class="form-control" id="inputFileSKCK" name="inputFileSKCK">
                </div>
                {{-- input file npwp --}}
                <div class="mb-3">
                    <label for="inputFileNPWP" class="form-label">
                        <h6 class="mb-0">NPWP</h6>
                    </label>
                    <input type="file" class="form-control" id="inputFileNPWP" name="inputFileNPWP">
                </div>
                {{-- input file cv --}}
                <div class="mb-3">
                    <label for="inputFileCV" class="form-label">
                        <h6 class="mb-0">CV</h6>
                    </label>
                    <input type="file" class="form-control" id="inputFileCV" name="inputFileCV">
                </div>
                {{-- input file sertifikat --}}
                <div class="mb-3">
                    <label for="inputFileSertifikat" class="form-label">
                        <h6 class="mb-0">Sertifikat</h6>
                    </label>
                    <input type="file" class="form-control" id="inputFileSertifikat" name="inputFileSertifikat">
                </div>
                {{-- input file Paklaring --}}
                <div class="mb-3">
                    <label for="inputFilePaklaring" class="form-label">
                        <h6 class="mb-0">Paklaring</h6>
                    </label>
                    <input type="file" class="form-control" id="inputFilePaklaring" name="inputFilePaklaring">
                </div>
                {{-- input file SuratVaksin --}}
                <div class="mb-3">
                    <label for="inputFileSuratVaksin" class="form-label">
                        <h6 class="mb-0">Surat Vaksin</h6>
                    </label>
                    <input type="file" class="form-control" id="inputFileSuratVaksin" name="inputFileSuratVaksin">
                </div>
                {{-- input lokasi kerja --}}
                {{-- <div class="mb-3">
                    <label for="">
                        <h6 class="mb-0">Lokasi Kerja</h6>
                    </label>
                    <select class="form-select mt-2" aria-label="Default select example" id="inputLokasiKerja" name="inputLokasiKerja" required>
                        <option hidden value="">Open this select menu</option>
                        <option value="RU VI Balongan">RU VI Balongan</option>
                        <option value="RU VI Balikpapan">RU V Balikpapan</option>
                    </select>
                </div> --}}
                {{-- input keterangan --}}
                <div class="mb-3">
                    <label for="inputKeterangan" class="form-label">
                        <h6 class="mb-0">Keterangan</h6>
                    </label>
                    <input type="text" class="form-control" id="inputKeterangan" name="inputKeterangan" placeholder="Opsional">
                </div>
                <hr>
                {{-- button kirim --}}
                <div class="mx-auto" style="width: max-content"><button type="submit"
                        class="btn btn-success mx-auto ps-4 pe-4 ">Kirim Data</button></div>
            </form>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $("#inputNoRekening").keyup(function() {
            let inputNoRek = $("#inputNoRekening").val();

            if(inputNoRek != "") {
                $("#inputNamaBank").attr("required", true);
            } else {
                $("#inputNamaBank").removeAttr("required");
            }
        });

        $("#inputNamaBank").change(function() {
            let inputNamaBank = $("#inputNamaBank").val();

            if(inputNamaBank == "Lainnya") {
                $("#divSelectNamaBank").html('<input type="text" class="form-control" id="inputNamaBank" name="inputNamaBank" placeholder="Nama Bank">')
                // alert();
            }

            $("#inputNoRekening").attr("required", true);
        });

        // $("#inputStatusPekerja").change(function() {
        //     let inputStatusPekerja = $("#inputStatusPekerja").val();

        //     if(inputStatusPekerja == "Tetap") {
        //         $("#divGajiPokok").show();
        //         $("#divGajiPokok").attr('required', true);
        //         $("#divGajiHarian").hide();
        //         $("#divGajiHarian").removeAttr('required');
        //         $("#divGajiLembur").hide();
        //         $("#divGajiLembur").removeAttr('required');
        //     } else {
        //         $("#divGajiPokok").hide();
        //         $("#divGajiPokok").removeAttr('required');
        //         $("#divGajiHarian").show();
        //         $("#divGajiHarian").attr('required', true);
        //         $("#divGajiLembur").show();
        //         $("#divGajiLembur").attr('required', true);;
        //     }
        // });
        
    </script>
@endsection
