@extends('layouts.main')

@section('konten')
    <div class="rounded bg-white p-2">
        <h5>Pengaturan Akun</h5>
    </div>
    <div class="card mx-auto p-5 mt-5" style="width: 60%">
        {{-- <h4 class="text-center">Edit Data Manpower</h4>
        <hr> --}}
        <div>
            <form action="{{ (Auth::user()->level === 'pekerja') ? route('updateAkunPekerja', Auth::user()->manpower_) : route('manpower.update', $data->id) }}" method="post">
                @csrf
                @method('PUT')
                {{-- input nama pekerja --}}
                <div class="mb-3">
                    <label for="inputPasswordLama" class="form-label"><h5 class="mb-0">Ubah Password Akun</h5></label>
                    <input type="password" class="form-control" id="inputPasswordLama" name="inputPasswordLama" placeholder="Password Lama">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="inputPasswordBaru" name="inputPasswordBaru" placeholder="Password Baru">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="inputKonfirmasiPasswordBaru" name="inputKonfirmasiPasswordBaru" placeholder="Konfirmasi Password Baru">
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