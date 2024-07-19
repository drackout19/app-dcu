<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        #myTable th, td {
            padding: 7px
        }
    </style>
</head>
<body>
     
    <table class="table-bordered mx-auto mt-3 text-center" id="myTable" style="background: #f0f0f0">
        
        <tr> 
            <th rowspan="3">No</th> 
            <th rowspan="3">Id Badge</th> 
            <th rowspan="3">Jabatan</th> 
            <th rowspan="3">Nama</th> 
            <th rowspan="3">Jenis Kelamin</th> 
            <th colspan="31" >{{ $monthYear }}</th>
            {{-- <th colspan="31" >July 2024</th> --}}
            
            {{-- <th colspan="2">40</th> 
            <th colspan="2">20</th>  --}}
        </tr>
        <tr>
            <th colspan="31">Hari</th>
        </tr>
        <tr>
            {{-- <td colspan=""></td> --}}
            {{-- <th class="bg-dark text-white">1</th>
            <th class="bg-dark text-white">2</th>
            <th class="bg-dark text-white">3</th>
            <th class="bg-dark text-white">4</th>
            <th class="bg-dark text-white">5</th> --}}
            @php
                for($day = 1; $day <= 31; $day++) {
                    echo '<th class="bg-dark text-white">'.$day.'</th>';
                }
            @endphp
        </tr>

        {{-- {{ $dataManpower[0]->id }} --}}
        @foreach($dataManpower as $dataPerson)

            <tr>
            {{-- @foreach($data->where('manpower_id', $dataPerson->id) as $dataDCU) --}}
                
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $dataPerson->no_kartu_badge }}</td>
                    <td>{{ $dataPerson->jabatan }}</td>
                    <td>{{ $dataPerson->nama_pekerja }}</td>
                    <td>{{ $dataPerson->jenis_kelamin }}</td>
                    @php
                        $isBreak = false;
                        for($day = 1; $day <= 31; $day++) {
                        echo '<td>';
                            foreach($data->where('manpower_id', $dataPerson->id) as $dataDCU){
                                // dd($dataDCU->id);
                                // foreach($timesheets->where('dcurecap_id', $dataDCU->id) as $dataTimesheets) {
                                //     print_r($dataTimesheets->jamMasuk);
                                // }
                                // exit;
                                if($day <= 9) {
                                    // $dayDecimal = '0'.$day;
                                    $dayDecimal = str_pad($day, 2, '0', STR_PAD_LEFT);
                                    // print_r($dataDCU->tanggal . '<br>');
                                    // if (preg_match('/^\d{4}-\d{2}-' . $dayDecimal . '$/', $dataDCU->tanggal)) {
                                    // $pattern = '/^\d{4}-\d{2}-13$/';
                                    $pattern = '/^\d{4}-\d{2}-'.$dayDecimal.'$/';
                                    // print_r($pattern.'<br>');
                                    // $subject = '2024-07-13';
                                    $subject = $dataDCU->tanggal;
                
                                    if (preg_match($pattern, $subject)) {
                                        if(($timesheets->where('dcurecap_id', $dataDCU->id)->first()) != null) {
                                                echo '✅';
                                        } else {
                                            echo '-';
                                        }
                                        // print_r($dayDecimal.' : '.$dataDCU->status_dcu.'<br>');
                                        
                                        // $day++;
                                        $isBreak = true;
                                    }
                                    
                                    
                                    
                                } else {
                                    $pattern = '/^\d{4}-\d{2}-'.$day.'$/';
                                    // print_r($pattern.'<br>');
                                    // $subject = '2024-07-13';
                                    $subject = $dataDCU->tanggal;
                
                                    if (preg_match($pattern, $subject)) {
                                    // if($dataDCU->tanggal == '^\d{4}-\d{2}-'.$day.'$') {
                                        // print_r($day.' : '.$dataDCU->status_dcu.'<br>');
                                        if($dataDCU->status_dcu != 'UNFIT') {
                                            if(($timesheets->where('dcurecap_id', $dataDCU->id)->first()) != null) {
                                                echo '✅';
                                            } else {
                                                echo '-';
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        // echo $dataDCU->status_dcu;
                                        // $day++;
                                        $isBreak = true;
                                    }
                                }
                            }
                            
                            // print_r($day. ' : '.'<br>');
                            if($isBreak == false) {
                                echo '-';
                            }
                            $isBreak = false;
                            
                            // '</td>';
                            echo '</td>';
                        }
                    @endphp
                
            {{-- @endforeach --}}
            </tr>
        @endforeach


    </table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c7b0ba9c3.js" crossorigin="anonymous"></script>
    
</body>
</html>