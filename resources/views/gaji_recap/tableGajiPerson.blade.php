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
        
        <thead> 
            <th>No</th> 
            <th>Id Badge</th> 
            <th>Jabatan</th> 
            <th>Nama</th> 
            <th>Jenis Kelamin</th> 
            <th>Gaji Pokok</th> 
            <th>Upah Harian</th> 
            <th>Upah Lembur Perjam</th>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $dataSalary->manpower->nama_kartu_badge }}</td>
                <td>{{ $dataSalary->manpower->jabatan }}</td>
                <td>{{ $dataSalary->manpower->nama_pekerja }}</td>
                <td>{{ $dataSalary->manpower->jenis_kelamin }}</td>
                <td>{{ $dataSalary->gaji_pokok }}</td>
                <td>{{ $dataSalary->gaji_harian }}</td>
                <td>{{ $dataSalary->gaji_lembur }}</td>
            </tr>
        </tbody>

    </table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1c7b0ba9c3.js" crossorigin="anonymous"></script>
    
</body>
</html>