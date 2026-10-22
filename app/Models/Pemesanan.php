<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemesanan extends Model
{
    use HasFactory;

    /**
     * Nama tabel eksplisit (Pertemuan 3 Slide 11).
     */
    protected $table = 'pemesanans';

    /**
     * Perlindungan mass-assignment (Pertemuan 3 Slide 11).
     *
     * @var list<string>
     */
    protected $fillable = [
        'jadwal_id',
        'user_id',
        'kode_booking',
        'nomor_kursi',
        'nama_pemesan',
        'total_bayar',
        'status_bayar',
    ];

    /**
     * Casts tipe atribut model (Pertemuan 3 Slide 14).
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_bayar' => 'decimal:2',
    ];

    /**
     * Relasi banyak-ke-satu: Satu pemesanan tiket milik satu jadwal.
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    /**
     * Relasi banyak-ke-satu: Satu pemesanan tiket dicatat oleh satu pengguna/petugas.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
