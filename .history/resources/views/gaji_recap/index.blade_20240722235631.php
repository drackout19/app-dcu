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
      <div class="bg-primary rounded p-1 text-white mb-3" style="width: max-content">
        <span class="mb-" style="display: flex"><span class="material-symbols-outlined">sort</span>Sort By</span>
        
        <div class="p-1" style="display: flex;">
            <label for="month-year-picker"> Bulan & Tahun:</label>
            <form class="ms-1 p-0" id="formMonthYear" method="post">
            @csrf
                <div class="p-0" style="background: white; display: flex; align-items: center">
                    <input type="text" id="month-year-picker" name="month-year-picker" style="border: none; width: 110px;" placeholder="Pilih">
                    <label class="text-black p-0" for="month-year-picker"><span class="material-symbols-outlined">
                    keyboard_arrow_down
                    </span></label>
                </div>
            </form>
        </div>
      </div>
      <hr>
      <div style="width: 100%; display: flex;">
        <div class="btn btn-sm btn-success mt-2 ms-auto d-flex" id="btnExportExcel"><span class="material-symbols-outlined me-1">export_notes</span>Export Table to .xlsx</div>
      </div>
      <br>
      {{-- tabel --}}
    <section id="table-gaji">
        <table id="myTable" class="display text-center">
            <thead>
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
            </thead>
            <tbody >
                @forelse($manpowers as $manpower)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $manpower->id_badge }}</td>
                        <td class="text-center">{{ $manpower->jabatan }}</td>
                        <td class="text-center">{{ $manpower->nama_pekerja }}</td>
                        <td class="text-center">{{ $manpower->no_ktp }}</td>
                        {{-- {!! $dataTimesheet[0]->dcurecap->where(['tanggal' => '2024-07-19'])->first() !!} --}}
                        @php
                            // $pattern = $year.'-'.$monthName.'-'.'\d{2}$';
                            // $pattern = '2024-07-\d{2}$';
                            // $data = Dcurecap::whereRaw('tanggal REGEXP ?', [$pattern])->get();
                        
                        
                        // dd($manpower->dcurecap->where('tanggal REGEXP ?', [$pattern]));
                        // ini di gunakan
                        // $pattern = '2024-07-\d{2}$';
                        // $filteredDcurecap = $manpower->dcurecap->filter(function ($item) use ($pattern) {
                        //     return preg_match("/$pattern/", $item->tanggal);
                        // });

                        // // dd($filteredDcurecap);
                        // foreach ($filteredDcurecap as $key) {
                        //     dd($key->manpower_id);
                        // }

                        // debug
                        // echo $manpower->dcurecap[0]->manpower_id;
                        //enddebug

                        @endphp

                        {{-- {{ dd($monthYear) }} --}}
                        
                        
                        {{-- {{ dd($manpower->dcurecap) }} --}}
                        @if(!$manpower->dcurecap->isEmpty())
                            {{-- {{ 'yes' }} --}}
                            @foreach($manpower->dcurecap as $dcurecapPerson)
                                {{-- {{ $dcurecapPerson->tanggal}} --}}
                                {{-- @if($dcurecapPerson->tanggal == '2024-07-') --}}
                                @if($dcurecapPerson->manpower_id == $manpower->id)
                                    @php
                                        $pattern = $monthYear.'-\d{2}$';
                                    @endphp

                                    @if(preg_match("/$pattern/", $dcurecapPerson->tanggal))
                                        {{-- {!! 'yes sama brok<br>' !!} --}}
                                        <td class="text-center"><span class="fw-bolder">{{ $manpower->salary->nama_bank }}</span><br> <span>{{ $manpower->salary->no_rekening }}</span></td>
                                        <td class="text-center fw-bolder">{{ ($manpower->salary->gaji_pokok != null) ? number_format($manpower->salary->gaji_pokok, 0, ',', '.') : '-' }}</td>
                                        <td class="text-center fw-bolder">{{ ($manpower->salary->jumlah_gaji_harian) ? number_format($manpower->salary->jumlah_gaji_harian, 0, ',', '.')  : '-' }}</td>
                                        <td class="text-center fw-bolder">{{ $manpower->salary->jumlah_gaji_lembur ? number_format($manpower->salary->jumlah_gaji_lembur, 0, ',', '.')  : '-' }}</td>
                                        <td class="text-center fw-bolder">{{ $manpower->salary->jumlah_gaji_bersih ? number_format($manpower->salary->jumlah_gaji_bersih, 0, ',', '.') : '-' }}</td>
                                        <td class="text-center fw-bolder">
                                            <a href="" class="btn btn-sm btn-dark mt-1 mb-1" style="width: 100%" id="btnDetail{{ $manpower->id }}" onclick="btnClickDetail({{ $manpower->id }})">DETAIL</a>
                                        </td>
                                    @else
                                        {{-- {{ 'ga sama brok' }} --}}
                                        <td class="text-center"><span class="fw-bolder">{{ $manpower->salary->nama_bank }}</span><br> <span>{{ $manpower->salary->no_rekening }}</span></td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        {{-- debug --}}
                                            {{-- <td class="text-center fw-bolder"><a href="" class="btn btn-sm btn-dark mt-1 mb-1" style="width: 100%" id="btnDetail{{ $manpower->id }}" onclick="btnClickDetail({{ $manpower->id }})">DETAIL</a></td> --}}
                                        {{-- end debug --}}
                                    @endif
                                    @break
                                @endif
                                {{-- @break --}}
                            @endforeach
                        @else 
                            <td class="text-center"><span class="fw-bolder">{{ $manpower->salary->nama_bank }}</span><br> <span>{{ $manpower->salary->no_rekening }}</span></td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            {{-- debug --}}
                                {{-- <td class="text-center fw-bolder"><a href="" class="btn btn-sm btn-dark mt-1 mb-1" style="width: 100%" id="btnDetail{{ $manpower->id }}" onclick="btnClickDetail({{ $manpower->id }})">DETAIL</a></td> --}}
                            {{-- end debug --}}
                        @endif
                        {{-- <td class="text-center"><span class="fw-bolder">{{ $manpower->salary->nama_bank }}</span><br> <span>{{ $manpower->salary->no_rekening }}</span></td>
                        <td class="text-center fw-bolder">{{ ($manpower->salary->gaji_pokok != null) ? number_format($manpower->salary->gaji_pokok, 0, ',', '.') : '-' }}</td>
                        <td class="text-center fw-bolder">{{ ($manpower->salary->jumlah_gaji_harian) ? number_format($manpower->salary->jumlah_gaji_harian, 0, ',', '.')  : '-' }}</td>
                        <td class="text-center fw-bolder">{{ $manpower->salary->jumlah_gaji_lembur ? number_format($manpower->salary->jumlah_gaji_lembur, 0, ',', '.')  : '-' }}</td>
                        <td class="text-center fw-bolder">{{ $manpower->salary->jumlah_gaji_bersih ? number_format($manpower->salary->jumlah_gaji_bersih, 0, ',', '.') : '-' }}</td>
                        <td class="text-center fw-bolder"><a href="" class="btn btn-sm btn-dark mt-1 mb-1" style="width: 100%" id="btnDetail{{ $manpower->id }}" onclick="btnClickDetail({{ $manpower->id }})">DETAIL</a></td> --}}
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
    </section>


      </div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

