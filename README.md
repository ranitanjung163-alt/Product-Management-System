# Aplikasi Product Manager

Aplikasi Product Manager adalah aplikasi berbasis web yang dibuat menggunakan PHP dan MySQL untuk membantu pengguna mengelola data produk secara sederhana. Aplikasi ini menerapkan konsep CRUD (*Create, Read, Update, Delete*) sehingga pengguna dapat menambahkan, melihat, mengubah, dan menghapus data produk.

Proyek ini dibuat sebagai latihan pengembangan aplikasi web dengan menerapkan koneksi database, validasi input, keamanan dasar, serta desain antarmuka yang responsif.

## 1. Tujuan Proyek

Tujuan pembuatan aplikasi ini adalah:

- Mempelajari pengembangan aplikasi web menggunakan PHP dan MySQL.
- Memahami cara menghubungkan PHP dengan database menggunakan PDO.
- Menerapkan operasi CRUD pada data produk.
- Menerapkan validasi data untuk mengurangi kesalahan input.
- Memahami penerapan keamanan dasar pada aplikasi web.
- Membuat tampilan aplikasi yang mudah digunakan dan responsif.

## 2. Fitur Aplikasi

### 2.1 Pengelolaan Data Produk (CRUD)

Aplikasi menyediakan fungsi untuk mengelola data produk:

- *Create:* menambahkan produk baru.
- *Read:* menampilkan daftar produk yang tersimpan di database.
- *Update:* mengubah informasi produk.
- *Delete:* menghapus produk yang tidak diperlukan.

Informasi produk meliputi nama produk, kategori, harga, dan stok.

## 2.2 Validasi Input

Aplikasi melakukan validasi terhadap data yang dimasukkan pengguna, antara lain:

- Nama produk harus memenuhi panjang minimum.
- Nama produk tidak boleh duplikat.
- Kategori harus dipilih dari kategori yang tersedia.
- Harga harus berupa angka yang lebih besar dari nol.
- Stok harus berupa angka dan tidak boleh negatif.

Validasi ini membantu menjaga konsistensi data yang disimpan.

## 2.3 Keamanan Aplikasi

Beberapa mekanisme keamanan dasar yang diterapkan:

- **PDO dan prepared statements:** digunakan dalam operasi database untuk membantu mencegah SQL Injection.
- **`htmlspecialchars()`:** digunakan untuk mengamankan teks yang ditampilkan ke halaman HTML dan mengurangi risiko XSS.
- **CSRF token:** digunakan untuk memvalidasi permintaan penghapusan produk.
- **Konfirmasi penghapusan:** pengguna diminta mengonfirmasi sebelum menghapus produk.

## 2.4 Pencarian dan Filter Produk

Pengguna dapat mencari produk berdasarkan nama atau kategori, serta menyaring daftar produk menggunakan kategori yang tersedia.

## 2.5 Tampilan Responsif

Aplikasi menggunakan HTML dan CSS dengan Flexbox untuk menyusun elemen halaman agar lebih rapi dan menyesuaikan ukuran layar.

## 3. Teknologi yang Digunakan

| Teknologi | Kegunaan |
|---|---|
| PHP | Menangani logika aplikasi dan pemrosesan data |
| MySQL | Menyimpan data produk |
| PDO | Menghubungkan PHP dengan database |
| HTML5 | Membuat struktur halaman web |
| CSS3 | Mengatur desain dan tata letak |
| GitHub | Menyimpan dan mendokumentasikan kode proyek |

## 4. Struktur Folder dan File

text
Project2_250180115_RaniRahmayantiTanjung/
├── database/
├── .gitignore
├── README.md
├── create.php
├── db.php
├── delete.php
├── edit.php
├── index.php
└── style.css

Penjelasan file dan folder:

- **`database/`** — folder yang disediakan untuk berkas terkait database.
- **`.gitignore`** — mengatur berkas yang tidak perlu dimasukkan ke Git.
- **`README.md`** — dokumentasi proyek dan petunjuk penggunaan.
- **`index.php`** — halaman utama untuk menampilkan, mencari, dan memfilter produk.
- **`create.php`** — menangani penambahan produk baru dan validasi input.
- **`edit.php`** — menangani perubahan data produk.
- **`delete.php`** — menangani penghapusan produk.
- **`db.php`** — mengatur koneksi PHP ke database MySQL menggunakan PDO.
- **`style.css`** — mengatur tampilan dan tata letak aplikasi.

## 5. Persiapan dan Instalasi

