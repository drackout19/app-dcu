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

{{-- ini style css untuk handle sticky notes jgn utak atik gw jga ga ngerti --}}
<style>
    
    .float-sticky-note h6, .float-sticky-note-masuk-kerja h6{
    font-family: 'Lato';
    font-weight: bold;
    }

    .float-sticky-note p, .float-sticky-note-masuk-kerja p{
    font-family: 'Rubik';
    font-weight: 400;
    }
    .float-sticky-note ul,li, .float-sticky-note-masuk-kerja ul{
    list-style:none;
    }
    ul{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    }
    .float-sticky-note ul li a, .float-sticky-note-masuk-kerja ul li a{
    text-decoration:none;
    color:#000;
    background:#ffc;
    display:block;
    min-height:10em;
    max-width:10em;
    padding:1em;
    box-shadow: 5px 5px 7px rgba(33,33,33,.7);
    transform: rotate(-6deg);
    transition: transform .15s linear;
    }

    .float-sticky-note ul li:nth-child(even) a, .float-sticky-note-masuk-kerja ul li:nth-child(even) a{
    transform:rotate(4deg);
    position:relative;
    top:5px;
    background:#cfc;
    }
    /* .float-sticky-note ul li:nth-child(3n) a{
    transform:rotate(-3deg);
    position:relative;
    top:-5px;
    background:#ccf;
    }
    .float-sticky-note ul li:nth-child(5n) a{
    transform:rotate(5deg);
    position:relative;
    top:-10px;
    } */

    .float-sticky-note ul li a:hover,ul li a:focus, .float-sticky-note-masuk-kerja ul li a:hover{
    box-shadow:10px 10px 7px rgba(0,0,0,.7);
    transform: scale(1.25);
    position:relative;
    z-index:5;
    }

    .float-sticky-note ul li, .float-sticky-note-masuk-kerja ul li{
    margin:1em;
    }
</style>

{{-- style lain lain pada page ini --}}
<style>
  input:focus {
    outline: none; 
  }

</style>


@endsection

