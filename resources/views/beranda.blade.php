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


@endsection

@section('konten')
    {{-- content body --}}
    

      <div class="rounded bg-white p-2">
          <h5>Dashboard</h5>
      </div>

      <div class="rounded bg-white mt-5 p-3" style="height: 70vh; overflow-x: scroll">
      {{-- title --}}
      <h4 class="fw-bolder">Absensi Manpower Projek Turn Around Reaktor Balongan</h4>
      <br>
      {{-- tabel --}}
      <table id="myTable" class="display text-center">
          <thead>
              <tr>
                  <th class="text-center">No</th>
                  <th class="text-center" style="width: 150px">Tanggal</th>
                  <th class="text-center">Id Badge</th>
                  <th class="text-center">Jabatan</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Status DCU</th>
                  <th class="text-center">Absen Masuk</th>
                  <th class="text-center">Absen Lembur</th>
                  <th class="text-center">Absen Pulang</th>
                  <th class="text-center">Total Waktu Lembur</th>
                  <th class="text-center" style="width: 150px">Opsi</th>
              </tr>
          </thead>
          <tbody >
              <tr>
                  <td class="text-center">1</td>
                  <td class="text-center">19-06-2024</td>
                  <td class="text-center">27501</td>
                  <td class="text-start">Supervisor</td>
                  <td class="text-start">Micu Turismo</td>
                  <td class="text-center">
                    {{-- <div id="container-form-select-dcu">
                        <select class="form-select" aria-label="Default select example" id="form-select-dcu">
                            <option value="default" selected>Open this select menu</option>
                            <option value="FIT">FIT</option>
                            <option value="Fith With Note" aria-label="">FIT With Note</option>
                        </select>
                    </div> --}}
                    <span id="btn-dcu">
                        <span class="btn btn-sm btn-success" onclick="activeFloatFormDcu()">DCU</span>
                    </span>
                    <span class="material-symbols-outlined m-2" style="display: none; cursor: default;" id="icon-showing-note-dcu">
                        description
                    </span>
                    {{-- the function of this div to be float form when button DCU has clicked --}}
                    <div style="display: none" id="container-form-dcu">
                        <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                            <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                <div class="card p-2" style="height: 80vh ;overflow-y: scroll">
                                    {{-- <h4>Ceklis Sesuai Kesehatan Pekerja</h4>
                                    <br>
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioDCU" id="radioFIT" value="FIT" onclick="handleRadioDCU('FIT')">
                                    <label class="form-check-label">
                                        FIT
                                    </label>
                                  </div>
                                  <div class="form-check mt-3">
                                    <input class="form-check-input" type="radio" name="radioDCU" id="radioFWN" value="FWN" onclick="handleRadioDCU('FWN')">
                                    <label class="form-check-label">
                                      FIT WITH NOTE
                                    </label> --}}
                                    {{-- textarea input untuk menuliskan note warning nya --}}
                                    {{-- <div class="rounded mt-1" style="width: max-content; display: none" id="container-input-note-dcu">
                                        <textarea class="rounded" name="" id="textarea-float-note" cols="20" rows="5" placeholder="Tuliskan catatan untuk pekerja disini..." ></textarea>
                                    </div> --}}
                                  {{-- </div> 
                                  <div class="form-check mt-3">
                                    <input class="form-check-input" type="radio" name="radioDCU" id="radioUNFIT" value="UNFIT" onclick="handleRadioDCU('UNFIT')">
                                    <label class="form-check-label">
                                      UNFIT
                                    </label>
                                    </div>  --}}

                                    {{-- coba --}}
                                    <div class="p-2 rounded mx-auto mt-2" style="background: rgb(241, 241, 241); max-width: max-content;" id="container-radio-form-dcu">
                                        <h5>Ceklis Sesuai Kesehatan Pekerja</h5>

                                        {{-- suhu badan --}}
                                        <div class="mt-3" id="form-suhu-badan">
                                            <h6>Suhu Badan</h6>
                                            <div class="form-check ms-2">
                                                <input class="form-check-input" type="radio" name="radioSuhuBadan" value="normal" checked onclick="handleRadioDCU('radio-suhu-badan-normal')">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                Normal
                                                </label>
                                            </div>
                                            <div class="form-check ms-2">
                                                <input class="form-check-input" type="radio" name="radioSuhuBadan" value="tdk-normal"  onclick="handleRadioDCU('radio-suhu-badan-tdk-normal')">
                                                <label class="form-check-label">
                                                Tidak Normal
                                                </label>
                                                {{--input untuk menuliskan suhu badannya --}}
                                                <div class="rounded mt-1" style="width: max-content; display: none" id="container-input-suhu-badan">
                                                    <input type="number" step="0.1" min="0" placeholder="Suhu badan">
                                                    <span class="unit">&deg;C</span>
                                                    {{-- <textarea class="rounded" name="" id="textarea-float-note" cols="20" rows="5" placeholder="Isikan suhu badan pekerja" ></textarea> --}}
                                                </div>
                                            </div>
                                        </div>

                                        {{-- kadar oksigen darah --}}
                                        <div class="mt-3" id="form-kadar-oksigen">
                                            <h6>Kadar Oksigen Darah</h6>
                                            <div class="form-check ms-2">
                                                <input class="form-check-input" type="radio" name="radioKadarOksigenDarah" value="normal"  checked onclick="handleRadioDCU('radio-oksigen-darah-normal')">
                                                <label class="form-check-label">
                                                Normal
                                                </label>
                                            </div>
                                            <div class="form-check ms-2">
                                                <input class="form-check-input" type="radio" name="radioKadarOksigenDarah" value="tdk-normal"  onclick="handleRadioDCU('radio-oksigen-darah-tdk-normal')">
                                                <label class="form-check-label">
                                                Tidak Normal
                                                </label>
                                                {{--input untuk menuliskan kadar oksigen darah --}}
                                                <div class="rounded mt-1" style="width: max-content; display: none" id="container-input-oksigen-darah">
                                                    <input type="number" step="0.1" min="0" placeholder="kadar oksigen">
                                                    <span class="unit">%</span>
                                                    {{-- <textarea class="rounded" name="" id="textarea-float-note" cols="20" rows="5" placeholder="Isikan suhu badan pekerja" ></textarea> --}}
                                                </div>
                                            </div>
                                        </div>

                                        {{-- detak jantung --}}
                                        <div class="mt-3" id="form-detak-jantung">
                                            <h6>Detak Jantung</h6>
                                            <div class="form-check ms-2">
                                                <input class="form-check-input" type="radio" name="radioDetakJantung" value="normal"  checked onclick="handleRadioDCU('radio-detak-jantung-normal')">
                                                <label class="form-check-label">
                                                Normal
                                                </label>
                                            </div>
                                            <div class="form-check ms-2">
                                                <input class="form-check-input" type="radio" name="radioDetakJantung" value="tdk-normal"  onclick="handleRadioDCU('radio-detak-jantung-tdk-normal')">
                                                <label class="form-check-label">
                                                Tidak Normal
                                                </label>
                                                {{--input untuk menuliskan detak jantungnya --}}
                                                <div class="rounded mt-1" style="width: max-content; display: none" id="container-input-detak-jantung">
                                                    <input type="number" step="0.1" min="0" placeholder="Detak jantung">
                                                    <span class="unit">bpm</span>
                                                    {{-- <textarea class="rounded" name="" id="textarea-float-note" cols="20" rows="5" placeholder="Isikan suhu badan pekerja" ></textarea> --}}
                                                </div>
                                            </div>
                                        </div>

                                        {{-- tekanan darah --}}
                                        <div class="mt-3" id="form-tekanan-darah">
                                            <h6>Tekanan Darah</h6>
                                            <div class="form-check ms-2">
                                                <input class="form-check-input" type="radio" name="radioTekananDarah" value="normal"  checked onclick="handleRadioDCU('radio-tekanan-darah-normal')">
                                                <label class="form-check-label">
                                                Normal
                                                </label>
                                            </div>
                                            <div class="form-check ms-2">
                                                <input class="form-check-input" type="radio" name="radioTekananDarah" value="tdk-normal"  onclick="handleRadioDCU('radio-tekanan-darah-tdk-normal')">
                                                <label class="form-check-label">
                                                Tidak Normal
                                                </label>
                                                {{--input untuk menuliskan tekanan darahnya --}}
                                                <div class="rounded mt-1" style="width: max-content; display: none" id="container-input-tekanan-darah">
                                                    <input type="number" min="0" placeholder="Sistolik" style="max-width: 100px">
                                                    <span class="unit">/</span>
                                                    <input type="number" min="0" placeholder="Diastolik" style="max-width: 100px">
                                                    <span class="unit">mmHg</span>
                                                    {{-- <textarea class="rounded" name="" id="textarea-float-note" cols="20" rows="5" placeholder="Isikan suhu badan pekerja" ></textarea> --}}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mx-auto" style="width: max-content">
                                                <button class="btn btn-sm btn-success" onclick="kirim_form_dcu()">Kirim</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- button cancel popup dcu --}}
                                <span class="material-symbols-outlined fw-bold" style="position: absolute; left: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_form_dcu()">
                                    cancel
                                </span>
                            </div>
                        </div>
                    </div>

                        {{-- The function of this float is showing input form when option selected is value 2 or Fit With Note --}}
                        <div class="p-2 rounded" style="background: grey ;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%); width: max-content; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); display: none" id="float-note-dcu">
                            <textarea class="rounded" name="" id="textarea-float-note" cols="20" rows="5" placeholder="Tuliskan catatan disini..." ></textarea>
                            <div class="ms-auto" style="width: max-content">
                                <button class="btn btn-sm btn-secondary" id="btn-cancel-float-note">Cancel</button>
                                <button class="btn btn-sm btn-primary" id="btn-yes-float-note">Okee!</button>
                            </div>
                            <span class="text-white" id="alert-for-float-note-dcu"></span>
                        </div>

                        {{-- The function of this float is showing sticky note of dcu --}}
                        <div class="float-sticky-note"  style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%); width: max-content; display: none" id="float-sticky-note">
                            <ul>
                                <li>
                                <a href="#" contenteditable>
                                    <h6>Warning Note!</h6>
                                    <hr>
                                    <p id="konten-sticky-note"></p>
                                </a>
                                
                                </li>
                                <span class="material-symbols-outlined fw-bold text-danger" style="position: absolute; right: 3px; top: -12px; font-size: 30px; cursor: default; z-index: 6;" id="click_close_sticky_note">
                                    cancel
                                </span>
                            </ul>
                            
                        </div>

                  </td>
                    {{-- btn masuk kerja  --}}
                    <td class="text-center">
                        <div id="jamMasuk">
                            <button class="btn btn-secondary p-1 pt-0" id="btn-masuk-kerja" disabled>Masuk</button>
                        </div>
                        <span class="material-symbols-outlined m-2" style="display: none; cursor: default;" id="icon-showing-note-masuk-kerja">
                            description
                        </span>
                        {{-- The function of this float is showing input form when option selected is value 2 or Fit With Note --}}
                        <div class="p-2 rounded" style="background: grey ;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%); width: max-content; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); display: none" id="float-note-masuk-kerja">
                            <textarea class="rounded" name="" id="textarea-float-note-masuk-kerja" cols="20" rows="5" placeholder="*opsional, Ketikkan keterangan disini..." ></textarea>
                            <div class="ms-auto" style="width: max-content">
                                <button class="btn btn-sm btn-secondary" id="btn-cancel-float-note-masuk-kerja">Cancel</button>
                                <button class="btn btn-sm btn-primary" id="btn-yes-float-note-masuk-kerja">Masuk</button>
                            </div>
                        </div>
                        {{-- The function of this float is showing sticky note of masuk kerja --}}
                        <div class="float-sticky-note"  style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%); width: max-content; display: none" id="float-sticky-note-masuk-kerja">
                            <ul>
                                <li>
                                <a href="#" contenteditable>
                                    <h6>Keterangan Absen Masuk</h6>
                                    <hr>
                                    <p id="konten-sticky-note-masuk-kerja"></p>
                                </a>
                                
                                </li>
                                <span class="material-symbols-outlined fw-bold text-danger" style="position: absolute; right: 3px; top: -12px; font-size: 30px; cursor: default; z-index: 6;" id="click_close_sticky_note_masuk_kerja">
                                    cancel
                                </span>
                            </ul>
                            
                        </div>
                    </td>
                    {{-- btn lembur kerja--}}
                    <td class="text-center" >
                        <div id="jamLembur">
                            <button class="btn btn-secondary p-1 pt-0" id="btn-lembur-kerja" disabled>Lembur</button>
                        </div>
                        <span class="material-symbols-outlined m-2" style="display: none; cursor: default;" id="icon-showing-note-lembur-kerja">
                            description
                        </span>
                        {{-- The function of this float is showing input form when option selected is value 2 or Fit With Note --}}
                        <div class="p-2 rounded" style="background: grey;position: absolute; top: 50%;left: 60%;transform: translate(-50%, -50%); width: max-content; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); display: none" id="float-note-lembur-kerja">
                            <textarea class="rounded" name="" id="textarea-float-note-lembur-kerja" cols="20" rows="5" placeholder="*opsional, Ketikkan keterangan disini..." ></textarea>
                            <div class="ms-auto" style="width: max-content">
                                <button class="btn btn-sm btn-secondary" id="btn-cancel-float-note-lembur-kerja">Cancel</button>
                                <button class="btn btn-sm btn-primary" id="btn-yes-float-note-lembur-kerja">Masuk</button>
                            </div>
                        </div>
                        {{-- The function of this float is showing sticky note of masuk kerja --}}
                        <div class="float-sticky-note"  style="position: absolute;top: 50%;left: 60%;transform: translate(-50%, -50%); width: max-content; display: none" id="float-sticky-note-lembur-kerja">
                            <ul>
                                <li>
                                <a href="#" contenteditable>
                                    <h6>Keterangan Masuk Lembur</h6>
                                    <hr>
                                    <p id="konten-sticky-note-lembur-kerja"></p>
                                </a>
                                
                                </li>
                                <span class="material-symbols-outlined fw-bold text-danger" style="position: absolute; right: 3px; top: -12px; font-size: 30px; cursor: default; z-index: 6;" id="click_close_sticky_note_lembur_kerja">
                                    cancel
                                </span>
                            </ul>
                            
                        </div>
                    </td>
                  <td class="text-center">
                    <div id="jamPulang">
                        <button class="btn btn-secondary p-1 pt-0" id="btn-pulang-kerja" disabled>Pulang</button>
                    </div>
                    <span class="material-symbols-outlined m-2" style="display: none; cursor: default;" id="icon-showing-note-pulang-kerja">
                        description
                    </span>
                    {{-- The function of this float is showing input form when option selected is value 2 or Fit With Note --}}
                    <div class="p-2 rounded" style="background: grey;position: absolute; top: 50%;left: 75%;transform: translate(-50%, -50%); width: max-content; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); display: none" id="float-note-pulang-kerja">
                        <textarea class="rounded" name="" id="textarea-float-note-pulang-kerja" cols="20" rows="5" placeholder="*opsional, Ketikkan keterangan disini..." ></textarea>
                        <div class="ms-auto" style="width: max-content">
                            <button class="btn btn-sm btn-secondary" id="btn-cancel-float-note-pulang-kerja">Cancel</button>
                            <button class="btn btn-sm btn-primary" id="btn-yes-float-note-pulang-kerja">Masuk</button>
                        </div>
                    </div>
                    {{-- The function of this float is showing sticky note of masuk kerja --}}
                    <div class="float-sticky-note"  style="position: absolute;top: 50%;left: 75%;transform: translate(-50%, -50%); width: max-content; display: none" id="float-sticky-note-pulang-kerja">
                        <ul>
                            <li>
                            <a href="#" contenteditable>
                                <h6>Keterangan Pulang Kerja</h6>
                                <hr>
                                <p id="konten-sticky-note-pulang-kerja"></p>
                            </a>
                            
                            </li>
                            <span class="material-symbols-outlined fw-bold text-danger" style="position: absolute; right: 3px; top: -12px; font-size: 30px; cursor: default; z-index: 6;" id="click_close_sticky_note_pulang_kerja">
                                cancel
                            </span>
                        </ul>
                        
                    </div>
                  </td>
                  <td class="text-center" id="totalWaktuLembur">-</td>
                  <td class="text-center" style="cursor: default"><span class="text-danger">Hapus</span> | <span class="text-warning">Edit</span></td>
              </tr>
              <tr>
                  <td class="text-center">2</td>
                  <td class="text-center">19-06-2024</td>
                  <td class="text-center">27501</td>
                  <td class="text-start">Projek Koordinator</td>
                  <td class="text-start">Kicu Freeze</td>
                  <td class="text-center">FIT</td>
                  <td class="text-center"><span class="btn btn-success p-1 pt-0">Masuk</span></td>
                  <td class="text-center"><span class="btn btn-secondary p-1 pt-0" disabled>Lembur</span></td>
                  <td class="text-center"><span class="btn btn-secondary p-1 pt-0" disabled>Pulang</span></td>
                  <td class="text-center">-</td>
                  <td class="text-center" style="cursor: default"><span class="text-danger">Hapus</span> | <span class="text-warning">Edit</span></td>
              </tr>
          </tbody>
      </table>


      </div>