{{-- script untuk handle export table html to pdf --}}
<script>

    // $('document').ready(function() {
        // alert($('#month-year-picker').val());

        $("#month-year-picker").change(function() {
            // alert();
            // e.preventDefault();
            // $("#inputDatePickerRekapDcu").val('');
            let monthYearPicker = $("#month-year-picker").val();
            // alert(inputDatePickerRekapDcu);
            // $("#inputDatePickerRekapDcu").val(inputDatePickerRekapDcu);

            // alert($("#month-year-picker").val());

            
            // $("#formMonthYear").submit();

            // coba sendiri
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                    // 
                    // Send data to Laravel using AJAX

                jQuery.ajax({
                    url: '{{ route('getViewIndexSlipGajiByMonthYear') }}',
                    type: 'POST',
                    data: { // Add CSRF token
                        monthYear: monthYearPicker,
                    },
                    success: function(response) {
                        // console.log('Data sent successfully:', response);
                        // formDCU.submit();
                        // location.reload();
                        let dataTableGaji = $('#table-gaji');

                        dataTableGaji.empty(); // Clear previous data

                        dataTableGaji.append(response);
                        // if (response.length > 0) {
                        //     response.forEach(function(item) {
                        //         dataContainer.append('<p>' + item.status_dcu + ' - ' + item.tanggal + '</p>');
                        //     });
                        // } else {
                        //     dataContainer.append('<p>No data found for the given month and year.</p>');
                        // }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error sending data:', error);
                    }
                });
        });

 

    function btnClickDetail(id) {
        let monthYear = $('#month-year-picker').val();

        let url = `{{ route('rekap-slip-gaji.show', ['ID_PLACEHOLDER', 'MONTH_YEAR_PLACEHOLDER']) }}`
        .replace('ID_PLACEHOLDER', id)
        .replace('MONTH_YEAR_PLACEHOLDER', monthYear);


        $(`#btnDetail${id}`).attr('href', url);
    }
        
    // });
    
</script>
{{-- script untuk handle export table html to xls --}}
<script>
    $('#btnExportExcel').click(function () {
         // Select the original table
        var originalTable = document.getElementById('myTable');
        
        // Create a new table element
        var exportTable = document.createElement('table');
        
        // Clone the table header and body
        var originalHeader = originalTable.querySelector('thead').cloneNode(true);
        var originalBody = originalTable.querySelector('tbody').cloneNode(true);
        
        // Remove the "Opsi" column from the header
        var headerCells = originalHeader.querySelectorAll('th');
        headerCells[headerCells.length - 1].remove(); // Assuming "Opsi" is the last column

        // Remove the "Opsi" column from each row in the body
        var rows = originalBody.querySelectorAll('tr');
        rows.forEach(function(row) {
            var cells = row.querySelectorAll('td');
            cells[cells.length - 1].remove(); // Assuming "Opsi" is the last column
        });
        
        // Append the modified header and body to the new table
        exportTable.appendChild(originalHeader);
        exportTable.appendChild(originalBody);

        // Convert the new table to a worksheet
        var ws = XLSX.utils.table_to_sheet(exportTable, { raw: true });

        // Create a new Workbook
        var wb = XLSX.utils.book_new();

        // Append the worksheet to the workbook
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

        // Write the workbook and download it
        XLSX.writeFile(wb, 'data.xlsx');
          
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
    let date = new Date();

    // Define the options for the toLocaleDateString method
    let options = { year: 'numeric', month: 'long' };

    // Format the date using the specified options and locale
    let formattedDate = date.toLocaleDateString('en-US', options);

    // $('#month-year-picker').val('June 2024');
    $('#month-year-picker').val(formattedDate);
</script>
@endsection