<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Beritahu nama tabelnya
    protected $table = 'mahasiswa';

    // Semua kolom yang ADA di tabel
    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'jurusan',
        'status',
        'waktu_absen'
    ];

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
}