@section('konten')
    {{-- content body --}}
    

      <div class="rounded bg-white p-2">
          <h5>Rekap Absensi</h5>
      </div>

      <div class="rounded bg-white mt-5 p-3" style="height: 70vh; overflow-x: scroll">
      {{-- title --}}
      <h4 class="fw-bolder text-center mb-5">Rekap Absensi Pekerja⏲️</h4>
      {{-- <br><br> --}}
      {{-- date picker  --}}
      <div class="bg-primary rounded p-1 mb-2 text-white" style="width: max-content">
        <form class="" action="{{ route('getDataTableTimesheetByDate') }}" id="formDate" method="post">
            @csrf
            <span class="mb-2" style="display: flex"><span class="material-symbols-outlined">sort</span>Sort By</span>
            <label for="inputDatePickerRekapDcu"> Tanggal:</label>
            <input type="date" id="inputDatePickerRekapDcu" name="inputDatePickerRekapDcu" value="{{ (isset($date)) ? $date : '' }}">
        </form>
      </div>
      
      
      
      <hr>
      <div style="width: 100%; display: flex;">
            <div class="btn btn-sm btn-success mt-2 ms-auto d-flex" id="btnExportExcel"><span class="material-symbols-outlined me-1">export_notes</span>Export Table to .xlsx</div>
      </div>
      <br>
      {{-- tabel --}}
      <div id="dataTableRekapTimesheet">
        <table id="myTable" class="display text-center">
            <thead>
                <tr class="text-center">
                    <th class="text-center">No</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Id Badge</th>
                    <th class="text-center">Jabatan</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Jam Masuk</th>
                    <th class="text-center">Jam Lembur</th>
                    <th class="text-center">Jam Pulang</th>
                    <th class="text-center">Total Waktu Lembur</th>
                    {{-- <th class="text-center">Opsi</th> --}}
                </tr>
            </thead>
            <tbody >

                {{-- @foreach($manpowers as $manpower) --}}
                    {{-- @foreach($data->where('tanggal', '2024-07-15') as $dataDCU) --}}
                        
                            @foreach($manpowers as $manpower)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $date }}</td>
                                    <td class="text-center">{{ $manpower->no_kartu_badge }}</td>
                                    <td class="text-start">{{ $manpower->jabatan }}</td>
                                    <td class="text-start">{{ $manpower->nama_pekerja }}</td>
                                {{-- @forelse($data->where('tanggal', '2024-07-15')->where('manpower_id', $manpower->id) as $dataDCU) --}}
                                {{-- @forelse($manpower->dcurecap->where('tanggal', ) as $dcurecaps) --}}
                                    
                                    {{-- @foreach($timesheets->where('dcurecap_id', $dcurecaps->id) as $timesheet) --}}

                                    {{-- @foreach($manpower->dcurecap->where('manpower_id', $manpower->id) as $dcu) --}}
                                    {{-- @php
                                        $isBreakForelse = false;
                                    @endphp --}}
                                    @forelse($rekapDCU->where('manpower_id', $manpower->id) as $dcu)
                                        @if($dcu->status_dcu == 'FIT')
                                            
                                                @forelse($timesheets->where('dcurecap_id', $dcu->id) as $timesheet)
                                                        {{-- @if($timesheet->dcurecap->id == $dcu->id && $timesheet->dcurecap->tanggal == '2024-07-16') --}}
                                                        {{-- @if($isBreakForelse == false) --}}
                                                        @if($timesheet->dcurecap->id == $dcu->id)
                                                            <td class="text-center fw-bolder">{{ $timesheet->jamMasuk }}</td>
                                                            <td class="text-center fw-bolder">{{ $timesheet->jamLembur }}</td>
                                                            <td class="text-center fw-bolder">{{ $timesheet->jamPulang }}</td>
                                                            <td class="text-center fw-bolder">{{ $timesheet->totalWaktuLembur }}</td>
                                                            {{-- @break --}}
                                                            {{-- @php
                                                                $isBreakForelse = true;  
                                                            @endphp --}}
                                                        @else 
                                                            {{-- @if($dcu->status_dcu != 'FIT') --}}
                                                                <td class="text-center fw-bolder">-f</td>
                                                                <td class="text-center fw-bolder">-</td>
                                                                <td class="text-center fw-bolder">-</td>
                                                                <td class="text-center fw-bolder">-</td>
                                                                {{-- @php
                                                                    $isBreakForelse = true;  
                                                                @endphp
                                                                @break --}}
                                                            {{-- @endif --}}
                                                        @endif
                                                        {{-- @endif --}}
                                                @empty
                                                        <td class="text-center fw-bolder">-</td>
                                                        <td class="text-center fw-bolder">-</td>
                                                        <td class="text-center fw-bolder">-</td>
                                                        <td class="text-center fw-bolder">-</td>
                                                @endforelse
                                            {{-- @else
                                                <td class="text-center fw-bolder">-</td>
                                                <td class="text-center fw-bolder">-</td>
                                                <td class="text-center fw-bolder">-</td>
                                                <td class="text-center fw-bolder">-</td>  --}}
                                            {{-- @endif --}}
                                        @else
                                            <td class="text-center fw-bolder">-</td>
                                            <td class="text-center fw-bolder">-</td>
                                            <td class="text-center fw-bolder">-</td>
                                            <td class="text-center fw-bolder">-</td>
                                        @endif
                                    @empty
                                        <td class="text-center fw-bolder">-</td>
                                        <td class="text-center fw-bolder">-</td>
                                        <td class="text-center fw-bolder">-</td>
                                        <td class="text-center fw-bolder">-</td>
                                        {{-- @break --}}
                                    @endforelse

                                    {{-- @foreach($timesheets as $timesheet) --}}

                                            {{-- {{ dd($rekapDCU->find($timesheet->dcurecap->id)) }} --}}
                                            {{-- @if($timesheet->dcurecap->manpower_id == $manpower->id) --}}
                                            {{-- @forelse($timesheet->dcurecap->manpower_id == $manpower->id as $item)
                                                <td class="text-center fw-bolder">{{ $timesheet->jamMasuk }}</td>
                                                <td class="text-center fw-bolder">{{ $timesheet->jamLembur }}</td>
                                                <td class="text-center fw-bolder">{{ $timesheet->jamPulang }}</td>
                                                <td class="text-center fw-bolder">{{ $timesheet->totalWaktuLembur }}</td>
                                            @empty
                                                <td class="text-center fw-bolder">-</td>
                                                <td class="text-center fw-bolder">-</td>
                                                <td class="text-center fw-bolder">-</td>
                                                <td class="text-center fw-bolder">-</td>
                                            @endforelse --}}
                                            {{-- @if(($rekapDCU->find($timesheet->dcurecap->id)) != null)

                                                        <td class="text-center fw-bolder">{{ $timesheet->jamMasuk }}</td>
                                                        <td class="text-center fw-bolder">{{ $timesheet->jamLembur }}</td>
                                                        <td class="text-center fw-bolder">{{ $timesheet->jamPulang }}</td>
                                                        <td class="text-center fw-bolder">{{ $timesheet->totalWaktuLembur }}</td>
                                                        @break --}}
                                                    {{-- </tr> --}}
                                            {{-- @else
                                                        <td class="text-center fw-bolder">-</td>
                                                        <td class="text-center fw-bolder">-</td>
                                                        <td class="text-center fw-bolder">-</td>
                                                        <td class="text-center fw-bolder">-</td>
                                                        @break --}}
                                                    {{-- </tr> --}}
                                            {{-- @endif --}}
                                            {{-- hapus aja --}}
                                            {{-- @foreach ($timesheet->dcurecap as $dcurecaps)
                                                {{ dd($timesheet->dcurecap) }} --}}
                                                {{-- @foreach($dcurecaps->where('manpower_id', $manpower->id) as $item) --}}
                                                        {{-- <td class="text-center fw-bolder">{{ $timesheet->jamMasuk }}</td>
                                                        <td class="text-center fw-bolder">{{ $timesheet->jamLembur }}</td>
                                                        <td class="text-center fw-bolder">{{ $timesheet->jamPulang }}</td>
                                                        <td class="text-center fw-bolder">{{ $timesheet->totalWaktuLembur }}</td>
                                                    </tr> --}}
                                                {{-- @endforeach --}}
                                            {{-- @empty --}}
                                                    {{-- <td class="text-center fw-bolder">-</td>
                                                    <td class="text-center fw-bolder">-</td>
                                                    <td class="text-center fw-bolder">-</td>
                                                    <td class="text-center fw-bolder">-</td>
                                                </tr> --}}
                                            {{-- @endforeach --}}
                                            {{-- end hapus aja --}}

                                            {{-- {{ dd($timesheet) }} --}}
                                            {{-- @if($timesheet->dcurecap_id == $dataDCU->id) --}}
                                                {{-- <td class="text-center fw-bolder">{{ $timesheet->jamMasuk }}</td>
                                                <td class="text-center fw-bolder">{{ $timesheet->jamLembur }}</td>
                                                <td class="text-center fw-bolder">{{ $timesheet->jamPulang }}</td>
                                                <td class="text-center fw-bolder">{{ $timesheet->totalWaktuLembur }}</td> --}}
                                            {{-- @else 
                                                <td class="text-center fw-bolder">ktk</td>
                                                <td class="text-center fw-bolder">-</td>
                                                <td class="text-center fw-bolder">-</td>
                                                <td class="text-center fw-bolder">-</td>
                                            @endif --}}
                                            
                                    {{-- </tr> --}}
                                    
                                    {{-- @endforeach  --}}

                                {{-- @empty
                                        <td class="text-center fw-bolder">-</td>
                                        <td class="text-center fw-bolder">-</td>
                                        <td class="text-center fw-bolder">-</td>
                                        <td class="text-center fw-bolder">-</td>
                                    </tr>
                                @endforelse --}}
                                </tr>
                            @endforeach
                    {{-- @endforeach --}}
                    {{-- <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">2024-07-13</td>
                        <td class="text-center">{{ $manpower->no_kartu_badge }}</td>
                        <td class="text-start">{{ $manpower->jabatan }}</td>
                        <td class="text-start">{{ $manpower->nama_pekerja }}</td>
                        <td class="text-center fw-bolder">08.00.00</td>
                        <td class="text-center fw-bolder">17.00.00</td>
                        <td class="text-center fw-bolder">19.00.00</td>
                        <td class="text-center fw-bolder">2 Jam 5 Menit</td>
                    </tr> --}}
                {{-- @endforeach --}}

                {{-- <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">19 Juni 2024</td>
                    <td class="text-center">27501</td>
                    <td class="text-start">Supervisor</td>
                    <td class="text-start">Micu Turismo</td>
                    <td class="text-center fw-bolder">08.00.00</td>
                    <td class="text-center fw-bolder">17.00.00</td>
                    <td class="text-center fw-bolder">19.00.00</td>
                    <td class="text-center fw-bolder">2 Jam 5 Menit</td> --}}
                    {{-- <td class="text-center" style="cursor: default"><span class="text-danger">Hapus</span> | <span class="text-warning">Edit</span></td> --}}
                {{-- </tr> --}}
                {{-- <tr>
                    <td class="text-center">2</td>
                    <td class="text-center">19 Juni 2024</td>
                    <td class="text-center">27501</td>
                    <td class="text-start">Projek Koordinator</td>
                    <td class="text-start">Kicu Freeze</td>
                    <td class="text-center fw-bolder">08.00.00</td>
                    <td class="text-center fw-bolder">17.00.00</td>
                    <td class="text-center fw-bolder">19.00.00</td>
                    <td class="text-center fw-bolder">2 Jam 5 Menit</td> --}}
                    {{-- <td class="text-center" style="cursor: default"><span class="text-danger">Hapus</span> | <span class="text-warning">Edit</span></td> --}}
                {{-- </tr> --}}
            </tbody>
        </table>
      </div>


      </div>

