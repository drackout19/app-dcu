<?php

namespace App\Http\Controllers;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;


use App\Models\Manpower;
use App\Models\Salary;
use App\Models\UpdateProfilePending;

class UpdateProfilePendingController extends Controller
{

    public function index()
    {
        $dataManpowerAfter = UpdateProfilePending::all()-;
        // $dataUpdatePending = UpdateProfilePending::where('manpower_id', $id)->orderBy('id', 'desc')->first();
        // $dataUpdatePending = UpdateProfilePending::all()->with('');
        // $updatePending = $dataUpdatePending->status_konfirmasi;

        return view('konfirmasi_perubahan_data.index', ["manpowers" => $dataManpowerAfter, "updatePending" => UpdateProfilePending::all()]);
    }

    public function getViewCompareDataPersonBeforeAfter($id)
    {
        // echo $request->id;exit;
        
        $dataManpowerBefore = Manpower::where('id', $id)->first();
        $dataManpowerAfter = UpdateProfilePending::where('manpower_id', $id)->orderBy('id', 'desc')->first();
        // $dataManpowerAfter = UpdateProfilePending::where('manpower_id', $id)->first();
        // dd($dataManpowerBefore->jabatan);exit;
        // echo "yes";exit;
        return view('konfirmasi_perubahan_data.detailComparePerubahanData', ["manpowerBefore" => $dataManpowerBefore, "manpowerAfter" => $dataManpowerAfter]);
    }

