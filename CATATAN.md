# CATATAN PROYEK CIBO — TAGIHAN P2 (PERTEMUAN 6)

**Mata Kuliah:** Web Framework (INF625313) — Semester 5  
**Tema:** CIBO (*Cinema Booking System*)  
**Bobot Tagihan P2:** 10%  
**Repositori:** [https://github.com/BintangPrasetyo95/cibo.git](https://github.com/BintangPrasetyo95/cibo.git)  

---

## 1. Pembagian Tugas Anggota Kelompok

| Nama Anggota | Area Kerja & Peran | Berkas / Fitur yang Dikerjakan |
| :--- | :--- | :--- |
| **Bintang Prastyo Kusumo Wicaksono** | **Autentikasi & Otorisasi** (Ketua Tim) | Mengimplementasikan sistem autentikasi multi-role (Admin & Kasir/Customer), middleware `PastikanPeran` di `bootstrap/app.php`, pembuatan `FilmPolicy`, pengujian otorisasi, dan props `can`. |
| **Farel Raditya Surya Negara** | **Basis Data & Model** | Merancang ERD, menulis skema migrasi PostgreSQL (`films`, `jadwals`, `pemesanans`), tipe `decimal` mata uang, model Eloquent, relasi `hasMany`/`belongsTo`, serta Seeder & Factory data realistis. |
| **Kadek Dwi Octo Lesa Candigo** | **Antarmuka & Komponen** | Membangun komponen UI interaktif menggunakan React 19 & Tailwind CSS (`Kartu.jsx`, `BarisFilm.jsx`, `Kosong.jsx`, `PesanFlash.jsx`), state denah kursi & konfirmasi hapus, serta penanganan 4 keadaan umpan balik UI. |
| **Joshua Andrew Siahaan** | **Uji Kebergunaan & Dokumentasi** | Menyusun skenario pengujian, menyiapkan 5 calon pengguna nyata untuk sesi Usability Testing Pertemuan 13, serta menyusun dokumentasi teknis sistem dan panduan instalasi. |

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
  - Kontrol aksi ubah & hapus terikat hak akses dari props `can`.
* **Halaman Tambah & Ubah (`create.jsx` & `edit.jsx`):**
  - Menggunakan hook `useForm` dari `@inertiajs/react`.
  - Tombol simpan dinonaktifkan (`disabled={processing}`) dan teks berubah menjadi "Menyimpan…" untuk mencegah *double submit*.
  - Menampilkan pesan galat validasi server (`errors.nama_field`) tepat di samping input.
* **Umpan Balik 4 Keadaan (Rubrik 2.B):**
  1. **Sedang Memuat / Sibuk:** Tombol submit dinonaktifkan saat `processing === true`.
  2. **Berhasil:** Pesan flash `flash.sukses` dibagikan global via `HandleInertiaRequests.php` dan dirender oleh `PesanFlash.jsx`.
  3. **Gagal:** Pesan kesalahan validasi server dirender di bawah input.
  4. **Kosong:** Komponen `Kosong.jsx` tampil ramah pengguna jika tidak ada data.
