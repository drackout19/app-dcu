@extends('layouts.main')


@section('css')
    {{-- link font lato google --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    {{-- link font rubik google --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Reenie+Beanie&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

    {{-- link untuk fitur export table html to pdf --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>

    {{-- link date picker yang hanya dapa select atau pilih bulan dan tahun saja --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">

    <style>
        #myTable th,
        td {
            padding: 7px
        }
    </style>
@endsection



@section('konten')
    {{-- content body --}}


    <div class="rounded bg-white p-2">
        <h5>Detail Absensi, Lembur, dan Gaji</h5>
    </div>

    <div class="rounded bg-white mt-5 p-3" style="height: 70vh; overflow-x: scroll">
        {{-- title --}}
        <h4 class="fw-bolder mb-5 text-center">Detail Absensi, Lembur, dan Gaji Pekerja👷💵</h4>

        <div class="mt-3">
            <h5>Data Absensi</h5>

            {{-- table absensi person --}}
            <section id="table-absensi"></section>
        </div>

        <div class="mt-5">
            <h5>Data Lembur</h5>

            <section id="table-lembur"></section>
        </div>

        <div class="mt-5">
            <h5>Data Gaji</h5>

            <section id="table-gaji"></section>
        </div>

        <div class="mt-5">
            <h5>Data Pendapatan</h5>

            <section id="table-pendapatan"></section>
        </div>

        <div class="mt-5">
            <h5>Slip Gaji</h5>

            <section id="slip-gaji"></section>
        </div>

    </div>
@endsection

@section('script')
    {{-- script untuk handle export table html to pdf --}}
    <script>
        $('document').ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // 
            // Send data to Laravel using AJAX
            jQuery.ajax({
                url: '{{ route('getDataTableTimesheetPerson') }}',
                type: 'POST',
                data: { // Add CSRF token
                    monthYear: `{{ $monthYear }}`,
                    id: {{ $id }}
                },
                success: function(response) {
                    // console.log('Data sent successfully:', response);
                    // formDCU.submit();
                    // location.reload();
                    let table_absensi = $('#table-absensi');

                    table_absensi.empty(); // Clear previous data

                    table_absensi.append(response);
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

            jQuery.ajax({
                url: '{{ route('getDataTableLemburPerson') }}',
                type: 'POST',
                data: { // Add CSRF token
                    monthYear: `{{ $monthYear }}`,
                    id: {{ $id }}
                },
                success: function(response) {
                    // console.log('Data sent successfully:', response);
                    // formDCU.submit();
                    // location.reload();
                    let table_lembur = $('#table-lembur');

                    table_lembur.empty(); // Clear previous data

                    table_lembur.append(response);
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

            jQuery.ajax({
                url: '{{ route('getDataTableGajiPerson') }}',
                type: 'POST',
                data: { // Add CSRF token
                    monthYear: `{{ $monthYear }}`,
                    id: {{ $id }}
                },
                success: function(response) {
                    // console.log('Data sent successfully:', response);
                    // formDCU.submit();
                    // location.reload();
                    let table_gaji = $('#table-gaji');

                    table_gaji.empty(); // Clear previous data

                    table_gaji.append(response);
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

            

            jQuery.ajax({
                url: '{{ route('getSlipGajiPerson') }}',
                type: 'POST',
                data: { // Add CSRF token
                    monthYear: `{{ $monthYear }}`,
                    id: {{ $id }}
                },
                success: function(response) {
                    // console.log('Data sent successfully:', response);
                    // formDCU.submit();
                    // location.reload();
                    let table_slip_gaji = $('#slip-gaji');

                    table_slip_gaji.empty(); // Clear previous data

                    table_slip_gaji.append(response);
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
            
            jQuery.ajax({
                url: '{{ route('getDataTablePendapatanPerson') }}',
                type: 'POST',
                data: { // Add CSRF token
                    monthYear: `{{ $monthYear }}`,
                    id: {{ $id }}
                },
                success: function(response) {
                    // console.log('Data sent successfully:', response);
                    // formDCU.submit();
                    // location.reload();
                    let table_pendapatan = $('#table-pendapatan');

                    table_pendapatan.empty(); // Clear previous data

                    table_pendapatan.append(response);
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

        function simpanAksiEdit(id) {
            // let actionUrl = `{{ route('updatePendapatanGaji', ':id') }}`;
            // actionUrl = actionUrl.replace(':id', id);

            // $(`#formPendapatan${id}`).attr('action', `/updatePendapatanGaji/${id}`);
            // $(`#formPendapatan${id}`).attr('action', actionUrl);

            let ubahJumlahGajiHarian = $(`#ubahJumlahGajiHarian${id}`).val();
            let ubahJumlahGajiLembur = $(`#ubahJumlahGajiLembur${id}`).val();
            let ubahJumlahGajiBersih = $(`#ubahJumlahGajiBersih${id}`).val();
            // alert(ubahJumlahGajiBersih);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // 
            // Send data to Laravel using AJAX
            jQuery.ajax({
                url: '{{ route('updatePendapatanGaji') }}',
                type: 'POST',
                data: { // Add CSRF token
                    monthYear: `{{ $monthYear }}`,
                    id: {{ $id }},
                    jumlahGajiHarian : ubahJumlahGajiHarian,
                    jumlahGajiLembur : ubahJumlahGajiLembur,
                    jumlahGajiBersih : ubahJumlahGajiBersih,
                },
                success: function(response) {
                    window.location.href = response.redirect;
                    // console.log('Data sent successfully:', response);
                    // formDCU.submit();
                    // location.reload();
                    // let table_absensi = $('#table-absensi');

                    // table_absensi.empty(); // Clear previous data

                    // table_absensi.append(response);
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

            // $(`#formPendapatan${id}`).submit();
        }

        function aksiApproveByHRD(id) {

            let ubahJumlahGajiHarian = $(`#ubahJumlahGajiHarian${id}`).val();
            let ubahJumlahGajiLembur = $(`#ubahJumlahGajiLembur${id}`).val();
            let ubahJumlahGajiBersih = $(`#ubahJumlahGajiBersih${id}`).val();
            // alert(ubahJumlahGajiBersih);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // 
            // Send data to Laravel using AJAX
            jQuery.ajax({
                url: '{{ route('approvePendapatanGajiByHRD') }}',
                type: 'POST',
                data: { // Add CSRF token
                    monthYear: `{{ $monthYear }}`,
                    id: {{ $id }},
                    jumlahGajiHarian : ubahJumlahGajiHarian,
                    jumlahGajiLembur : ubahJumlahGajiLembur,
                    jumlahGajiBersih : ubahJumlahGajiBersih,
                },
                success: function(response) {
                    window.location.href = response.redirect;
                },
                error: function(xhr, status, error) {
                    console.error('Error sending data:', error);
                    
                }
            });
        }

        function aksiCancelApproveByHRD(id) {

            let ubahJumlahGajiHarian = $(`#ubahJumlahGajiHarian${id}`).val();
            let ubahJumlahGajiLembur = $(`#ubahJumlahGajiLembur${id}`).val();
            let ubahJumlahGajiBersih = $(`#ubahJumlahGajiBersih${id}`).val();
            // alert(ubahJumlahGajiBersih);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // 
            // Send data to Laravel using AJAX
            jQuery.ajax({
                url: '{{ route('cancelApprovePendapatanGajiByHRD') }}',
                type: 'POST',
                data: { // Add CSRF token
                    monthYear: `{{ $monthYear }}`,
                    id: {{ $id }},
                    jumlahGajiHarian : ubahJumlahGajiHarian,
                    jumlahGajiLembur : ubahJumlahGajiLembur,
                    jumlahGajiBersih : ubahJumlahGajiBersih,
                },
                success: function(response) {
                    window.location.href = response.redirect;
                },
                error: function(xhr, status, error) {
                    console.error('Error sending data:', error);
                    
                }
            });
        }

        function aksiApproveByKeuangan(id) {

            let ubahJumlahGajiHarian = $(`#ubahJumlahGajiHarian${id}`).val();
            let ubahJumlahGajiLembur = $(`#ubahJumlahGajiLembur${id}`).val();
            let ubahJumlahGajiBersih = $(`#ubahJumlahGajiBersih${id}`).val();
            // alert(ubahJumlahGajiBersih);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // 
            // Send data to Laravel using AJAX
            jQuery.ajax({
                url: '{{ route('approvePendapatanGajiByKeuangan') }}',
                type: 'POST',
                data: { // Add CSRF token
                    monthYear: `{{ $monthYear }}`,
                    id: {{ $id }},
                    jumlahGajiHarian : ubahJumlahGajiHarian,
                    jumlahGajiLembur : ubahJumlahGajiLembur,
                    jumlahGajiBersih : ubahJumlahGajiBersih,
                },
                success: function(response) {
                    window.location.href = response.redirect;
                },
                error: function(xhr, status, error) {
                    console.error('Error sending data:', error);
                    
                }
            });
        }

        function aksiCancelApproveByKeuangan(id) {

            let ubahJumlahGajiHarian = $(`#ubahJumlahGajiHarian${id}`).val();
            let ubahJumlahGajiLembur = $(`#ubahJumlahGajiLembur${id}`).val();
            let ubahJumlahGajiBersih = $(`#ubahJumlahGajiBersih${id}`).val();
            // alert(ubahJumlahGajiBersih);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // 
            // Send data to Laravel using AJAX
            jQuery.ajax({
                url: '{{ route('cancelApprovePendapatanGajiByKeuangan') }}',
                type: 'POST',
                data: { // Add CSRF token
                    monthYear: `{{ $monthYear }}`,
                    id: {{ $id }},
                    jumlahGajiHarian : ubahJumlahGajiHarian,
                    jumlahGajiLembur : ubahJumlahGajiLembur,
                    jumlahGajiBersih : ubahJumlahGajiBersih,
                },
                success: function(response) {
                    window.location.href = response.redirect;
                },
                error: function(xhr, status, error) {
                    console.error('Error sending data:', error);
                    
                }
            });
        }
        function aksiCancelApproveByKeuangan(id) {

            let ubahJumlahGajiHarian = $(`#ubahJumlahGajiHarian${id}`).val();
            let ubahJumlahGajiLembur = $(`#ubahJumlahGajiLembur${id}`).val();
            let ubahJumlahGajiBersih = $(`#ubahJumlahGajiBersih${id}`).val();
            // alert(ubahJumlahGajiBersih);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // 
            // Send data to Laravel using AJAX
            jQuery.ajax({
                url: '{{ route('cancelApprovePendapatanGajiByKeuangan') }}',
                type: 'POST',
                data: { // Add CSRF token
                    monthYear: `{{ $monthYear }}`,
                    id: {{ $id }},
                    jumlahGajiHarian : ubahJumlahGajiHarian,
                    jumlahGajiLembur : ubahJumlahGajiLembur,
                    jumlahGajiBersih : ubahJumlahGajiBersih,
                },
                success: function(response) {
                    window.location.href = response.redirect;
                },
                error: function(xhr, status, error) {
                    console.error('Error sending data:', error);
                    
                }
            });
        }

        //   document.getElementById('btnExportPdfOnlyMoon').addEventListener('click', function () {
        //       // Load the required functions from jsPDF
        //       const { jsPDF } = window.jspdf;

        //       // Create a new jsPDF instance
        //       const doc = new jsPDF();

        //       // Add autoTable plugin to the jsPDF instance
        //       doc.autoTable({ html: '#myTable' });

        //       // Save the generated PDF
        //       doc.save('table.pdf');
        //   });
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