    public function updateProfilePersonPending(Request $request, $id): RedirectResponse
    {
// -------------------------------------------------------------------------------------------------------
        try {
            // $this->validate($request, [
            //     'jabatan'     => 'required',
            //     'nama_pekerja'     => 'required',
            //     'tanggal_lahir'   => 'required',
            //     'alamat'   => 'required'
            //  ]);
            
            $manpowerBefore = Manpower::findOrFail($id);
            $manpower = new UpdateProfilePending;

             $manpower->fill([
                'manpower_id'     => $id,
                'jabatan'     => $request->inputJabatan,
                'nama_pekerja'     => $request->inputNamaPekerja,
                'jenis_kelamin'     => $request->inputJenisKelamin,
                'tanggal_lahir'   => $request->inputTanggalLahir,
                'alamat'   => $request->inputAlamat,
                'no_KTP'   => $request->inputNoktp,
                'umur'   => $request->inputUmur,
                // 'lokasi_kerja'   => $request->inputLokasiKerja,
                'keterangan'   => $request->inputKeterangan,
            ]);

            // if (!empty($request->inputNoRekening)) {
            //     $manpower->fill([
            //         'nama_bank'   => $request->inputNamaBank,
            //         'no_rekening'   => $request->inputNoRekening,
            //     ]);
            // } else {
            //     $manpower->fill([
            //         'nama_bank'   => $manpowerBefore->nama_bank,
            //         'no_rekening'   => $manpowerBefore->no_rekening,
            //     ]);
            // }

            if ($request->hasFile('inputFotoDiri')) {
                $inputFotoDiri = $request->file('inputFotoDiri');
                $inputFotoDiri->storeAs('public/manpowers/fotodiri/', $inputFotoDiri->hashName());

                //delete old image
                Storage::delete('public/manpowers/fotodiri/'.$manpower->foto_diri);

                $manpower->fill([
                    'foto_diri'   => $request->inputFotoDiri->hashName()
                ]);
            } else {
                $manpower->fill([
                    'foto_diri'   => $manpowerBefore->foto_diri
                ]);
            }

            if ($request->hasFile('inputFotoktp')) {
                $inputFotoktp = $request->file('inputFotoktp');
                $inputFotoktp->storeAs('public/manpowers/fotoktp/', $inputFotoktp->hashName());

                //delete old image
                Storage::delete('public/manpowers/fotoktp/'.$manpower->foto_KTP);

                $manpower->fill([
                    'foto_KTP'   => $request->inputFotoktp->hashName()
                ]);
            } else {
                $manpower->fill([
                    'foto_KTP'   => $manpowerBefore->foto_KTP
                ]);
            }

            if ($request->hasFile('inputFileMCU')) {
                $inputFileMCU = $request->file('inputFileMCU');
                $inputFileMCU->storeAs('public/manpowers/suratmcu/', $inputFileMCU->hashName());

                //delete old image
                Storage::delete('public/manpowers/suratmcu/'.$manpower->mcu);

                $manpower->fill([
                    'mcu'   => $request->inputFileMCU->hashName()
                ]);
            } else {
                $manpower->fill([
                    'mcu'   => $manpowerBefore->mcu
                ]);
            }

            if ($request->hasFile('inputKartuInduction')) {
                $inputKartuInduction = $request->file('inputKartuInduction');
                $inputKartuInduction->storeAs('public/manpowers/foto_kartu_induction/', $inputKartuInduction->hashName());

                //delete old image
                Storage::delete('public/manpowers/foto_kartu_induction/'.$manpower->kartu_induction);

                $manpower->fill([
                    'kartu_induction'   => $request->inputKartuInduction->hashName()
                ]);
            } else {
                $manpower->fill([
                    'kartu_induction'   => $manpowerBefore->kartu_induction
                ]);
            }

            if ($request->hasFile('inputKartuBadge')) {
                $inputKartuBadge = $request->file('inputKartuBadge');
                $inputKartuBadge->storeAs('public/manpowers/foto_kartu_badge/', $inputKartuBadge->hashName());

                //delete old image
                Storage::delete('public/manpowers/foto_kartu_badge/'.$manpower->kartu_badge);

                $manpower->fill([
                    'kartu_badge'   => $request->inputKartuBadge->hashName()
                ]);
            } else {
                $manpower->fill([
                    'kartu_badge'   => $manpowerBefore->kartu_badge
                ]);
            }

            if ($request->hasFile('inputFileSKCK')) {
                $inputFileSKCK = $request->file('inputFileSKCK');
                $inputFileSKCK->storeAs('public/manpowers/suratskck/', $inputFileSKCK->hashName());

                //delete old image
                Storage::delete('public/manpowers/suratskck/'.$manpower->skck);

                $manpower->fill([
                    'skck'   => $request->inputFileSKCK->hashName()
                ]);
            } else {
                $manpower->fill([
                    'skck'   => $manpowerBefore->skck
                ]);
            }

            if ($request->hasFile('inputFileNPWP')) {
                $inputFileNPWP = $request->file('inputFileNPWP');
                $inputFileNPWP->storeAs('public/manpowers/kartunpwp/', $inputFileNPWP->hashName());

                //delete old image
                Storage::delete('public/manpowers/kartunpwp/'.$manpower->npwp);

                $manpower->fill([
                    'npwp'   => $request->inputFileNPWP->hashName()
                ]);
            } else {
                $manpower->fill([
                    'npwp'   => $manpowerBefore->npwp
                ]);
            }

            if ($request->hasFile('inputFileCV')) {
                $inputFileCV = $request->file('inputFileCV');
                $inputFileCV->storeAs('public/manpowers/cv/', $inputFileCV->hashName());

                //delete old image
                Storage::delete('public/manpowers/cv/'.$manpower->cv);

                $manpower->fill([
                    'cv'   => $request->inputFileCV->hashName()
                ]);
            } else {
                $manpower->fill([
                    'cv'   => $manpowerBefore->cv
                ]);
            }

            if ($request->hasFile('inputFileSertifikat')) {
                $inputFileSertifikat = $request->file('inputFileSertifikat');
                $inputFileSertifikat->storeAs('public/manpowers/sertifikat/', $inputFileSertifikat->hashName());

                //delete old image
                Storage::delete('public/manpowers/sertifikat/'.$manpower->sertifikat);

                $manpower->fill([
                    'sertifikat'   => $request->inputFileSertifikat->hashName()
                ]);
            } else {
                $manpower->fill([
                    'sertifikat'   => $manpowerBefore->sertifikat
                ]);
            }

            if ($request->hasFile('inputFilePaklaring')) {
                $inputFilePaklaring = $request->file('inputFilePaklaring');
                $inputFilePaklaring->storeAs('public/manpowers/paklaring/', $inputFilePaklaring->hashName());

                //delete old image
                Storage::delete('public/manpowers/paklaring/'.$manpower->paklaring);

                $manpower->fill([
                    'paklaring'   => $request->inputFilePaklaring->hashName()
                ]);
            } else {
                $manpower->fill([
                    'paklaring'   => $manpowerBefore->paklaring
                ]);
            }

            if ($request->hasFile('inputFileSuratVaksin')) {
                $inputFileSuratVaksin = $request->file('inputFileSuratVaksin');
                $inputFileSuratVaksin->storeAs('public/manpowers/suratvaksin/', $inputFileSuratVaksin->hashName());

                //delete old image
                Storage::delete('public/manpowers/suratvaksin/'.$manpower->suratvaksin);

                $manpower->fill([
                    'surat_vaksin'   => $request->inputFileSuratVaksin->hashName()
                ]);
            } else {
                $manpower->fill([
                    'surat_vaksin'   => $manpowerBefore->surat_vaksin
                ]);
            }


            $manpower->save();

            $salary = Salary::where('manpower_id', $id)->first();

            if (!empty($request->inputNoRekening)) {
                $salary->fill([
                    'nama_bank'   => $request->inputNamaBank,
                    'no_rekening'   => $request->inputNoRekening,
                ]);

                $salary->update();
            }
           
    
            //redirect to index
            return redirect()->route('dataDiri', ["id" =>  $id])->with(['warning' => 'Menunggu Konfirmasi Admin Pada Data Yang Anda Ubah!']);

        } catch (\Throwable $th) {
            // echo "data gagal ditambahkan";
            return redirect()->route('dataDiri', ["id" =>  $id])->with(['error' => 'Data gagal Diubah!']);
        }
    }

