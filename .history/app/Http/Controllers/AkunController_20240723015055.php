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

use App\Models\ConfirmSalary;

use App\Models\User;

use App\Models\Timesheet;

use App\Models\Dcurecap;

class ManpowerController extends Controller
{
     /**
     * index
     *
     * @return View
     */
    public function index() : View
    {
        //get posts
        // $data = [['title'=>'Manpower']];

        //render view with posts
        return view('manpower.index', ["manpowers" => Manpower::all()]);
    }

    /**
     * create
     *
     * @return View
     */
     
    public function create() : View
    {
        return view('manpower.addperson');
    }

     /**
     * show
     *
     * @param  mixed $id
     * @return View
     */

    public function show(string $id): View
    {
        //get post by ID
        $data = Manpower::findOrFail($id);

        //render view with post
        return view('manpower.detailperson', compact('data'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */

    public function store(Request $request): RedirectResponse
    {
        //validate form
        // dd($request->inputGaji);
        try {
            // $this->validate($request, [
            //     'jabatan'     => 'required',
            //     'nama_pekerja'     => 'required',
            //     'tanggal_lahir'   => 'required',
            //     'alamat'   => 'required'
            //  ]);
            

            $manpower = new Manpower();
            $salary = new Salary();
            $user = new User();

            //  Manpower::create([
            //     'jabatan'     => $request->inputJabatan,
            //     'nama_pekerja'     => $request->inputNamaPekerja,
            //     'tanggal_lahir'   => $request->inputTanggalLahir,
            //     'alamat'   => $request->inputAlamat,
            //     'no_KTP'   => $request->inputNoktp,
            //     'foto_KTP'   => $request->inputFotoktp->hashName(),
            //     'mcu'   => $request->inputFileMCU->hashName(),
            // ]);
             $manpower->fill([
                'jabatan'     => $request->inputJabatan,
                'nama_pekerja'     => $request->inputNamaPekerja,
                'tanggal_lahir'   => $request->inputTanggalLahir,
                'alamat'   => $request->inputAlamat,
                'jenis_kelamin'   => $request->inputJenisKelamin,
                'umur'   => $request->inputUmur,
                'status_pekerja'   => $request->inputStatusPekerja,
                // 'lokasi_kerja'   => $request->inputLokasiKerja,
            ]);

            // $inputFotoktp = $request->file('inputFotoktp');
            // $inputFileMCU = $request->file('inputFileMCU');
            // store file to directory public/manpower/....

            // $inputFotoktp->storeAs('public/manpowers/fotoktp/', $inputFotoktp->hashName());
            // $inputFileMCU->storeAs('public/manpowers/suratmcu/', $inputFileMCU->hashName());

            

            // if (!empty($request->inputNoRekening)) {
            //     $manpower->fill([
            //         'nama_bank'   => $request->inputNamaBank,
            //         'no_rekening'   => $request->inputNoRekening,
            //     ]);
            // }

            if ($request->hasFile('inputFotoktp')) {
                $inputFotoktp = $request->file('inputFotoktp');
                $inputFotoktp->storeAs('public/manpowers/fotoktp/', $inputFotoktp->hashName());

                $manpower->fill([
                    'no_KTP'   => $request->inputNoktp,
                    'foto_KTP'   => $request->inputFotoktp->hashName()
                ]);
            }

            if ($request->hasFile('inputFotoDiri')) {
                $inputFotoDiri = $request->file('inputFotoDiri');
                $inputFotoDiri->storeAs('public/manpowers/fotodiri/', $inputFotoDiri->hashName());

                $manpower->fill([
                    'foto_diri'   => $request->inputFotoDiri->hashName()
                ]);
            }

            if ($request->hasFile('inputFileMCU')) {
                $inputFileMCU = $request->file('inputFileMCU');
                $inputFileMCU->storeAs('public/manpowers/suratmcu/', $inputFileMCU->hashName());

                $manpower->fill([
                    'mcu'   => $request->inputFileMCU->hashName()
                ]);
            }
            if ($request->hasFile('inputKartuInduction')) {
                $inputKartuInduction = $request->file('inputKartuInduction');
                $inputKartuInduction->storeAs('public/manpowers/foto_kartu_induction/', $inputKartuInduction->hashName());

                $manpower->fill([
                    'kartu_induction'   => $request->inputKartuInduction->hashName()
                ]);
            }

            if ($request->hasFile('inputKartuBadge')) {
                $inputKartuBadge = $request->file('inputKartuBadge');
                $inputKartuBadge->storeAs('public/manpowers/foto_kartu_badge/', $inputKartuBadge->hashName());

                $manpower->fill([
                    'no_kartu_badge'   => $request->inputNoBadge,
                    'kartu_badge'   => $request->inputKartuBadge->hashName()
                ]);
            }

            if ($request->hasFile('inputFileSKCK')) {
                $inputFileSKCK = $request->file('inputFileSKCK');
                $inputFileSKCK->storeAs('public/manpowers/suratskck/', $inputFileSKCK->hashName());

                $manpower->fill([
                    'skck'   => $request->inputFileSKCK->hashName()
                ]);
            }

            if ($request->hasFile('inputFileNPWP')) {
                $inputFileNPWP = $request->file('inputFileNPWP');
                $inputFileNPWP->storeAs('public/manpowers/kartunpwp/', $inputFileNPWP->hashName());

                $manpower->fill([
                    'npwp'   => $request->inputFileNPWP->hashName()
                ]);
            }

            if ($request->hasFile('inputFileCV')) {
                $inputFileCV = $request->file('inputFileCV');
                $inputFileCV->storeAs('public/manpowers/cv/', $inputFileCV->hashName());

                $manpower->fill([
                    'cv'   => $request->inputFileCV->hashName()
                ]);
            }

            if ($request->hasFile('inputFileSertifikat')) {
                $inputFileSertifikat = $request->file('inputFileSertifikat');
                $inputFileSertifikat->storeAs('public/manpowers/sertifikat/', $inputFileSertifikat->hashName());

                $manpower->fill([
                    'sertifikat'   => $request->inputFileSertifikat->hashName()
                ]);
            }

            if ($request->hasFile('inputFilePaklaring')) {
                $inputFilePaklaring = $request->file('inputFilePaklaring');
                $inputFilePaklaring->storeAs('public/manpowers/paklaring/', $inputFilePaklaring->hashName());

                $manpower->fill([
                    'paklaring'   => $request->inputFilePaklaring->hashName()
                ]);
            }

            if ($request->hasFile('inputFileSuratVaksin')) {
                $inputFileSuratVaksin = $request->file('inputFileSuratVaksin');
                $inputFileSuratVaksin->storeAs('public/manpowers/suratvaksin/', $inputFileSuratVaksin->hashName());

                $manpower->fill([
                    'surat_vaksin'   => $request->inputFileSuratVaksin->hashName()
                ]);
            }

            if (!empty($request->inputKeterangan)) {
                $manpower->fill([
                    'keterangan'   => $request->inputKeterangan
                ]);
            }

            $manpower->save();

            // $getManpowerIdPerson = Manpower::where

            if (!empty($request->inputNoRekening)) {
                $salary->fill([
                    'manpower_id'   => $manpower->id,
                    'nama_bank'   => $request->inputNamaBank,
                    'no_rekening'   => $request->inputNoRekening,
                ]);
            }

            // if (!empty($request->inputGajiPokok) && $request->inputStatusPekerja == 'Tetap') {
            //     $salary->fill([
            //         'gaji_pokok'   => $request->inputGajiPokok,
            //     ]);

            //     $salary->save();

            //     $confirmSalary = new ConfirmSalary();
                
            //     $confirmSalary->fill([
            //         'salary_id' => $salary->id
            //         ]
            //     );

            //     $confirmSalary->save();
            // }

            if (!empty($request->inputGajiHarian) && !empty($request->inputGajiLembur)) {
                $salary->fill([
                    'manpower_id'   => $manpower->id,
                    'gaji_harian'   => $request->inputGajiHarian,
                    'gaji_lembur'   => $request->inputGajiLembur,
                ]);
                $salary->save();

                $confirmSalary = new ConfirmSalary();
                
                $confirmSalary->fill([
                    'salary_id' => $salary->id
                    ]
                );

                $confirmSalary->save();
            }

            // buat akun user pekerja
            $user->fill([
                'manpower_id' => $manpower->id,
                'level' => 'pekerja',
                'id_badge' => $manpower->no_kartu_badge,
                'password' => bcrypt($manpower->no_kartu_badge),
            ]);

            $user->save();

            



           
    
            //redirect to index
            return redirect()->route('manpower.index')->with(['success' => 'Data Berhasil Ditambahkan!']);

        } catch (\Throwable $th) {
            // echo "data gagal ditambahkan";
            return redirect()->route('manpower.index')->with(['error' => 'Data gagal Ditambahkan!']);
        }
        // $this->validate($request, [
        //     'jabatan'     => 'required',
        //     'nama_pekerja'     => 'required',
        //     'tanggal_lahir'   => 'required',
        //     'alamat'   => 'required'
        // ]);

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/posts', $image->hashName());

        //create post
        // Manpower::create([
        //     'jabatan'     => $request->inputJabatan,
        //     'nama_pekerja'     => $request->inputNamaPekerja,
        //     'tanggal_lahir'   => $request->inputTanggalLahir,
        //     'alamat'   => $request->inputAlamat
        // ]);

        // //redirect to index
        // return redirect()->route('manpower.index')->with(['success' => 'Data Berhasil Disimpan!']);
        // return Redirect::route('/manpower', array('nick' => $username));
    }

    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $data = Manpower::findOrFail($id);
        $dataSalary = Salary::where('manpower_id', $id)->first();
        $user = User::where('manpower_id', $id)->first();
        $timesheets = Timesheet::where('salary_id', $dataSalary->id);
        $dcu = Dcurecap::where('manpower_id', $id);

        //delete image
        // Manpower::delete('public/posts/'. $post->image);

        //delete post
        $data->delete();
        $dataSalary->delete();
        $user->delete();
        $timesheets->delete();
        $dcu->delete();

        //redirect to index
        return redirect()->route('manpower.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function edit(string $id): View
    {
        //get post by ID
        $data = Manpower::findOrFail($id);

        //render view with post
        return view('manpower.editperson', compact('data'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
// -------------------------------------------------------------------------------------------------------
        try {
            // $this->validate($request, [
            //     'jabatan'     => 'required',
            //     'nama_pekerja'     => 'required',
            //     'tanggal_lahir'   => 'required',
            //     'alamat'   => 'required'
            //  ]);
            

            $manpower = Manpower::findOrFail($id);

             $manpower->fill([
                'jabatan'     => $request->inputJabatan,
                'nama_pekerja'     => $request->inputNamaPekerja,
                'jenis_kelamin'     => $request->inputJenisKelamin,
                'tanggal_lahir'   => $request->inputTanggalLahir,
                'alamat'   => $request->inputAlamat,
                'no_KTP'   => $request->inputNoktp,
                // 'lokasi_kerja'   => $request->inputLokasiKerja,
                'keterangan'   => $request->inputKeterangan,
            ]);

            if (!empty($request->inputNoRekening)) {
                $manpower->fill([
                    'nama_bank'   => $request->inputNamaBank,
                    'no_rekening'   => $request->inputNoRekening,
                ]);
            }

            if ($request->hasFile('inputFotoDiri')) {
                $inputFotoDiri = $request->file('inputFotoDiri');
                $inputFotoDiri->storeAs('public/manpowers/fotodiri/', $inputFotoDiri->hashName());

                //delete old image
                Storage::delete('public/manpowers/fotodiri/'.$manpower->foto_diri);

                $manpower->fill([
                    'foto_diri'   => $request->inputFotoDiri->hashName()
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
            }
            if ($request->hasFile('inputFileMCU')) {
                $inputFileMCU = $request->file('inputFileMCU');
                $inputFileMCU->storeAs('public/manpowers/suratmcu/', $inputFileMCU->hashName());

                //delete old image
                Storage::delete('public/manpowers/suratmcu/'.$manpower->mcu);

                $manpower->fill([
                    'mcu'   => $request->inputFileMCU->hashName()
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
            }

            if ($request->hasFile('inputKartuBadge')) {
                $inputKartuBadge = $request->file('inputKartuBadge');
                $inputKartuBadge->storeAs('public/manpowers/foto_kartu_badge/', $inputKartuBadge->hashName());

                //delete old image
                Storage::delete('public/manpowers/foto_kartu_badge/'.$manpower->kartu_badge);

                $manpower->fill([
                    'kartu_badge'   => $request->inputKartuBadge->hashName()
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
            }

            if ($request->hasFile('inputFileNPWP')) {
                $inputFileNPWP = $request->file('inputFileNPWP');
                $inputFileNPWP->storeAs('public/manpowers/kartunpwp/', $inputFileNPWP->hashName());

                //delete old image
                Storage::delete('public/manpowers/kartunpwp/'.$manpower->npwp);

                $manpower->fill([
                    'npwp'   => $request->inputFileNPWP->hashName()
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
            }

            if ($request->hasFile('inputFileSertifikat')) {
                $inputFileSertifikat = $request->file('inputFileSertifikat');
                $inputFileSertifikat->storeAs('public/manpowers/sertifikat/', $inputFileSertifikat->hashName());

                //delete old image
                Storage::delete('public/manpowers/sertifikat/'.$manpower->sertifikat);

                $manpower->fill([
                    'sertifikat'   => $request->inputFileSertifikat->hashName()
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
            }

            if ($request->hasFile('inputFileSuratVaksin')) {
                $inputFileSuratVaksin = $request->file('inputFileSuratVaksin');
                $inputFileSuratVaksin->storeAs('public/manpowers/suratvaksin/', $inputFileSuratVaksin->hashName());

                //delete old image
                Storage::delete('public/manpowers/suratvaksin/'.$manpower->suratvaksin);

                $manpower->fill([
                    'surat_vaksin'   => $request->inputFileSuratVaksin->hashName()
                ]);
            }


            $manpower->update();

            $salary = Salary::where('manpower_id', $id)->first();
            if (!empty($request->inputNoRekening)) {
                $salary->fill([
                    'nama_bank'   => $request->inputNamaBank,
                    'no_rekening'   => $request->inputNoRekening,
                ]);

                $salary->update();
            }
           
    
            //redirect to index
            return redirect()->route('manpower.index')->with(['success' => 'Data Berhasil Diubah!']);

        } catch (\Throwable $th) {
            // echo "data gagal ditambahkan";
            return redirect()->route('manpower.index')->with(['error' => 'Data gagal Diubah!']);
        }
    }
}
