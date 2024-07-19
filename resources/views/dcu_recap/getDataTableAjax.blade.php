{{-- @forelse ($dataManpower as $data)
    @forelse ($data->dcurecap as $dataDCU) 

        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td class="text-center">{{ $dataDCU->tanggal }}</td>
            <td class="text-center">27501</td>
            <td class="text-start">{{ $data->jabatan }}</td>
            <td class="text-start">{{ $data->nama_pekerja }}</td>
            <td class="text-center fw-bolder">{{ $dataDCU->status_dcu }}</td>
            <td class="text-center ">
                @if (empty($dataDCU->suhu_badan))
                    Normal
                @else
                    <b>{{ $dataDCU->suhu_badan }}<span>&deg;C</span></b>
                @endif
            </td>
            <td class="text-center ">
                @if (empty($dataDCU->kadar_oksigen))
                    Normal
                @else
                    <b>{{ $dataDCU->kadar_oksigen }} <span>%</span></b>
                @endif
            </td>
            <td class="text-center ">
                @if (empty($dataDCU->detak_jantung))
                    Normal
                @else
                    <b>{{ $dataDCU->detak_jantung }} <span>bpm</span></b>
                @endif
            </td>
            <td class="text-center ">
                @if (empty($dataDCU->tekanan_darah))
                    Normal
                @else
                    <b>{{ $dataDCU->tekanan_darah }} <span>mmHg</span></b>
                @endif
            </td>
            
        </tr>
    @empty

    @endforelse

@empty --}}

<h1>Ini data dari get data table ajax</h1>