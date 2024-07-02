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
                        <option hidden value="">Open this select menu</option>
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
                {{-- input foto ktp --}}
                <div class="mb-3">
                    <label for="inputFotoktp" class="form-label">
                        <h6 class="mb-0">Foto KTP</h6>
                    </label>
                    <input type="file" class="form-control" id="inputFotoktp" name="inputFotoktp" value="hfdfd">
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
                {{-- input kartu badge --}}
                <div class="mb-3">
                    <label for="inputKartuBadge" class="form-label">
                        <h6 class="mb-0">Kartu Badge</h6>
                    </label>
                    <input type="file" class="form-control" id="inputKartuBadge" name="inputKartuBadge">
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
                <div class="mb-3">
                    <label for="">
                        <h6 class="mb-0">Lokasi Kerja</h6>
                    </label>
                    <select class="form-select mt-2" aria-label="Default select example" id="inputLokasiKerja" name="inputLokasiKerja" required>
                        <option hidden value="">Open this select menu</option>
                        <option value="RU VI Balongan">RU VI Balongan</option>
                        <option value="RU VI Balikpapan">RU V Balikpapan</option>
                    </select>
                </div>
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
