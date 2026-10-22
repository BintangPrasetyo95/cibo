# CATATAN PROYEK CIBO — TAGIHAN P2 (PERTEMUAN 6)

**Mata Kuliah:** Web Framework (INF625313) — Semester 5  
**Tema:** CIBO (*Cinema Booking System*)  
**Bobot Tagihan P2:** 10%  
**Repositori:** [https://github.com/BintangPrasetyo95/cibo.git](https://github.com/BintangPrasetyo95/cibo.git)  

---

## 1. Pembagian Tugas Anggota Kelompok

| Nama Anggota | Peran & Tanggung Jawab | Berkas yang Dikerjakan |
| :--- | :--- | :--- |
| **Bintang Prasetyo** | **Ketua & Backend Developer** | Menyiapkan `FilmController` (7 aksi penuh), Form Request `StoreFilmRequest` & `UpdateFilmRequest`, serta perutean RESTful. |
| **Anggota 2** | **Database & Migrasi** | Menyiapkan skema migrasi PostgreSQL (`films`, `jadwals`, `pemesanans`), model Eloquent, relasi, serta Seeder & Factory data realistis. |
| **Anggota 3** | **Frontend React & Komponen** | Merancang arsitektur komponen React 19 (`Kartu.jsx`, `BarisFilm.jsx`, `Kosong.jsx`, `PesanFlash.jsx`), tata letak `AppLayout.jsx`, serta halaman `index.jsx` & `show.jsx`. |
| **Anggota 4** | **Formulir, State & Umpan Balik UI** | Menerapkan hook `useForm` pada `create.jsx` & `edit.jsx`, konfirmasi modal hapus dengan `useState`, penanganan tombol sibuk (`processing`), dan pesan flash session via `HandleInertiaRequests`. |

---

## 2. Modul 1: Katalog Film (Berjalan Penuh di React 19 + Inertia 3)

Modul data pertama (`Film`) telah sepenuhnya dialihkan ke antarmuka React 19 tanpa menyisakan berkas Blade:

* **Halaman Daftar (`resources/js/pages/film/index.jsx`):**
  - Menerima paginasi dari server via props `films.data`.
  - Menggunakan komponen modular `BarisFilm.jsx` dengan atribut unik `key={film.id}`.
  - Komponen `Kosong.jsx` dengan tombol CTA jika katalog kosong.
* **Halaman Rincian (`resources/js/pages/film/show.jsx`):**
  - Menampilkan metadata film dan tabel jadwal tayang studio terkait.
  - Konfirmasi hapus interaktif menggunakan state peramban `useState`.
* **Halaman Tambah & Ubah (`create.jsx` & `edit.jsx`):**
  - Menggunakan hook `useForm` dari `@inertiajs/react`.
  - Tombol simpan dinonaktifkan (`disabled={processing}`) dan teks berubah menjadi "Menyimpan…" untuk mencegah *double submit*.
  - Menampilkan pesan galat validasi server (`errors.nama_field`) tepat di samping input.
* **Umpan Balik 4 Keadaan (Rubrik 2.B):**
  1. **Sedang Memuat / Sibuk:** Tombol submit dinonaktifkan saat `processing === true`.
  2. **Berhasil:** Pesan flash `flash.sukses` dibagikan global via `HandleInertiaRequests.php` dan dirender oleh `PesanFlash.jsx`.
  3. **Gagal:** Pesan kesalahan validasi server dirender di bawah input.
  4. **Kosong:** Komponen `Kosong.jsx` tampil ramah pengguna jika tidak ada data.
