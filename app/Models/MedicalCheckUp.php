<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCheckUp extends Model
{
    use HasFactory;
    
    protected $table ='medical_check_up';
    protected $fillable = [
        'id_user',
        'tanggal_pemeriksaan',
        'berat_badan',
        'tinggi_badan', 
        'anggota_gerak',
        'tekanan_darah',
        'nadi',
        'imt',
        'telinga',
        'hidung',
        'tenggorokan',
        'mata',
        'cardiovaskuler',
        'pernafasan',
        'abdomen',
        'urine',
        'hematologi',
        'audiometri',
        'spirometri',
        'riwayat_penyakit',
        'diagnosa',
        'saran',
        'hasil_akhir',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    // public function laboratorium()
    // {
    //     return $this->hasMany(Laboratorium::class, 'id_laboratorium');
    // }
}
