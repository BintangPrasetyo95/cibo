<?php

namespace App\Policies;

use App\Models\Film;
use App\Models\User;

class FilmPolicy
{
    /**
     * Siapa pun yang login (admin & kasir) boleh melihat daftar film (Pertemuan 7 Slide 17).
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Siapa pun boleh melihat rincian film (Pertemuan 7 Slide 17).
     */
    public function view(?User $user, Film $film): bool
    {
        return true;
    }

    /**
     * Hanya admin yang berhak menambah film baru (Pertemuan 7 Slide 17 & 30).
     */
    public function create(User $user): bool
    {
        return $user->peran === 'admin';
    }

    /**
     * Hanya admin yang berhak mengubah rincian film (Pertemuan 7 Slide 17 & 30).
     */
    public function update(User $user, Film $film): bool
    {
        return $user->peran === 'admin';
    }

    /**
     * Hanya admin yang berhak menghapus film (Pertemuan 7 Slide 17 & 30).
     */
    public function delete(User $user, Film $film): bool
    {
        return $user->peran === 'admin';
    }
}
