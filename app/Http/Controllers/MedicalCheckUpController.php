<?php

namespace App\Http\Controllers;

use App\Models\MedicalCheckUp;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Laboratorium;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

use PDF;


class MedicalCheckUpController extends Controller
{
    public function index()
    {
        // $medicalcheckup = MedicalCheckUp::all();
        $laboratorium = Laboratorium::with('user')->get();
        $medicalcheckup = MedicalCheckUp::with('user')->get();
        $years = MedicalCheckUp::selectRaw('YEAR(tanggal_pemeriksaan) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $title = 'Medical Check Up';
        return view('mcu.index', compact('medicalcheckup', 'title', 'years', 'laboratorium'));
    }
    public function sumarymcu()
    {
        // $medicalcheckup = MedicalCheckUp::all();
        $laboratorium = Laboratorium::with('user')->get();
        $medicalcheckup = MedicalCheckUp::with('user')->get();
        $years = MedicalCheckUp::selectRaw('YEAR(tanggal_pemeriksaan) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $title = 'Rekapan';
        return view('mcu.sumarymcu', compact('medicalcheckup', 'title', 'years', 'laboratorium'));
    }

    public function json()
    {
        $medicalcheckup = MedicalCheckUp::with('user')->get();
        return DataTables::of($medicalcheckup)->make(true);
        // return DataTables::of(MedicalCheckUp::all())->make(true);
    }

    public function create()
    {
        $users = User::latest()->get();
        // $users = User::latest()->take(2)->get();
        $title = 'MCU Create';
        return view('mcu.create', compact('users', 'title'));
    }


    public function store(Request $request)
    {
        $medicalCheckUps = $request->input('medical_check_up');


        DB::beginTransaction();

        try {
            foreach ($medicalCheckUps as $userId => $data) {

                $user = User::find($userId);

                if ($user) {
                    // Simpan data pemeriksaan medis
                    $medicalCheckUp = new MedicalCheckUp($data);
                    $medicalCheckUp->id_user = $userId;
                    $medicalCheckUp->save();
                }
            }


            DB::commit();

            return redirect()->route('mcu.index')->with('success', 'Rekam Pemeriksaan Medis berhasil ditambahkan');
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('mcu.create')->with('error', 'Gagal menambahkan Rekam Pemeriksaan Medis');
        }
    }

    // jangan di hapus 
    // public function store(Request $request)
    // {
    //     $medicalCheckUps = $request->input('medical_check_up');

    //     foreach ($medicalCheckUps as $userId => $data) {
    //         // Periksa apakah pengguna dengan $userId ada
    //         $user = User::find($userId);

    //         if ($user) {
    //             // Buat instans MedicalCheckUp baru untuk pengguna
    //             $medicalCheckUp = new MedicalCheckUp($data);
    //             $medicalCheckUp->id_user = $userId;
    //             $medicalCheckUp->save();
    //         }
    //     }

    //     return redirect()->route('mcu.index')->with('success', 'Rekam Pemeriksaan Medis berhasil ditambahkan');
    // }
    // MedicalCheckUpController.php

    public function edit($userId, $tahun)
    {
        $user = User::findOrFail($userId);

        $medicalCheckUp = MedicalCheckUp::where('id_user', $userId)
            ->whereYear('tanggal_pemeriksaan', $tahun)
            ->first();

        $title = 'Edit Pemeriksaan Medis';

        // Menggunakan Carbon untuk mendapatkan daftar tahun yang diinginkan
        $years = MedicalCheckUp::distinct()
            ->where('id_user', $userId)
            ->pluck('tanggal_pemeriksaan')
            ->map(function ($date) {
                return Carbon::parse($date)->format('Y');
            })
            ->unique();

        return view('mcu.edit', compact('user', 'medicalCheckUp', 'title', 'years', 'tahun'));
    }





    public function update(Request $request, User $userModel)
    {
        $medicalCheckUps = $request->input('medical_check_up');

        DB::beginTransaction();

        try {
            foreach ($medicalCheckUps as $userId => $data) {
                $user = User::find($userId);

                if ($user) {
                    // Perbarui data pemeriksaan medis
                    $medicalCheckUp = MedicalCheckUp::where('id_user', $userId)->first();

                    if ($medicalCheckUp) {
                        $medicalCheckUp->update($data);
                    } else {
                        // Jika data pemeriksaan medis tidak ditemukan, buat baru
                        MedicalCheckUp::create(array_merge(['id_user' => $userId], $data));
                    }
                }
            }

            DB::commit();

            return redirect()->route('mcu.index')->with('success', 'Data Pemeriksaan Medis berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('mcu.edit', ['user' => $userModel->id])->with('error', 'Gagal memperbarui Data Pemeriksaan Medis');
        }
    }

    // Hapus data tidak menggunakan soft delete
    public function destroy($id, $tahun)
    {
        try {
            // Find the medical checkup record to be deleted
            $medicalCheckup = MedicalCheckUp::where('id_user', $id)
                ->whereYear('tanggal_pemeriksaan', $tahun)
                ->first();

            if (!$medicalCheckup) {
                return redirect()->route('mcu.index')->with('error', 'Data tidak ditemukan');
            }

            // Delete the medical checkup record
            $medicalCheckup->delete();

            return redirect()->route('mcu.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('mcu.index')->with('error', 'Gagal menghapus data');
        }
    }


    // Menu Edit ini belum berfungsi
    // public function saveInlineEdit(Request $request, $id)
    // {
    //     $columnIndex = $request->input('columnIndex');
    //     $newValue = $request->input('newValue');

    //     // Validasi kolom dan nilai baru sesuai kebutuhan
    //     $request->validate([
    //         'columnIndex' => 'required|numeric',
    //         'newValue' => 'required',

    //     ]);

    //     // Kolom apa yang akan diubah? Sesuaikan dengan kolom Anda
    //     $columns = [
    //         7 => 'berat_badan',
    //         8 => 'tinggi_badan',
    //         // ... tambahkan kolom lain sesuai indeksnya
    //         28 => 'hasil_akhir',
    //     ];

    //     $columnName = $columns[$columnIndex] ?? null;

    //     if ($columnName !== null) {
    //         $medicalCheckup = MedicalCheckUp::findOrFail($id);
    //         $medicalCheckup->$columnName = $newValue;
    //         $medicalCheckup->save();

    //         return response()->json(['message' => 'Data berhasil diperbarui.']);
    //     }

    //     return response()->json(['error' => 'Kolom tidak valid.'], 422);
    // }

    // Tampil Rekapan
    public function rekapan()
    {
        $users = User::latest()->get();
        $title = 'Rekap MCU';
        return view('mcu.rekapan', compact('users', 'title'));
    }

    public function showRekapan(Request $request)
    {
        $users = User::latest()->get();
        $title = 'Rekap MCU';
        $user = User::findOrFail($request->user_id);
        $medicalCheckups = MedicalCheckUp::where('id_user', $user->id)
            ->whereYear('tanggal_pemeriksaan', '>', now()->subYears(5)->year)
            ->get();

        return view('mcu.rekapan', compact('users', 'user', 'medicalCheckups', 'title'));
    }
    //  Print MCU
    public function print($id, $tahun)
    {
        $medicalcheckup = MedicalCheckUp::where('id_user', $id)
            ->whereYear('tanggal_pemeriksaan', $tahun)
            ->get();

        $pdf = PDF::loadView('mcu.cetak', compact('medicalcheckup'));
        return $pdf->stream('medicalcheckup.pdf');
    }
}
