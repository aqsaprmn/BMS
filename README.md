# BMS
Book Management System, It's a system for management books.

# Cara Menggunakan
1. Buat database di lokal mysql dengan nama "bms".
2. Jalankan perintah "php artisan migrate:fresh --seed" untuk melakukan migrasi sesuai dengan table yang dibutuhkan.
3. Jalankan perintah "php artisan storage:link" untuk melakukan link dari setorage ke public folder untuk kebutuhan pengambilan file gambar.
4. Jalankan perintah "php artisan serve" untuk menjalankan local server.
5. Selanjutnya akses link local server ke browser.
6. Login admin:
   Username : admin@admin.com
   Password : admin123
7. Akan otomatis langsung mengarah ke admin panel yaitu menu Buku dan akan tampil tabel dengan data buku.
8. Ada 1 input pencarian yang bisa memfilter segala jenis kolum, hanyan tinggal di ketik data apa yang akan dicari maka akan otomatis table tersebut menyaring datanya.
9. Akan ada fitur untuk membuat, menghapus, mengupdate serta melihat detail data buku.
