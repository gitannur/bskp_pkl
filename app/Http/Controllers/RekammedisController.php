<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use App\Models\DaftarPenyakit;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekammedisController extends Controller

{
    public function index()
    {
        $rekammedis = RekamMedis::with('user')->get();
        $years = RekamMedis::selectRaw('YEAR(tanggal)as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        $title = 'Rekam Medis';
        return view('rekammedis.rekammedis', compact('rekammedis', 'title', 'years'));
    }

    public function create(Request $request)
    {

        $users = User::all();
        $title = 'Rekam Medis';

        // $searchQuery = $request->input('search_user');
        $daftarPenyakit = DaftarPenyakit::all();
        return view('rekammedis.create', compact('users', 'title', 'daftarPenyakit'));
    }


    public function store(Request $request)
    {


        // Simpan data rekam medis baru
        RekamMedis::create($request->all());


        return redirect()->route('rekammedis.rekammedis')->with('success', 'Rekam Medis berhasil disimpan');
    }

    public function jumlahberobat(Request $request)
    {
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');
    
        $query = User::select('dept');
    
        for ($i = 1; $i <= 12; $i++) {
            $query->selectRaw("SUM(CASE WHEN MONTH(rekam_medis.tanggal) = $i THEN 1 ELSE 0 END) as month_$i");
        }
    
        $query->selectRaw('COUNT(*) as total')
            ->join('rekam_medis', 'users.id', '=', 'rekam_medis.id_user')
            ->groupBy('dept');
    
        if ($selectedMonth) {
            $query->whereMonth('rekam_medis.tanggal', $selectedMonth);
        }
    
        if ($selectedYear) {
            $query->whereYear('rekam_medis.tanggal', $selectedYear);
        }
    
        $departmentStats = $query->get();
    
        $years = RekamMedis::selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
    
        $title = 'Rekam Medis';
        return view('rekammedis.jumlahberobat', compact('departmentStats', 'title', 'years'));
    }
    

    // Tampil Rekapan
    public function rekapan()
    {
        $users = User::latest()->get();
        $title = 'Rekap Rekam Medis';
        return view('rekammedis.rm_rekapan', compact('users', 'title'));
    }

    public function showRekapan(Request $request)
    {
        $users = User::latest()->get();
        $title = 'Rekap Rekam Medis';
        $user = User::findOrFail($request->user_id);
        $rekammedis = RekamMedis::where('id_user', $user->id)
            ->whereYear('tanggal', '>', now()->subYears(5)->year)
            ->get();

        return view('rekammedis.rm_rekapan', compact('users', 'user', 'rekammedis', 'title'));
    }


    public function jenispenyakit()
    {
        $title = 'Rekam Medis ';
        $user = User::all();
        $daftarPenyakit = DaftarPenyakit::all();
        $data = [];

        foreach ($daftarPenyakit as $penyakit) {
            $monthlyCases = RekamMedis::where('id_daftar_penyakit', $penyakit->id)
                ->select(DB::raw('MONTH(tanggal) as month'), DB::raw('COUNT(*) as cases'))
                ->groupBy(DB::raw('MONTH(tanggal)'))
                ->get();

            $data[$penyakit->id]['penyakit'] = $penyakit->nama_penyakit;
            foreach ($monthlyCases as $monthlyCase) {
                $data[$penyakit->id]['months'][$monthlyCase->month] = $monthlyCase->cases;
            }
        }

        return view('rekammedis.jenispenyakit', compact('title', 'data'));
    }

    public function tampilnonkaryawan()
    {
        $title = 'Rekam Medis Non Karyawan';
        return view('rekammedis.nonkaryawan', compact('title'));
    }
}
