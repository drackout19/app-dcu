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
          <h5>Rekap Slip Gaji</h5>
      </div>

      <div class="rounded bg-white mt-5 p-3" style="height: 70vh; overflow-x: scroll">
      {{-- title --}}
      <h4 class="fw-bolder mb-5">Slip Gaji Pekerja👷💵</h4>
      {{-- date picker  --}}
      <div class="mb-4" style="display: flex; align-items: center">
          <h5 for="datePickerRekapDcu" class="fw-bolder">Bulan : </h5>
          <form class="ms-3 p-0">
            <div class="p-0 border" style="background: white;display: flex; align-items: center; width: max-content">
                <input type="text" id="month-year-picker" name="month-year-picker" style="border: none">
                <label class="text-black p-0" for="month-year-picker"><span class="material-symbols-outlined">
                  keyboard_arrow_down
                  </span></label>
            </div>
          </form>
      </div>
      
      <button class="btn btn-sm btn-success" id="btnExportPdfOnlyMoon" style="display: flex; align-items: center">
        Export This Table to PDF
      </button>
      <br>
      {{-- tabel --}}
      <table id="myTable" class="display text-center">
          <thead>
              <tr class="text-center">
                  <th class="text-center">No</th>
                  <th class="text-center">Id Badge</th>
                  <th class="text-center">Posisi</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">No KTP</th>
                  <th class="text-center">No Rekening</th>
                  <th class="text-center">Total Gaji Pokok</th>
                  <th class="text-center">Total Gaji Harian</th>
                  <th class="text-center">Total Gaji Lembur</th>
                  <th class="text-center">Total Gaji Bersih</th>
                  <th class="text-center">Opsi</th>
              </tr>
          </thead>
          <tbody >
            @forelse($manpowers as $manpower)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $manpower->id_badge }}</td>
                    <td class="text-center">{{ $manpower->jabatan }}</td>
                    <td class="text-center">{{ $manpower->nama_pekerja }}</td>
                    <td class="text-center">{{ $manpower->no_ktp }}</td>

                    <td class="text-center"><span class="fw-bolder">{{ $manpower->salary->nama_bank }}</span><br> <span>{{ $manpower->salary->no_rekening }}</span></td>
                    <td class="text-center fw-bolder">{{ ($manpower->salary->gaji_pokok != null) ? number_format($manpower->salary->gaji_pokok, 0, ',', '.') : '-' }}</td>
                    <td class="text-center fw-bolder">{{ ($manpower->salary->jumlah_gaji_harian) ? number_format($manpower->salary->jumlah_gaji_harian, 0, ',', '.')  : '-' }}</td>
                    <td class="text-center fw-bolder">{{ $manpower->salary->jumlah_gaji_lembur ? number_format($manpower->salary->jumlah_gaji_lembur, 0, ',', '.')  : '-' }}</td>
                    <td class="text-center fw-bolder">{{ $manpower->salary->jumlah_gaji_bersih ? number_format($manpower->salary->jumlah_gaji_bersih, 0, ',', '.') : '-' }}</td>
                    <td class="text-center fw-bolder"><a href="{{ route('rekap-slip-gaji.show', $manpower->id) }}" class="btn btn-sm btn-dark mt-1 mb-1" style="width: 100%">DETAIL</a></td>
                </tr>
            @empty
            @endforelse
              
              {{-- <tr> --}}
                  {{-- <td class="text-center">2</td>
                  <td class="text-center">27501</td>
                  <td class="text-start">Projek Koordinator</td>
                  <td class="text-start">Kicu Freeze</td>
                  <td class="text-center">321232323122131</td>
                  <td class="text-center"><span>BRI</span>: <span>43674374364</span></td>
                  <td class="text-center fw-bolder">RP. 5.000.000</td>
                  <td class="text-center fw-bolder">RP. 200.000</td>
                  <td class="text-center fw-bolder">RP. 5.200.000</td> --}}
                  {{-- <td class="text-center" style="cursor: default"><span class="text-danger">Hapus</span> | <span class="text-warning">Edit</span></td> --}}
              {{-- </tr> --}}
          </tbody>
      </table>


      </div>

@endsection

@section('script')

{{-- script untuk handle export table html to pdf --}}
<script>
  document.getElementById('btnExportPdfOnlyMoon').addEventListener('click', function () {
      // Load the required functions from jsPDF
      const { jsPDF } = window.jspdf;

      // Create a new jsPDF instance
      const doc = new jsPDF();

      // Add autoTable plugin to the jsPDF instance
      doc.autoTable({ html: '#myTable' });

      // Save the generated PDF
      doc.save('table.pdf');
  });
</script>

{{-- script ini berguna untuk handle date picker yg hanya dapat pilih bulan dan tahun nya saja --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
<script>
    flatpickr("#month-year-picker", {
        plugins: [
            new monthSelectPlugin({
                shorthand: true, // Use shorthand month names (e.g., "Jan", "Feb")
                dateFormat: "F Y", // Display format for the input field
                altFormat: "F Y" // Display format for the alternative input field (if used)
            })
        ],
        dateFormat: "F Y",
    });

    // default val of input date month-year
    $('#month-year-picker').val('June 2024');
</script>
@endsection