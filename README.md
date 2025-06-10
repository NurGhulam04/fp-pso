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

## Progress Setup
Berikut merupakan Arsitektur Pipeline dari Project Perpusgul

<img src="Screenshots/PSO progress.jpg" width="100%" /><br /> <br />

### Docker Setup
- Clone the project repo
- Install Docker desktop apps
- Buat Dockerfile
- BuatNginx configuration file
- Buat docker-compose.yml file
- Menambahkan daftar service (app, web, db)
- Jalankan docker desktop
- Build and start container
- Open the project in localhost:8080 or click the link in the docker apps
- repo link: https://github.com/NurGhulam04/fp-pso

### Jenkins Setup
- Buat VM di azure untuk Jenkins
- Install Jenkins Pada VM
- Buat Jenkinfile yang berisi pipeline script
- Buat Personal Access Token Github
- Buat credential baru di jenkins
- Buat Pipeline baru
- Konfigurasi pipeline

### Buat Job Pipeline CI/CD
- Buat webhook github untuk trigger pipeline
- Buat job pipeline untuk ci dengan trigger dari branch update
- Buat job pipeline untuk cd dengan trigger dari branch main

### Build Jenkinsfile_ci
- Buat jenkinsfil_ci
- Mendefinisikan environment yang digunakan seluruh pipeline (database, docker image, docker tag) 
- Buat stage (checkout, instal dependencies, test, build, merge main and push)
    - Stage Checkout
        Stage ini berfungsi untuk mengambil (clone) kode sumber dari repository GitHub agar dapat digunakan dalam proses selanjutnya
    - Stage Instal Dependencies
        Stage Install Dependencies digunakan untuk menginstal semua dependensi yang dibutuhkan oleh aplikasi PHP di dalam container Docker. Pada tahap ini, pipeline menjalankan container berbasis image php:8.3-cli dan memetakan direktori kerja ke folder proyek. Di dalam container, perintah yang dijalankan mencakup update package list, instalasi beberapa library sistem yang dibutuhkan (seperti unzip, git, libzip, libpng, dan libxml2), instalasi ekstensi PHP (zip, gd, dan dom), lalu mengunduh dan menjalankan installer Composer untuk menginstal semua dependensi proyek yang didefinisikan dalam file composer.json. Seluruh proses ini dilakukan secara bersih menggunakan opsi --rm agar container dihapus otomatis setelah selesai.
    - Stage Build Docker Image
        Stage Build Docker Image bertugas untuk membangun image Docker dari aplikasi Laravel yang ada di dalam repository. Pada tahap ini, perintah docker build -t laravel-app. dijalankan untuk membuat image baru dengan nama/tag laravel-app menggunakan Dockerfile yang terdapat di direktori saat ini. 
    - Stage Test
        Stage Test digunakan untuk menjalankan pengujian otomatis pada aplikasi menggunakan PHPUnit di dalam container Docker. Pada tahap ini, pipeline menjalankan container, memetakan direktori kerja ke dalam container, lalu melakukan instalasi dependensi, seperti libsqlite3-dev dan ekstensi PHP pdo serta pdo_sqlite. Setelah lingkungan testing siap, perintah php vendor/bin/phpunit dijalankan untuk mengeksekusi semua tes di exampleTest.php. File tersebut melakukan pengujian HTTP (feature test) untuk memastikan bahwa berbagai rute utama pada aplikasi e-Library dapat diakses dan memberikan respons status HTTP 200 (berhasil). Rute yang diuji meliputi /dashboard, /authors, /publishers, /books, /reports, /students, dan /book_issue.
    - Merge to Main and Push
        Pada Stage ini berguna untuk menggabungkan dari branch update dengan branch main yang kemudian melakukan Push secara otomatis.


### Build Jenkinsfile_cd
- Buat jenkinsfil_cd
- Buat environment untuk dockerhub dengan mencantumkan nama image dan tag
- Buat stage (Checkout Source, Build Docker Image, Push to DockerHub)
    - Stage Checkout Source
        Stage ini digunakan dalam proses Continuous Deployment (CD), di mana pipeline mengambil versi stabil dari aplikasi untuk didistribusikan atau dideploy ke server produksi. Meskipun opsional, stage ini berguna jika proses deployment dilakukan terpisah dari proses build atau testing dan memerlukan pengambilan ulang source code yang sudah bersih dari branch utama.
    - Stage Build Docker Image
        Stage ini berfungsi untuk membangun image Docker dari aplikasi Laravel yang ada di direktori saat ini. Pada tahap ini, perintah docker build -t laravel-app . dijalankan untuk membuat image dengan tag laravel-app menggunakan Dockerfile yang tersedia.
    - Stage Push to DockerHub
        Stage ini berfungsi untuk mengunggah image Docker yang telah dibangun sebelumnya ke DockerHub. Pada tahap ini, pipeline menggunakan kredensial yang disimpan di Jenkins (dengan credentialsId: 'dockerhub-creds') untuk login ke DockerHub secara aman. Setelah berhasil login, image dengan tag laravel-app diberi tag baru sesuai dengan variabel $DOCKER_IMAGE:$DOCKER_TAG, lalu didorong (push) ke repository DockerHub tujuan. Setelah proses selesai, pipeline melakukan logout dari DockerHub untuk menjaga keamanan kredensial.



### Setup Azure Cloud & Deploy
- Buat web app service untuk deploy web
- Buat database untuk web
- Migrate database

### Setup Azure web app config
- Buat environment variable untuk web app
- Konfigurasi webhook untuk dockerhub
- Masukkan webhook ke dockerhub

### Test Pipeline & Troubleshooting
- Commit source code tambahan di github melalui visual studio code
- Melihat apakah pipeline di jenkins sudah jalan ketika terdapat commit dari github
- Melakukan troubleshoot ketika terdapat error di pipeline

### Testdrive website
- Dapatkan link dari halaman azure web app services di bagian overview
- Coba buka di browser
- Jalankan web apps
- Apabila error cek log di konsol , kudu atau log web app services dan jenkins untuk troubleshooting dan debugging

### Monitor With Grafana
- Buat Azure Managed Grafana
- Buat grafik metric sesuai keinginan
- Pin ke dashboard

### Links
- Github Repository "https://github.com/NurGhulam04/fp-pso"
- Web Apps "https://perpusgul.azurewebsites.net"
- Documentation "https://its.id/m/DokumentasiPerpusgul"
- Powerpoint "https://its.id/m/PPTPerpusgul"

## Quick Start 
clone the repo

    git clone https://github.com/tauseedzaman/Laravel-libraray-management-system

change current directory

    cd Laravel-libraray-management-system

install dependencies

    composer install

install js dependencies

    npm install && npm run dev

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
