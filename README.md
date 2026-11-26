# ExploreSulbar — Sistem E-Ticketing Destinasi Wisata Sulawesi Barat

Aplikasi web pemesanan tiket elektronik (*e-ticketing*) berbasis QR Code untuk destinasi wisata di Provinsi Sulawesi Barat. Sistem ini dirancang dengan dua aktor utama: **Wisatawan (Pembeli)** yang dapat memesan tiket secara cepat tanpa wajib membuat akun, serta **Petugas Wisata (Penjual / Pengelola)** yang mengelola destinasi, memverifikasi pembayaran, dan memindai QR Code tiket pengunjung di pintu masuk.

---

## 🔗 Tautan Aplikasi & Repository
- **Live Website:** `http://prezekc.infinityfree.me` *(atau `https://prezekc.infinityfree.me` setelah SSL aktif)*
- **Repository GitHub:** `https://github.com/Hasanah977/wisata-sulbar-eticket`

---

## 👥 Panduan Akses & Informasi Pengguna (Pembeli & Penjual)

### 1. User Pembeli — Wisatawan (Pengunjung)
Wisatawan tidak perlu melakukan registrasi atau login untuk membeli tiket (*frictionless booking*).

- **Halaman Akses:** `/` (Halaman Beranda)
- **Alur Penggunaan:**
  1. Buka halaman utama aplikasi untuk melihat katalog destinasi wisata Sulawesi Barat (lokasi, harga tiket, kuota, dan deskripsi).
  2. Pilih destinasi yang diinginkan lalu klik **Pesan Tiket**.
  3. Isi formulir pemesanan (Nama Lengkap, Nomor WhatsApp/Email, Tanggal Kunjungan, dan Jumlah Tiket).
  4. Lakukan konfirmasi pembayaran sesuai instruksi yang tampil di halaman ringkasan pesanan.
  5. Setelah pesanan terkonfirmasi, sistem menerbitkan **E-Ticket digital berisi QR Code unik** beserta kode booking yang dapat diunduh/ditunjukkan langsung kepada petugas di lokasi wisata.
- **Fitur Cek Pesanan:** Wisatawan dapat mengecek ulang status tiket kapan saja melalui menu **Cek Tiket / Pesanan** menggunakan Kode Booking atau Nomor WhatsApp.

---

### 2. User Penjual / Pengelola — Petugas Wisata (Admin Lokasi)
Petugas wisata bertugas mengelola data destinasi, memvalidasi transaksi masuk, dan melakukan *check-in* pengunjung melalui pemindaian QR Code.

- **Halaman Login Petugas:** `/petugas/login` *(atau `/login` sesuai rute autentikasi aplikasi)*
- **Kredensial Akun Uji Coba (Demo):**
  - **Email:** `petugas@wisatasulbar.id`
  - **Password:** `password123`
  *(Catatan: Apabila login menggunakan data hasil import database lokal, sesuaikan dengan email & password akun petugas yang terdaftar di tabel `users`).*
- **Hak Akses & Fitur Utama:**
  1. **Dashboard Ringkasan:** Melihat statistik penjualan tiket harian, total pendapatan, dan jumlah pengunjung yang sudah *check-in*.
  2. **Manajemen Destinasi (Katalog Produk):** Menambah, mengubah harga/kuota, atau memperbarui informasi destinasi wisata.
  3. **Manajemen Transaksi:** Memantau daftar pesanan masuk dari wisatawan dan memverifikasi status pembayaran.
  4. **Scanner QR Code Validasi Tiket:** Memindai QR Code milik wisatawan menggunakan kamera perangkat (atau input kode tiket manual) untuk memvalidasi keaslian tiket dan mengubah status tiket menjadi *Sudah Digunakan (Used)* agar tidak dapat dipakai ulang.

---

## 🛠️ Teknologi yang Digunakan
- **Backend:** PHP 8.3 & Laravel Framework
- **Frontend:** Blade Template, Tailwind CSS, JavaScript
- **Database:** MySQL / MariaDB
- **Fitur Keamanan:** Token CSRF, validasi QR Code sekali pakai (*one-time check-in*), dan enkripsi sesi.