@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"></script> --}}



<script>
    $("#inputDatePickerRekapDcu").change(function() {
        let inputDatePickerRekapDcu = $("#inputDatePickerRekapDcu").val();
        // alert(inputDatePickerRekapDcu);
        $("#inputDatePickerRekapDcu").val(inputDatePickerRekapDcu);

        $("#formDate").submit();
    });

    // $("#month-year-picker").click(function(e) {
    //     e.preventDefault();
    // });
    document.getElementById('month-year-picker').addEventListener("click", function(e) {
        e.preventDefault();
    }, true);

    // $("#btnExportExcelOnlyMoon").click(function(e) {
    $("#month-year-picker").change(function() {
        // e.preventDefault();
        $("#inputDatePickerRekapDcu").val('');
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
                url: '{{ route('timesheetRecapMontYear') }}',
                type: 'POST',
                data: { // Add CSRF token
                    monthYear: monthYearPicker,
                },
                success: function(response) {
                    // console.log('Data sent successfully:', response);
                    // formDCU.submit();
                    // location.reload();
                    let dataTableRekapTimesheet = $('#dataTableRekapTimesheet');

                    dataTableRekapTimesheet.empty(); // Clear previous data

                    dataTableRekapTimesheet.append(response);
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
</script>

{{-- script untuk handle export table html to xls --}}
<script>
  document.getElementById('btnExportExcel').addEventListener('click', function () {

        // Get the table
        let table = document.getElementById('myTable');

        // Convert table to a worksheet
        let worksheet = XLSX.utils.table_to_sheet(table);

        // Create a new workbook
        let workbook = XLSX.utils.book_new();

        // Append the worksheet to the workbook
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');

        // Generate Excel file and trigger a download
        XLSX.writeFile(workbook, 'table.xlsx');
        
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
    // $('#month-year-picker').val('June 2024');
</script>
@endsection