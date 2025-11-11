# TODO: Implement Role-Based Dashboards and Seeders

## 1. Create BookSeeder
- Create database/seeders/BookSeeder.php
- Populate books table with sample data (judul, penulis, penerbit, tahun_terbit, stok, id_kategori)

## 2. Create CategorySeeder
- Create database/seeders/CategorySeeder.php
- Populate categories table with sample categories

## 3. Create LoanSeeder
- Create database/seeders/LoanSeeder.php
- Populate loans table with sample loan records (id_user, tanggal_pinjam, tanggal_kembali, status)

## 4. Create LoaningDetailSeeder
- Create database/seeders/LoaningDetailSeeder.php
- Populate loaning_details table with sample details (id_peminjaman, id_buku, jumlah)

## 5. Update DatabaseSeeder
- Edit database/seeders/DatabaseSeeder.php
- Add calls to new seeders in the run method

## 6. Update Dashboard View
- Edit/Create resources/views/dashboard.blade.php
- Add conditional rendering for Admin, Staff, Mahasiswa roles
- Display role-specific menus and features
