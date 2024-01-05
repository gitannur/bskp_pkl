<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class McuDokterController extends Controller
{
    public function index(Request $request)
    {
        $laboratorium = Laboratorium::with('user')->get();
        $years = Laboratorium::selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        $title = 'Laboratorium';

        $newUserId = $request->input('new_user_id');

        // Jika ada ID pengguna baru, ambil data laboratorium untuk pengguna tersebut
        $userLabData = null;
        if ($newUserId) {
            $userLabData = Laboratorium::where('id_user', $newUserId)->get();
        }

        return view('mcudokter.index', compact('laboratorium', 'title', 'years', 'userLabData'));
        // return view('mcudokter.index',compact('laboratorium','title','years'));
    }

    public function create(Request $request)
    {
        $laboratorium = Laboratorium::all();
        $users = User::latest()->with('laboratorium')->get();
        $title = 'Laboratorium';

        // $searchQuery = $request->input('search_user');

        // return view('mcudokter.doktercreate', compact('users', 'title', 'searchQuery'));
        return view('mcudokter.doktercreate', compact('users', 'title'));
    }

    // method store
    public function store(Request $request)
    {
        // Validate the incoming request data
        // $request->validate([
        //     'nama_user' => 'required|string|max:255',
        //     'tanggal' => 'required|date',
        //     'nama_dokter' => 'required|string|max:255',
        //     'hemoglobin' => 'nullable|string|max:255',
        //     'eritrosit' => 'nullable|string|max:255',
        //     'luekosit' => 'nullable|string|max:255',
        //     'hematokrit' => 'nullable|string|max:255',
        //     'trombosit' => 'nullable|string|max:255',
        //     'glukosa_sewaktu' => 'nullable|string|max:255',
        //     'warna' => 'nullable|string|max:255',
        //     'kejernihan' => 'nullable|string|max:255',
        //     'bj' => 'nullable|string|max:255',
        //     'ph' => 'nullable|string|max:255',
        //     'leuko' => 'nullable|string|max:255',
        //     'nitrit' => 'nullable|string|max:255',
        //     'protein' => 'nullable|string|max:255',
        //     'glukosa' => 'nullable|string|max:255',
        //     'keton' => 'nullable|string|max:255',
        //     'urobil' => 'nullable|string|max:255',
        //     'bili' => 'nullable|string|max:255',
        //     'blood' => 'nullable|string|max:255',
        //     'm_leuko' => 'nullable|string|max:255',
        //     'eri' => 'nullable|string|max:255',
        //     'epitel' => 'nullable|string|max:255',
        //     'kristal' => 'nullable|string|max:255',
        //     'bakteri' => 'nullable|string|max:255',
        //     'jamur' => 'nullable|string|max:255',
        //     'silinder' => 'nullable|string|max:255',
        // ]);
        
         Laboratorium::create($request->all());
        // dd($laboratorium);
        return redirect()->route('mcudokter.index')->with('success', 'Data berhasil disimpan');
    }
    

    // method edit
    public function edit($userId, $tahun)
    {
        $user = User::findOrFail($userId);

        $laboratorium = Laboratorium::where('id_user', $userId)
            ->whereYear('tanggal', $tahun)
            ->first();

        $title = 'Edit Laboratorium';

        // Menggunakan Carbon untuk mendapatkan daftar tahun yang diinginkan
        $years = Laboratorium::distinct()
            ->where('id_user', $userId)
            ->pluck('tanggal')
            ->map(function ($date) {
                return Carbon::parse($date)->format('Y');
            })
            ->unique();

        return view('mcudokter.edit', compact('user', 'laboratorium', 'title', 'years', 'tahun'));
    }





    public function update(Request $request, User $userModel)
    {
        $laboratorium = $request->input('laboratorium');

        DB::beginTransaction();

        try {
            foreach ($laboratorium as $userId => $data) {
                $user = User::find($userId);

                if ($user) {
                    // Perbarui data pemeriksaan medis
                    $laboratorium = Laboratorium::where('id_user', $userId)->first();

                    if ($laboratorium) {
                        $laboratorium->update($data);
                    } else {
                        // Jika data pemeriksaan medis tidak ditemukan, buat baru
                        Laboratorium::create(array_merge(['id_user' => $userId], $data));
                    }
                }
            }

            DB::commit();

            return redirect()->route('mcudokter.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('mcudokter.edit', ['user' => $userModel->id])->with('error', 'Gagal memperbarui Data');
        }
    }

    public function print($id, $tahun)
    {
        $laboratorium = Laboratorium::where('id_user', $id)
            ->whereYear('tanggal', $tahun)
            ->get();

        $pdf = PDF::loadView('mcudokter.cetak', compact('laboratorium'));
        return $pdf->stream('laboratorium.pdf');
    }
}
