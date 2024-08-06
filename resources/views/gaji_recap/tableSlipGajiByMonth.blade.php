
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
        {{-- link datatables --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
</head>
<body>
    
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
                                    <td class="text-center fw-bolder"><a href="" class="btn btn-sm btn-dark mt-1 mb-1" style="width: 100%" id="btnDetail{{ $manpower->id }}" onclick="btnClickDetail({{ $manpower->id }})">DETAIL</a></td>
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


<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
  </script>
</body>
</html>