    public function approveUpdatePerubahanData($id): RedirectResponse
    {
        $dataManpowerBefore = Manpower::where('id', $id)->first();
        $dataManpowerAfter = UpdateProfilePending::where('manpower_id', $id)->orderBy('id', 'desc')->first();

        try {
            $dataManpowerBefore->update([
                "jabatan" => $dataManpowerAfter->jabatan,
                "nama_pekerja" => $dataManpowerAfter->nama_pekerja,
                "tanggal_lahir" => $dataManpowerAfter->tanggal_lahir,
                "alamat" => $dataManpowerAfter->alamat,
                "no_KTP" => $dataManpowerAfter->no_KTP,
                "foto_KTP" => $dataManpowerAfter->foto_KTP,
                "foto_diri" => $dataManpowerAfter->foto_diri,
                "jenis_kelamin" => $dataManpowerAfter->jenis_kelamin,
                "umur" => $dataManpowerAfter->umur,
                "mcu" => $dataManpowerAfter->mcu,
                "kartu_induction" => $dataManpowerAfter->kartu_induction,
                "no_kartu_badge" => $dataManpowerAfter->no_kartu_badge,
                "kartu_badge" => $dataManpowerAfter->kartu_badge,
                "keterangan" => $dataManpowerAfter->keterangan,
                "skck" => $dataManpowerAfter->skck,
                "npwp" => $dataManpowerAfter->npwp,
                "cv" => $dataManpowerAfter->cv,
                "sertifikat" => $dataManpowerAfter->sertifikat,
                "paklaring" => $dataManpowerAfter->paklaring,
                "surat_vaksin" => $dataManpowerAfter->surat_vaksin,
            ]);

            $dataManpowerAfter = UpdateProfilePending::where('manpower_id', $id);
            $dataManpowerAfter->delete();

            
            return redirect()->route('konfirmasiPerubahanData')->with(['success' => 'Approve Berhasil!']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('konfirmasiPerubahanData')->with(['error' => 'Approve Gagal!']);
        }
    }
}
