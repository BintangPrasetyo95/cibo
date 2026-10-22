<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    use HasFactory;

    /**
     * Nama tabel eksplisit (Pertemuan 3 Slide 11).
     */
    protected $table = 'films';

    /**
     * Perlindungan mass-assignment: daftarkan kolom yang boleh diisi (Pertemuan 3 Slide 11 & 25).
     * Dilarang menggunakan $guarded = [].
     *
     * @var list<string>
     */
    protected $fillable = [
        'judul',
        'genre',
        'durasi_menit',
        'usia_rating',
        'sinopsis',
        'status_tayang',
    ];

    /**
     * Casts tipe atribut model (Pertemuan 3 Slide 14).
     *
     * @var array<string, string>
     */
    protected $casts = [
        'durasi_menit' => 'integer',
    ];

    /**
     * Relasi satu-ke-banyak: Satu film memiliki banyak jadwal tayang.
     */
    public function jadwals(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'film_id');
    }
}
