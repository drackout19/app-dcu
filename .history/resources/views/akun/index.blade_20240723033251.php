@extends('layouts.main')

@section('konten')
    <div class="rounded bg-white p-2">
        <h5>Pengaturan Akun</h5>
    </div>
    <div class="card mx-auto p-5 mt-5" style="width: 60%">
        {{-- <h4 class="text-center">Edit Data Manpower</h4>
        <hr> --}}
        <div>
            <form action="{{ (Auth::user()->level === 'pekerja') ? route('updateAkunPekerja', Auth::user()->manpower_id) : route('manpower.update', $data->id) }}" method="post">
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
                    <i class="text-danger" id="alertWrongPassword" style="display: none">Password Tidak Sama</i>
                </div>
               
                
                <hr>
                {{-- button kirim --}}
                <div class="mx-auto" style="width: max-content"><button type="submit" id="submit" class="btn btn-success mx-auto ps-4 pe-4" disabled>Simpan Data</button></div>
                
            </form>
        </div>
    </div>
@endsection

@section('script')

<script>
    $('#inputKonfirmasiPasswordBaru').keyup(function(e) {
        if($('#inputKonfirmasiPasswordBaru').val() != $('#inputPasswordBaru').val()) {
            
        } else {
           $("#submit").removeAttr('disabled');
        }
    });
</script>

<script>
    //message with toastr
    @if(session()->has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 
  
    @elseif(session()->has('error'))
  
        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
  </script>

@endsection