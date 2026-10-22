# KARTU LINGKUP PROYEK
**Mata Kuliah:** Web Framework (INF625313) — Semester 5  
**Tahun Ajaran:** Kurikulum 2025  
**Dosen Pengampu:** Mahendra Pratama, S.T., M.Eng.  
**Alamat Repositori Git:** [https://github.com/BintangPrasetyo95/cibo.git](https://github.com/BintangPrasetyo95/cibo.git)  

---

## 1. Tema dan Masalah yang Dijawab
* **Tema Proyek:** CIBO — *Cinema Booking System* (Sistem Pemesanan Tiket Bioskop Mandiri & Loket).
* **Rumusan Masalah:**  
  Antrean pemesanan tiket bioskop di loket fisik sering kali padat dan lambat menjelang penayangan akibat staf kasir kesulitan memeriksa ketersediaan kursi secara visual serta mencocokkan jadwal studio secara cepat. Ketiadaan sistem terintegrasi yang mencatat okupansi kursi secara langsung juga menyulitkan pengelola bioskop dalam merekapitulasi data pendapatan harian dan mendeteksi film yang paling diminati. CIBO hadir menyediakan sistem pemesanan tiket terpusat dengan pemilihan kursi interaktif dan pelaporan transaksi otomatis berbasis web framework modern.

---

## 2. Tiga Modul Data Saling Berelasi
Aplikasi dibangun di atas basis data **PostgreSQL** dengan 3 modul data utama yang saling berelasi:

1. **Modul Film (`films`)**
   - **Fungsi:** Menyimpan katalog film yang sedang atau akan tayang.
   - **Atribut:** `id`, `judul` (varchar 150), `genre` (varchar 60), `durasi_menit` (integer), `usia_rating` (varchar 10: SU, 13+, 17+, 21+), `sinopsis` (text), `status_tayang` (varchar 20: segera, tayang, selesai).
   - **Fitur CRUD & Cari:** Tambah film baru, ubah rincian, hapus film, serta pencarian judul film (menggunakan `ILIKE` di PostgreSQL).
   - **Relasi:** *One-to-Many* ke modul `Jadwal` (`hasMany(Jadwal)`).

2. **Modul Jadwal Tayang (`jadwals`)**
   - **Fungsi:** Mengatur jadwal penayangan film pada studio dan waktu tertentu.
   - **Atribut:** `id`, `film_id` (foreign key constrained ke `films`), `nama_studio` (varchar 50), `tanggal` (date), `jam_mulai` (time), `harga_tiket` (decimal 12, 2 — *tidak menggunakan float*), `total_kursi` (integer default 40).
   - **Fitur CRUD & Cari:** Tambah jadwal per film, ubah jam/studio, batalkan jadwal, saring jadwal berdasarkan tanggal dan studio.
   - **Relasi:** *Belongs-to* ke `Film` dan *One-to-Many* ke `Pemesanan` (`hasMany(Pemesanan)`).

3. **Modul Pemesanan Tiket (`pemesanans`)**
   - **Fungsi:** Mencatat transaksi reservasi tiket dan alokasi kursi penonton.
   - **Atribut:** `id`, `jadwal_id` (foreign key constrained ke `jadwals`), `user_id` (foreign key constrained ke `users`), `kode_booking` (varchar 20 unique), `nomor_kursi` (varchar 10, misal "A1", "B5"), `nama_pemesan` (varchar 100), `total_bayar` (decimal 12, 2), `status_bayar` (varchar 20: lunas, dibatalkan).
   - **Fitur CRUD & Cari:** Pembuatan tiket baru, pembatalan/penghapusan reservasi, pencarian pesanan berdasarkan kode booking atau nama pemesan.
   - **Relasi:** *Belongs-to* ke `Jadwal` dan *Belongs-to* ke `User`.

---

## 3. Dua Peran Pengguna (*Ditegakkan di Sisi Server*)
Aplikasi menerapkan pemisahan hak akses berbasis peran menggunakan Middleware dan Policy Laravel:

1. **Peran `admin`**:
   - Memiliki kewenangan penuh (CRUD) mengelola katalog film dan jadwal studio.
   - Memiliki akses eksklusif ke halaman laporan rekapitulasi okupansi dan pendapatan bioskop.
   - Menghapus transaksi pemesanan yang dibatalkan.
2. **Peran `kasir` (Petugas Loket)**:
   - Dapat melihat katalog film yang sedang tayang beserta jadwalnya.
   - Melakukan input transaksi pemesanan tiket dan pemilihan nomor kursi penonton.
   - Mengonfirmasi pembayaran loket dan mencetak ringkasan tiket.
   - Dilarang keras menambah/mengubah jadwal studio atau mengakses laporan keuangan (*dibatasi dengan HTTP 403 Forbidden di server via Policy*).

---

## 4. Dua Alur Interaksi Non-Sepele
1. **Visualisasi Denah & Validasi Bentrok Kursi (Alur Pemilihan Kursi):**
   - Saat kasir memilih jadwal penayangan, sistem menyajikan visualisasi denah kursi studio (Grid A1 s.d. D10).
   - Sistem memvalidasi ketersediaan kursi secara realtime di sisi server agar nomor kursi yang sama tidak dapat dipesan ganda (*double booking prevention*).
2. **Pencarian Bertingkat & Penjadwalan Tanggal:**
   - Pencarian film berbasis teks menggunakan operator `ILIKE` pada PostgreSQL digabungkan dengan penyaringan dinamis berdasarkan tanggal tayang dan rating umur penonton.

---

## 5. Satu Halaman Rekapitulasi
* **Halaman Laporan Okupansi & Pendapatan (`/laporan`):**
  - Meringkas data lintas modul: menghitung total pemesanan tiket per film, persentase okupansi per studio, dan total akumulasi pendapatan kotor bioskop dalam rentang periode tertentu.
  - Hanya dapat diakses oleh peran `admin` via `Gate::authorize('melihat-laporan')`.

---

## 6. Batasan Proyek (*Yang Tegas Tidak Dikerjakan*)
Mengikuti instruksi Pertemuan 1 Slide 12 (karena alokasi 2 SKS difokuskan pada penguasaan MVC, React Inertia, dan Evaluasi Antarmuka):
- ❌ **Tidak ada pembayaran daring** (*payment gateway* seperti Midtrans/Xendit) — simulasi transaksi bayar tunai/loket.
- ❌ **Tidak ada notifikasi surel/SMS/WhatsApp**.
- ❌ **Tidak ada aplikasi mobile** (hanya web responsive).
- ❌ **Tidak ada deployment ke cloud/internet** — berjalan dan didemonstrasikan di komputer lokal (*localhost*).
- ❌ **Tidak ada integrasi kecerdasan buatan (AI)** di dalam fitur produk aplikasi.

---

## 7. Pembagian Peran Anggota Kelompok
* **Anggota 1:** Perancang Basis Data, Migrasi PostgreSQL, Model Eloquent, dan Seeder Dummy Data.
* **Anggota 2:** Pengembang Backend Controller (7 Aksi RESTful), Validasi Form Request, dan Alur Balik PRG.
* **Anggota 3:** Pengembang Antarmuka Pengguna (React 19, Inertia 3, Tailwind CSS, Komponen Terisolasi, dan 4 Keadaan Umpan Balik).
* **Anggota 4:** Pengembang Keamanan Sistem (Autentikasi, Middleware Peran, Gate & Policy) serta Koordinator Uji Kebergunaan.

---

## 8. Calon Pengguna Nyata untuk Uji Kebergunaan (Minggu 13)
Lima calon pengguna nyata yang bersedia hadir langsung di kampus/laboratorium untuk diuji interaksinya:
1. **Rian Pratama** (Mahasiswa penonton bioskop rutin / Uji alur pemilihan kursi).
2. **Siti Nurhaliza** (Mahasiswi penonton bioskop / Uji keterbacaan jadwal dan informasi film).
3. **Ahmad Fauzan** (Staf kasir kantin/koperasi kampus / Uji alur input transaksi loket cepat).
4. **Budi Santoso** (Pengurus unit kegiatan mahasiswa / Uji navigasi dan pemahaman form).
5. **Dina Lestari** (Mahasiswi umum / Uji kemudahan pencarian film dan penanganan galat input).
