@extends('layouts.main')

@section('konten')
    {{-- content body --}}
    <div class="rounded bg-white p-2">
      <h5>Manpower</h5>
    </div>

    <div class="rounded bg-white mt-5 p-3" style="min-height: 50vh; overflow-x: scroll">
      {{-- title --}}
      <h4 class="fw-bolder">List Manpower Projek Turn Around Reaktor RU VI Balongan🚀🚀</h4>
      <br>

      {{-- button tambah manpower baru --}}
      <button class="btn btn-success fw-bolder mb-3" style="display: flex; align-items: center; justify-items: center">
        <span class="material-symbols-outlined p-0">
        add
        </span>Tambah
      </button>
      
      {{-- tabel --}}
      <table id="myTable" class="display text-center">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Nama Pekerja</th>
                <th class="text-center">Tanggal Lahir</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">No KTP</th>
                <th class="text-center">Foto KTP</th>
                <th class="text-center">MCU</th>
                <th class="text-center">Kartu Induction</th>
                <th class="text-center">Kartu Badge</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Lokasi Kerja</th>
                <th class="text-center">SKCK</th>
                <th class="text-center">NPWP</th>
                <th class="text-center">CV</th>
                <th class="text-center">Sertifikat</th>
                <th class="text-center">Paklaring</th>
                <th class="text-center">Surat Vaksin</th>
                <th class="text-center" style="width: 150px">Opsi</th>
            </tr>
        </thead>
        <tbody >
            <tr>
                <td class="text-center">1</td>
                <td class="text-start">Supervisor</td>
                <td class="text-center">Micu Turismo</td>
                <td class="text-center">19-06-2022</td>
                <td class="text-start">Indramayu, singaraja</td>
                <td class="text-start">32102020200</td>
                <td class="text-center" >
                  <img src="{{URL::asset('/manpower/foto_ktp/ktp_micu.jpg')}}" alt="ktp micu" style="max-width: 100px">
                  <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_foto_ktp" >Lihat</span>
                  {{-- float image when click --}}
                  <div id="float_foto_ktp" style="display: none">
                    <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;">
                      <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%); width: 300px">
                        <img src="{{URL::asset('/manpower/foto_ktp/ktp_micu.jpg')}}" alt="Foto KTP" style="max-width: 100%; scale: 2">
                        <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -180px; top: -130px; font-size: 50px; cursor: default" onclick="click_close_floating_documents()">
                          cancel
                          </span>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                  Sudah <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_mcu">Lihat
                   
                    <div id="float_surat_mcu" style="display: none">
                      <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                          <embed src="manpower/surat_mcu/dami-surat-hasil-mcu.pdf" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                              cancel
                              </span>
                        </div>
                      </div>
                    </div>
                </td>
                <td class="text-center">
                  <img src="{{URL::asset('/manpower/foto_kartu_induction/kartu-induction-dami1.png')}}" alt="ktp micu" style="max-width: 80px"> 
                  <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_induction">Lihat</span> 
                  {{-- float kartu induction --}}
                  <div id="float_kartu_induction" style="display: none">
                    <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                      <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <img src="{{URL::asset('/manpower/foto_kartu_induction/kartu-induction-dami1.png')}}" alt="kartu induction" style="max-width: 100%; scale: 1.5">
                        <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -80px; top: -110px; font-size: 50px; cursor: default" onclick="click_close_floating_documents()">
                          cancel
                          </span>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="text-center">
                  <b>12935</b> 
                  <img src="{{URL::asset('/manpower/foto_kartu_badge/kartu-badge-dami1.png')}}" alt="ktp micu" style="max-width: 100px"> 
                  <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_badge">Lihat</span> 

                  {{-- float kartu induction --}}
                  <div id="float_kartu_badge" style="display: none">
                    <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                      <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <img src="{{URL::asset('/manpower/foto_kartu_badge/kartu-badge-dami1.png')}}" alt="kartu badge" style="max-width: 100%; scale: 1.5">
                        <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -100px; top: -80px; font-size: 50px; cursor: default" onclick="click_close_floating_documents()">
                          cancel
                          </span>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="text-center"></td>
                <td class="text-center">RU VI Balongan</td>
                <td class="text-center">
                  Ada <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_skck">Lihat
                   
                    <div id="float_surat_skck" style="display: none">
                      <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                          <embed src="manpower/surat_skck/skck-dami1.pdf" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                              cancel
                              </span>
                        </div>
                      </div>
                    </div>
                </td>
                <td class="text-center">
                  Ada <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_kartu_npwp">Lihat
                   
                    <div id="float_kartu_npwp" style="display: none">
                      <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                          <embed src="manpower/kartu_npwp/npwp-dami1.pdf" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                              cancel
                              </span>
                        </div>
                      </div>
                    </div>  
                </td>   
                <td class="text-center">
                  Ada <span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_cv">Lihat</span>
                   
                    <div id="float_cv" style="display: none">
                      <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                          <embed src="manpower/cv/cv-dami1.pdf" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                              cancel
                              </span>
                        </div>
                      </div>
                    </div>  
                </td>   
                <td class="text-center">
                  Ada <br><span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_sertifikat">Lihat</span>
                   
                    <div id="float_sertifikat" style="display: none">
                      <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                          <embed src="manpower/sertifikat/sertifikat-welder-dami1.pdf" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                              cancel
                              </span>
                        </div>
                      </div>
                    </div>  
                </td>   
                <td class="text-center">
                  Ada <br><span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_paklaring">Lihat
                   
                    <div id="float_paklaring" style="display: none">
                      <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                          <embed src="manpower/paklaring/paklaring-dami1.pdf" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                              cancel
                              </span>
                        </div>
                      </div>
                    </div>  
                </td>
                <td class="text-center">
                  Ada <br><span class="text-primary fw-bolder" style="cursor: default" id="click_lihat_surat_vaksin">Lihat
                   
                    <div id="float_surat_vaksin" style="display: none">
                      <div style="background: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;" >
                        <div style=" position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                          <embed src="manpower/surat_vaksin/surat-vaksin-dami1.pdf" width="500" height="600"  type="application/pdf">
                            <span class="material-symbols-outlined fw-bold" style="position: absolute; right: -25px; top: -30px; font-size: 50px; cursor: default;" onclick="click_close_floating_documents()">
                              cancel
                              </span>
                        </div>
                      </div>
                    </div> 
                </td>
                <td class="text-center" style="cursor: default"><span class="text-danger fw-bolder">Hapus</span> | <span class="text-warning fw-bolder">Edit </span> | <span class="text-primary fw-bolder">Lihat </span></td>
            </tr>
        </tbody>
    </table>

    
    </div>

    
      