Aplikasi dapat dijalankan di komputer lokal menggunakan XAMPP atau lingkungan pengembangan PHP dan MySQL yang sesuai.

### Langkah 1: Persiapkan lingkungan

Pastikan perangkat telah memiliki:
- XAMPP atau lingkungan server lokal yang setara.
- PHP.
- MySQL atau MariaDB.
- Browser web.

### Langkah 2: Salin proyek

Unduh atau clone repository ini, kemudian letakkan folder proyek di dalam direktori `htdocs` jika menggunakan XAMPP.

bash
git clone https://github.com/ranitanjung163-alt/Project2_250180115_RaniRahmayantiTanjung.git

### Langkah 3: Jalankan layanan lokal

Buka XAMPP Control Panel, kemudian jalankan **Apache** dan **MySQL**.

### Langkah 4: Siapkan database

1. Buka phpMyAdmin melalui `http://localhost/phpmyadmin`.
2. Buat database dengan nama `store_db`.
3. Periksa folder `database/` pada repository untuk menemukan berkas SQL yang dapat digunakan.
4. Jika berkas SQL tersedia, impor berkas tersebut melalui phpMyAdmin agar tabel produk dibuat sesuai dengan struktur aplikasi.

Database harus memiliki tabel `products` dengan kolom yang digunakan aplikasi, yaitu `id`, `name`, `category`, `price`, dan `stock`.

### Langkah 5: Periksa konfigurasi koneksi

Buka file `db.php` dan pastikan konfigurasi koneksi sesuai dengan lingkungan lokal.

Konfigurasi default yang digunakan proyek:

php
$host = 'localhost';
$db = 'store_db';
$user = 'root';
$pass = '';

Jika nama database, username, atau password MySQL di komputer berbeda, sesuaikan nilai tersebut.

### Langkah 6: Jalankan aplikasi

Buka browser dan akses:

http://localhost/Project2_250180115_RaniRahmayantiTanjung/

Jika nama folder proyek di `htdocs` berbeda, sesuaikan alamat URL dengan nama folder yang digunakan.

## 6. Alur Kerja Aplikasi

1. Pengguna membuka halaman utama melalui `index.php`.
2. Aplikasi mengambil data produk dari database menggunakan koneksi PDO.
3. Pengguna dapat mencari produk atau memilih kategori untuk memfilter hasil.
4. Untuk menambahkan produk, pengguna membuka halaman `create.php` dan mengisi formulir.
5. Sistem memvalidasi input sebelum menyimpan data ke database.
6. Pengguna dapat membuka `edit.php` untuk mengubah data produk.
7. Pengguna dapat menghapus produk melalui `delete.php` setelah konfirmasi dan validasi CSRF token.

## 7. Pengujian Fitur

Pengujian dapat dilakukan secara manual dengan skenario berikut:

| No. | Skenario Pengujian | Hasil yang Diharapkan |
|---|---|---|
| 1 | Membuka halaman utama | Daftar produk ditampilkan |
| 2 | Menambahkan produk dengan data valid | Produk tersimpan |
| 3 | Memasukkan nama produk yang sama | Sistem menolak duplikasi |
| 4 | Memasukkan harga nol atau negatif | Validasi menolak input |
| 5 | Memasukkan stok negatif | Validasi menolak input |
| 6 | Mencari nama produk | Produk yang sesuai ditampilkan |
| 7 | Memilih filter kategori | Daftar produk disaring |
| 8 | Mengubah data produk | Perubahan tersimpan |
| 9 | Menghapus produk | Produk terhapus setelah konfirmasi |
| 10 | Memasukkan teks khusus pada nama produk | Teks ditampilkan dengan escaping HTML |

Tabel tersebut merupakan skenario pengujian yang dapat dilakukan; hasilnya perlu dikonfirmasi dengan menjalankan setiap skenario pada aplikasi.

## 8. Kesimpulan

Aplikasi Product Manager merupakan proyek web sederhana untuk mempelajari pengelolaan data menggunakan PHP dan MySQL. Melalui proyek ini, konsep CRUD, koneksi database dengan PDO, validasi input, pencarian data, serta penerapan keamanan dasar dapat dipelajari secara langsung.

Dokumentasi ini disediakan agar struktur kode, tujuan, fitur, dan cara menjalankan aplikasi dapat dipahami dengan lebih mudah oleh pengguna maupun pengajar.

## 9. Repository

Kode sumber proyek tersedia di GitHub:

[Project2_250180115_RaniRahmayantiTanjung](https://github.com/ranitanjung163-alt/Project2_250180115_RaniRahmayantiTanjung)
