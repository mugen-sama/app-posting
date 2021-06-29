# App-Posting
Aplikasi berbasis PHP dengan framework Laravel versi 8 dan database mysql serta tampilan menggunakan Bootstrap. 

Pada aplikasi ini user dapat melakukan posting text dan upload gambar serta dapat mengedit dan menghapus postingan yang sudah dibuat.

Terdiri dari 2 halaman yaitu dashboard yang berisi seluruh postingan semua user, dan 1 halaman untuk detail postingan yang dibuat.

User role terdiri dari admin dan user biasa, dimana admin dapat melakukan proses CRUD terhadap semua psotingan user, tetapi user biasa hanya dapat melihat postingan user lain dan hanya mengedit dan menghapus postingan miliknya sendiri. 

Authentication user dibuat menggunakan auth middleware bawaan laravel 8.