@endsection

@section('script')

<script>
    // $("#click_float_img_ktp").click(function(){
    //   // $("#float_img_ktp").show();
    //   $("#float_img_ktp").fadeIn(700);
    // });
    // $("#click_close_float_ktp").click(function(){
    //   // $("#float_img_ktp").hide();
    //   $("#float_img_ktp").fadeOut(700);
    // });
    $("#click_lihat_foto_ktp").click(function(){
      let clonedContent = $("#float_foto_ktp").html();
      $("#floating-documents").html(clonedContent);
      $("#floating-documents").fadeIn(500);
    });

    $("#click_lihat_surat_mcu").click(function(){
      let clonedContent = $("#float_surat_mcu").html();
      $("#floating-documents").html(clonedContent);
      $("#floating-documents").fadeIn(500);
    });
    
    $("#click_lihat_kartu_induction").click(function(){
      let clonedContent = $("#float_kartu_induction").html();
      $("#floating-documents").html(clonedContent);
      $("#floating-documents").fadeIn(500);
    });

    $("#click_lihat_kartu_badge").click(function(){
      let clonedContent = $("#float_kartu_badge").html();
      $("#floating-documents").html(clonedContent);
      $("#floating-documents").fadeIn(500);
    });

    $("#click_lihat_surat_skck").click(function(){
      let clonedContent = $("#float_surat_skck").html();
      $("#floating-documents").html(clonedContent);
      $("#floating-documents").fadeIn(500);
    });

    $("#click_lihat_kartu_npwp").click(function(){
      let clonedContent = $("#float_kartu_npwp").html();
      $("#floating-documents").html(clonedContent);
      $("#floating-documents").fadeIn(500);
    });

    $("#click_lihat_cv").click(function(){
      let clonedContent = $("#float_cv").html();
      $("#floating-documents").html(clonedContent);
      $("#floating-documents").fadeIn(500);
    });

    $("#click_lihat_sertifikat").click(function(){
      let clonedContent = $("#float_sertifikat").html();
      $("#floating-documents").html(clonedContent);
      $("#floating-documents").fadeIn(500);
    });

    $("#click_lihat_paklaring").click(function(){
      let clonedContent = $("#float_paklaring").html();
      $("#floating-documents").html(clonedContent);
      $("#floating-documents").fadeIn(500);
    });

    $("#click_lihat_surat_vaksin").click(function(){
      let clonedContent = $("#float_surat_vaksin").html();
      $("#floating-documents").html(clonedContent);
      $("#floating-documents").fadeIn(500);
    });

    function click_close_floating_documents() {
      $("#floating-documents").fadeOut(500);
    }
    
</script>
@endsection