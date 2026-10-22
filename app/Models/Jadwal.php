<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jadwal extends Model
{
    use HasFactory;

    /**
     * Nama tabel eksplisit (Pertemuan 3 Slide 11).
     */
    protected $table = 'jadwals';

    /**
     * Perlindungan mass-assignment (Pertemuan 3 Slide 11).
     *
     * @var list<string>
     */
    protected $fillable = [
        'film_id',
        'nama_studio',
        'tanggal',
        'jam_mulai',
        'harga_tiket',
        'total_kursi',
    ];

    /**
     * Casts tipe atribut model (Pertemuan 3 Slide 14).
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal' => 'date',
        'harga_tiket' => 'decimal:2',
        'total_kursi' => 'integer',
    ];

    /**
     * Relasi banyak-ke-satu: Satu jadwal tayang milik satu film.
     */
    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    /**
     * Relasi satu-ke-banyak: Satu jadwal memiliki banyak pemesanan tiket.
     */
    public function pemesanans(): HasMany
    {
        return $this->hasMany(Pemesanan::class, 'jadwal_id');
    }
}
