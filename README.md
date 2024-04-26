# BMS
Book Management System, It's a system for management books.

# Cara Menggunakan
1. Jalankan perintah "composer install" untuk mendownload vendor inisiasi.
2. Buat database di lokal mysql dengan nama "bms".
3. Jalankan perintah "php artisan migrate:fresh --seed" untuk melakukan migrasi sesuai dengan table yang dibutuhkan.
4. Jalankan perintah "php artisan storage:link" untuk melakukan link dari setorage ke public folder untuk kebutuhan pengambilan file gambar.
5. Jalankan perintah "php artisan serve" untuk menjalankan local server.
6. Selanjutnya akses link local server ke browser.
7. Login admin:
   Username : admin@admin.com
   Password : admin123
8. Akan otomatis langsung mengarah ke admin panel yaitu menu Buku dan akan tampil tabel dengan data buku.
9. Ada 1 input pencarian yang bisa memfilter segala jenis kolum, hanyan tinggal di ketik data apa yang akan dicari maka akan otomatis table tersebut menyaring datanya.
10. Akan ada fitur untuk membuat, menghapus, mengupdate serta melihat detail data buku.