@endsection

@section('script')

<script>
    // ---------------------------------------------------------------------------------------------
    // $("#form-select-dcu").change(function(e){
    //     let selectedIndex = $(this).prop("selectedIndex");
    //     if(selectedIndex !== 0) {
    //         if(selectedIndex === 2) {
    //             $("#float-note-dcu").fadeIn(500);
    //             $("#icon-showing-note-dcu").show();
    //         } else {
    //             $("#icon-showing-note-dcu").hide();
    //         }

    //         $("#btn-masuk-kerja").removeAttr("disabled");
    //         $("#btn-masuk-kerja").removeClass("btn-secondary");
    //         $("#btn-masuk-kerja").addClass("btn-success");

    //     } else if(selectedIndex === 0) {
    //         $("#btn-masuk-kerja").attr("disabled", 'true');
    //         $("#btn-masuk-kerja").removeClass("btn-success");
    //         $("#btn-masuk-kerja").addClass("btn-secondary");
    //     }

    // });

    // $("#btn-yes-float-note").click(function(){
    //     let valueTextareaFloatNote = $("#textarea-float-note").val();
    //     if(valueTextareaFloatNote != "") {
    //         $("#form-select-dcu option:selected").attr("aria-label", valueTextareaFloatNote);
    //         $("#float-note-dcu").fadeOut(300);
    //     } else {
    //         $("#alert-for-float-note-dcu").html(`<i>${'*Keterangan wajib diisi!'}</i>`);
    //         $("#alert-for-float-note-dcu").fadeIn(500);
    //         setTimeout(function() {
    //             $("#alert-for-float-note-dcu").fadeOut(1000);
    //         }, 2000);
    //     }
        
    //     // alert($("#form-select-dcu option:selected").attr("aria-label"));
    // });

    // $("#btn-cancel-float-note").click(function(){
    //     let valueAriaLabel = $("#form-select-dcu option:selected").attr("aria-label");
    //     if(valueAriaLabel == "" || valueAriaLabel == undefined) {
    //         $("#btn-masuk-kerja").attr("disabled", 'true');
    //         $("#btn-masuk-kerja").removeClass("btn-success");
    //         $("#btn-masuk-kerja").addClass("btn-secondary");
    //         $("#form-select-dcu").prop('selectedIndex', 0);
    //         $("#icon-showing-note-dcu").hide();
    //     }
    //     // alert(valueTextareaFloatNote);
    //     $("#float-note-dcu").fadeOut(300);
    //     // alert($("#form-select-dcu option:selected").attr("aria-label"));
    // });

    // $("#icon-showing-note-dcu").click(function(){
    //     let valueAriaLabel = $("#form-select-dcu option:selected").attr("aria-label");
    //     $("#konten-sticky-note").text(valueAriaLabel);
    //     $("#float-sticky-note").fadeIn(300);
    // });
    // $("#click_close_sticky_note").click(function(){
    //     $("#float-sticky-note").fadeOut(300);
    // });
    // ------------------------------------------------------------------------------------------

    // handle form float DCU
        function activeFloatFormDcu() {
            let kontenFromFormDcu =  $("#container-form-dcu").html();
            $("#floating-form-dcu").html(kontenFromFormDcu);
            $("#floating-form-dcu").fadeIn(500);
        }

        function click_close_floating_form_dcu() {
            $("#floating-form-dcu").fadeOut(300);
        }

        // Function to handle the change event radio button DCU
        function handleRadioDCU(value) {
            switch (value) {
                case 'radio-suhu-badan-tdk-normal':
                    $("#container-input-suhu-badan").fadeIn(300);
                    break;
                case 'radio-oksigen-darah-tdk-normal':
                    $("#container-input-oksigen-darah").fadeIn(300);
                    break;
                case 'radio-detak-jantung-tdk-normal':
                    $("#container-input-detak-jantung").fadeIn(300);
                    break;
                case 'radio-tekanan-darah-tdk-normal':
                    $("#container-input-tekanan-darah").fadeIn(300);
                    break;

                case 'radio-suhu-badan-normal':
                    $("#container-input-suhu-badan").fadeOut(300);
                    break;
                case 'radio-oksigen-darah-normal':
                    $("#container-input-oksigen-darah").fadeOut(300);
                    break;
                case 'radio-detak-jantung-normal':
                    $("#container-input-detak-jantung").fadeOut(300);
                    break;
                case 'radio-tekanan-darah-normal':
                    $("#container-input-tekanan-darah").fadeOut(300);
                    break;
                default:
                // $("#container-input-note-dcu").fadeOut(300);
                    break;
            }
        }

        function kirim_form_dcu() {
            const radiosSuhuBadan = document.querySelectorAll('input[name="radioSuhuBadan"]');
            const radiosKadarOksigen = document.querySelectorAll('input[name="radioKadarOksigenDarah"]');
            const radiosDetakJantung = document.querySelectorAll('input[name="radioDetakJantung"]');
            const radiosTekananDarah = document.querySelectorAll('input[name="radioTekananDarah"]');

            const arrRadios = [radiosSuhuBadan, radiosKadarOksigen, radiosDetakJantung, radiosTekananDarah];

            let selectedValue = [];

            for(let i = 0; i < arrRadios.length; i++) {
                let radios = arrRadios[i];
                radios.forEach(radios => {
                if (radios.checked) {
                    selectedValue.push(radios.value);
                }
            });
            }

            if(selectedValue.includes('tdk-normal')) {
                $("#floating-form-dcu").fadeOut(300);
                $("#btn-dcu").html("<b>UNFIT</b>");
            } else {
                $("#floating-form-dcu").fadeOut(300);
                $("#btn-dcu").html("<b>FIT</b>");

                // ubah warna button masuk menjadi hijau dan dapat di klik
                $("#btn-masuk-kerja").removeAttr("disabled");
                $("#btn-masuk-kerja").removeClass("btn-secondary");
                $("#btn-masuk-kerja").addClass("btn-success");
            }
        }

    // handle action button masuk kerja
        $("#btn-masuk-kerja").click(function(){
            $("#float-note-masuk-kerja").fadeIn(500);
        });

        $("#btn-yes-float-note-masuk-kerja").click(function(){
            let jamMasuk;

            updateClock().then((result) => {
                jamMasuk = result;
                $("#jamMasuk").html(`<b>${jamMasuk}</b>`);
                $("#container-form-select-dcu").html((`<b>${$("#form-select-dcu").val()}</b>`));
                // let valueTextareaFloatNote = $("#textarea-float-note").val();
                // $("#form-select-dcu option:selected").attr("aria-label", valueTextareaFloatNote);
                $("#float-note-masuk-kerja").fadeOut(300);
                // Check the time every second
                setInterval(checkTime, 1000);
                // alert($("#form-select-dcu option:selected").attr("aria-label"));
                if($("#textarea-float-note-masuk-kerja").val() == "") {
                    $("#icon-showing-note-masuk-kerja").hide();
                } else {
                    $("#icon-showing-note-masuk-kerja").show();
                }
            });
        });

        $("#btn-cancel-float-note-masuk-kerja").click(function(){
            $("#float-note-masuk-kerja").fadeOut(300);
        });

        $("#icon-showing-note-masuk-kerja").click(function(){
            let valueTextAreaMasukKerja = $("#textarea-float-note-masuk-kerja").val();
            $("#konten-sticky-note-masuk-kerja").text(valueTextAreaMasukKerja);
            $("#float-sticky-note-masuk-kerja").fadeIn(300);
        });

        $("#click_close_sticky_note_masuk_kerja").click(function(){
            $("#float-sticky-note-masuk-kerja").fadeOut(300);
        });

    // handle action button masuk lembur
        $("#btn-lembur-kerja").click(function(){
            $("#float-note-lembur-kerja").fadeIn(500);
        });

        $("#btn-yes-float-note-lembur-kerja").click(function(){
            let jamLembur;
            updateClock().then((result) => {
                jamLembur = result;
                $("#jamLembur").html(`<b>${jamLembur}</b>`);
                $("#jamLembur").attr("aria-label", "ambilLembur");
                // $("#container-form-select-dcu").html((`<b>${$("#form-select-dcu").val()}</b>`));
                // let valueTextareaFloatNote = $("#textarea-float-note").val();
                // $("#form-select-dcu option:selected").attr("aria-label", valueTextareaFloatNote);
                $("#float-note-lembur-kerja").fadeOut(300);
                // alert($("#form-select-dcu option:selected").attr("aria-label"));

                $("#btn-pulang-kerja").attr("disabled", true);
                $("#btn-pulang-kerja").removeClass("btn-success");
                $("#btn-pulang-kerja").addClass("btn-secondary");

                // to handle show and hide icon showing floating sticky note
                if($("#textarea-float-note-lembur-kerja").val() == "") {
                    $("#icon-showing-note-lembur-kerja").hide();
                } else {
                    $("#icon-showing-note-lembur-kerja").show();
                }
            });;
            
            
        })

        $("#btn-cancel-float-note-lembur-kerja").click(function(){
            $("#float-note-lembur-kerja").fadeOut(300);
        });

        $("#icon-showing-note-lembur-kerja").click(function(){
            let valueTextArealemburKerja = $("#textarea-float-note-lembur-kerja").val();
            $("#konten-sticky-note-lembur-kerja").text(valueTextArealemburKerja);
            $("#float-sticky-note-lembur-kerja").fadeIn(300);
        });

        $("#click_close_sticky_note_lembur_kerja").click(function(){
            $("#float-sticky-note-lembur-kerja").fadeOut(300);
        });

    // handle action button pulang kerja

        $("#btn-pulang-kerja").click(function(){
            $("#float-note-pulang-kerja").fadeIn(500);
        });

        $("#btn-yes-float-note-pulang-kerja").click(function(){
            let jamPulang;
            updateClock().then((result) => {
                jamPulang = result;
                $("#jamPulang").html(`<b>${jamPulang}</b>`);

                let getAriaLabelJamLembur = $("#jamLembur").attr("aria-label");

                if(getAriaLabelJamLembur === "ambilLembur") {
                    // Function to parse a time string in the format "HH:MM"
                    function parseTime(timeStr) {
                        let parts = timeStr.split(':');
                        let date = new Date();
                        date.setHours(parseInt(parts[0], 10));
                        date.setMinutes(parseInt(parts[1], 10));
                        date.setSeconds(0);
                        date.setMilliseconds(0);
                        return date;
                    }

                    // Function to calculate the difference between two times
                    function calculateTimeDifference(startTimeStr, endTimeStr) {
                        let startTime = parseTime(startTimeStr);
                        let endTime = parseTime(endTimeStr);

                        // Calculate the difference in milliseconds
                        let diff = endTime - startTime;

                        // If the difference is negative, it means the end time is on the next day
                        if (diff < 0) {
                            endTime.setDate(endTime.getDate() + 1);
                            diff = endTime - startTime;
                        }

                        // Convert the difference to hours, minutes, and seconds
                        let hours = Math.floor(diff / (1000 * 60 * 60));
                        let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                        let seconds = Math.floor((diff % (1000 * 60)) / 1000);

                        return {
                            hours: hours,
                            minutes: minutes,
                            seconds: seconds
                        };
                    }

                    // Example usage
                    let getJamLembur = $("#jamLembur").text();
                    let getJamPulang = $("#jamPulang").text();

                    let diff = calculateTimeDifference(getJamLembur, getJamPulang);

                    // alert(`Time difference: ${diff.hours} hours, ${diff.minutes} minutes, ${diff.seconds} seconds`);
                    $("#totalWaktuLembur").text(`${diff.hours} Jam ${diff.minutes} Menit`);
                } else {
                    $("#jamLembur").html('-');
                    $("#totalWaktuLembur").text('-');
                }
            });

            // to handle show and hide icon showing floating sticky note
            if($("#textarea-float-note-pulang-kerja").val() == "") {
                $("#icon-showing-note-pulang-kerja").hide();
            } else {
                $("#icon-showing-note-pulang-kerja").show();
            }

            $("#float-note-pulang-kerja").fadeOut(300);
        })

        $("#btn-cancel-float-note-pulang-kerja").click(function(){
            $("#float-note-pulang-kerja").fadeOut(300);
        });

        $("#icon-showing-note-pulang-kerja").click(function(){
            let valueTextAreapulangKerja = $("#textarea-float-note-pulang-kerja").val();
            $("#konten-sticky-note-pulang-kerja").text(valueTextAreapulangKerja);
            $("#float-sticky-note-pulang-kerja").fadeIn(300);
        });

        $("#click_close_sticky_note_pulang_kerja").click(function(){
            $("#float-sticky-note-pulang-kerja").fadeOut(300);
        });



    


    async function updateClock() {
        try {
            // Fetch the current time from the World Time API
            const response = await fetch('https://worldtimeapi.org/api/ip');
            const data = await response.json();

            // Extract the current datetime from the response
            const currentTime = new Date(data.datetime);
            const hours = currentTime.getHours();
            const minutes = currentTime.getMinutes();
            const seconds = currentTime.getSeconds();
            const formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;


            return formattedTime;

        } catch (error) {
            console.error('Error fetching the online time:', error);
            document.getElementById('currentTime').textContent = 'Failed to fetch current time.';

            return "<i>Error, Silahkan refresh</i>";
        }
        
    }

    async function checkTime() {
        let hours;
        let minutes;
        let seconds;
        
        try {
            // Fetch the current time from the World Time API
            let response = await fetch('https://worldtimeapi.org/api/ip');
            let data = await response.json();

            // Extract the current datetime from the response
            let currentTime = new Date(data.datetime);
            hours = currentTime.getHours();
            minutes = currentTime.getMinutes();
            seconds = currentTime.getSeconds();
            // const formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        } catch (error) {
            console.error('Error fetching the online time:', error);
            alert('Failed to fetch current time.');
        }

        // Check if the time is exactly 5:00:00 PM
        if (hours >= 17 && minutes >= 1 && seconds === 0) {
            enableBtnLemburAndBtnPulang();
        } 

        let getAriaLabelJamLembur = $("#jamLembur").attr("aria-label");

        if(getAriaLabelJamLembur === "ambilLembur") {
            // Calculate the future time (1 hour from time lembur)
            // Time string (clock only)
            const timeString = $("#jamLembur").text();
            const currentDate = new Date();

            // Extract the date components (year, month, day)
            const year = currentDate.getFullYear();
            const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Months are zero-based, so add 1
            const day = String(currentDate.getDate()).padStart(2, '0');

            // Combine the date components with the time string
            const dateTimeString = `${year}-${month}-${day}T${timeString}`;
            let date = new Date(dateTimeString);
            date = date.getTime() + 1 * 60 * 60 * 1000;
            const hoursUTC = Math.floor((date / (1000 * 60 * 60)) % 24);

            // Convert milliseconds to hours in local time
            const dateFromMilliseconds = new Date(date);
            const hoursLocal = dateFromMilliseconds.getHours();
            const minutesLocal = dateFromMilliseconds.getHours();
            const secondsLocal = dateFromMilliseconds.getHours();

            $("#btn-pulang-kerja").attr("disabled", true);
            $("#btn-pulang-kerja").removeClass("btn-success");
            $("#btn-pulang-kerja").addClass("btn-secondary");

            if (hours >= hoursLocal && minutes >= minutesLocal && seconds === secondsLocal) {
                enableBtnPulang();
            } 
            // if (true) {
            //     enableBtnPulang();
            // } 
        }
    }

    function enableBtnLemburAndBtnPulang() {
        $("#btn-lembur-kerja").removeAttr("disabled");
        $("#btn-lembur-kerja").removeClass("btn-secondary");
        $("#btn-lembur-kerja").addClass("btn-success");
        $("#btn-pulang-kerja").removeAttr("disabled");
        $("#btn-pulang-kerja").removeClass("btn-secondary");
        $("#btn-pulang-kerja").addClass("btn-success");
    }

    function enableBtnPulang() {
        // alert("boleh pualng");
        $("#btn-pulang-kerja").removeAttr("disabled");
        $("#btn-pulang-kerja").removeClass("btn-secondary");
        $("#btn-pulang-kerja").addClass("btn-success");
    }
</script>


{{-- script untuk handle sticky note jangan utak atik ga ngerti jga gw --}}
<script>
    $(document).ready(function () {
        all_notes = $("#sticky-note li a");

        all_notes.on("keyup", function () {
            note_title = $(this).find("h2").text();
            note_content = $(this).find("p").text();

            item_key = "list_" + $(this).parent().index();

            data = {
            title: note_title,
            content: note_content
            };

            window.localStorage.setItem(item_key, JSON.stringify(data));
    });

    all_notes.each(function (index) {
        data = JSON.parse(window.localStorage.getItem("list_" + index));

        if (data !== null) {
        note_title = data.title;
        note_content = data.content;

        $(this).find("h2").text(note_title);
        $(this).find("p").text(note_content);
        }
    });
});
</script>
@endsection