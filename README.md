<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Laravel Library Management System
Aplikasi e-Library merupakan sistem perpustakaan digital yang bertujuan untuk memudahkan pengelolaan buku, pengguna, serta transaksi peminjaman dan pengembalian secara online. Aplikasi ini memungkinkan admin untuk menambahkan, mengedit, dan menghapus data buku, serta memantau stok buku yang tersedia.

## Requirements
- php 8.2
- Docker
- MySQL
- Jenkins
- Azure
- Grafana

## Fitur
CRUD Library Book:
- Tambah, edit, hapus, dan lihat daftar Author
- Tambah, edit, hapus, dan lihat daftar Publisher
- Tambah, edit, hapus, dan lihat daftar Category
- Tambah, edit, hapus, dan lihat daftar Book
- Tambah, edit, hapus, dan lihat daftar Student
- Tambah, edit, hapus, dan lihat daftar Book Issue
- Lihat daftar Reports (Date Wished, Monthly Wished, Not Returned)
- Lihat Dashboard (Jumlah Author, Jumlah Publisher, Jumlah Category, Jumlah Buku, Jumlah Siswa, Jumlah Book Issued)

## Fitur Yang Ditambahkan
- Menambahkan list Buku Paling Sering Dipinjam
- Menambahkan fitur export ke excel untuk setiap Reports (Date Wished, Monthly Wished, Not Returned)


## Quick Start 
clone the repo

    git clone https://github.com/tauseedzaman/Laravel-libraray-management-system


change current directory


cd Laravel-libraray-management-system

install dependencies

composer install
`
install js dependencies

npm install && npm run dev
`
create .env file

cp (unix) or copy (Windows) .env.example .env

generate env key

php artisan key:generate

migrate the migration and seed the database

php artisan migrate:fresh --seed

start server

php artisan serve

credentails

username: tauseedzaman
password: password

# That's all 🎊🎉 

Ini adalah project pipeline CICD PSO kami, di project ini kami fokus pada otomasi pipeline, tanpa memperhatikan vulnerability dari web app
ini adalah link dokumentasi project kami:
https://docs.google.com/document/d/1VLYckni4Td3mkf9gI0UmQynrrWlxXcG0HOT14ZPQ_jU/edit?usp=sharing

## ScreenShots
<img src="Screenshots/lms (1).png" width="100%" /><br /> <br />
<img src="Screenshots/lms (2).png" width="100%" /><br /> <br />
<img src="Screenshots/lms (3).png" width="100%" /><br /> <br />
<img src="Screenshots/lms (4).png" width="100%" /><br /> <br />
<img src="Screenshots/lms (5).png" width="100%" /><br /> <br />
<img src="Screenshots/lms (6).png" width="100%" /><br /> <br />
<img src="Screenshots/lms (7).png" width="100%" /><br /> <br />
<img src="Screenshots/lms (8).png" width="100%" /><br /> <br />
<img src="Screenshots/lms (9).png" width="100%" /><br /> <br />
<img src="Screenshots/lms (10).png" width="100%" /><br /> <br />
<img src="Screenshots/lms (11).png" width="100%" /><br /> <br />
<img src="Screenshots/lms (12).png" width="100%" /><br /> <br />
<img src="Screenshots/lms (13).png" width="100%" /><br /> <br />

Watch demo at tauseedzaman youtube channel https://youtube.com/channel/UCnJYN9jTfEnumvJUw4rhh9A


Make sure to leave a start ✨✨
