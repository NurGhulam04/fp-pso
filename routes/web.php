<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\AutherController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookIssueController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
// Impor ini ditambahkan dari branch 'update', kemungkinan untuk rute '/metrics'
use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;
use App\Http\Controllers\MetricsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rute root (/) akan langsung menampilkan dashboard
// Middleware 'guest' dihapus karena kita ingin langsung masuk
Route::get('/', [dashboardController::class, 'index'])->name('dashboard_root');

// Jika Anda tidak ingin ada form login sama sekali, komentari atau hapus rute ini
// Route::post('/', [LoginController::class, 'login'])->name('login');

// Jika Anda masih ingin tombol logout berfungsi, biarkan rute ini,
// tapi ingat ia tidak akan mengautentikasi pengguna jika tidak ada login
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Semua rute berikut sekarang akan dapat diakses TANPA LOGIN,
// mengikuti logika dari branch 'update' yang menghapus grup middleware 'auth'.

Route::get('change-password',[dashboardController::class,'change_password_view'])->name('change_password_view');
Route::post('change-password',[dashboardController::class,'change_password'])->name('change_password');
Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

// author CRUD
Route::get('/authors', [AutherController::class, 'index'])->name('authors');
Route::get('/authors/create', [AutherController::class, 'create'])->name('authors.create');
Route::get('/authors/edit/{auther}', [AutherController::class, 'edit'])->name('authors.edit');
Route::post('/authors/update/{id}', [AutherController::class, 'update'])->name('authors.update');
Route::post('/authors/delete/{id}', [AutherController::class, 'destroy'])->name('authors.destroy');
Route::post('/authors/create', [AutherController::class, 'store'])->name('authors.store');

// publisher crud
Route::get('/publishers', [PublisherController::class, 'index'])->name('publishers');
Route::get('/publisher/create', [PublisherController::class, 'create'])->name('publisher.create');
Route::get('/publisher/edit/{publisher}', [PublisherController::class, 'edit'])->name('publisher.edit');
Route::post('/publisher/update/{id}', [PublisherController::class, 'update'])->name('publisher.update');
Route::post('/publisher/delete/{id}', [PublisherController::class, 'destroy'])->name('publisher.destroy');
Route::post('/publisher/create', [PublisherController::class, 'store'])->name('publisher.store');

// Category CRUD
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::post('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');

// books CRUD
Route::get('/books', [BookController::class, 'index'])->name('books');
Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
Route::get('/book/edit/{book}', [BookController::class, 'edit'])->name('book.edit');
Route::post('/book/update/{id}', [BookController::class, 'update'])->name('book.update');
Route::post('/book/delete/{id}', [BookController::class, 'destroy'])->name('book.destroy');
Route::post('/book/create', [BookController::class, 'store'])->name('book.store');

// students CRUD
Route::get('/students', [StudentController::class, 'index'])->name('students');
Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
Route::get('/student/edit/{student}', [StudentController::class, 'edit'])->name('student.edit');
Route::post('/student/update/{id}', [StudentController::class, 'update'])->name('student.update');
Route::post('/student/delete/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
Route::post('/student/create', [StudentController::class, 'store'])->name('student.store');
Route::get('/student/show/{id}', [StudentController::class, 'show'])->name('student.show');

// book_issue CRUD
Route::get('/book_issue', [BookIssueController::class, 'index'])->name('book_issued');
Route::get('/book-issue/create', [BookIssueController::class, 'create'])->name('book_issue.create');
Route::get('/book-issue/edit/{id}', [BookIssueController::class, 'edit'])->name('book_issue.edit');
Route::post('/book-issue/update/{id}', [BookIssueController::class, 'update'])->name('book_issue.update');
Route::post('/book-issue/delete/{id}', [BookIssueController::class, 'destroy'])->name('book_issue.destroy');
Route::post('/book-issue/create', [BookIssueController::class, 'store'])->name('book_issue.store');

// reports
Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
Route::get('/reports/Date-Wise', [ReportsController::class, 'date_wise'])->name('reports.date_wise');
Route::post('/reports/Date-Wise', [ReportsController::class, 'generate_date_wise_report'])->name('reports.date_wise_generate');
Route::get('/reports/monthly-Wise', [ReportsController::class, 'month_wise'])->name('reports.month_wise');
Route::post('/reports/monthly-Wise', [ReportsController::class, 'generate_month_wise_report'])->name('reports.month_wise_generate');
Route::get('/reports/not-returned', [ReportsController::class, 'not_returned'])->name('reports.not_returned');

// settings
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::post('/settings', [SettingsController::class, 'update'])->name('settings');

//route monitoring (dari branch 'update')
Route::get('/metrics', [MetricsController::class, 'metrics']);

Route::post('/reports/date-wise/export', [App\Http\Controllers\ReportsController::class, 'export_date_wise'])->name('reports.date_wise_export');
Route::post('/report/month-wise/export', [ReportsController::class, 'export_month_wise'])->name('reports.month_wise_export');
Route::post('/reports/not-returned/export', [ReportsController::class, 'exportNotReturnedBooks'])->name('reports.not_returned_export');

// Rute '/Change-password' yang dikomentari dari branch 'main' tidak dimasukkan
// karena sudah ada rute 'change-password' yang aktif dari branch 'update'.
// Route::post('/Change-password', [LoginController::class, 'changePassword'])->name('change_password');

// Grup middleware 'auth' dari branch 'main' tidak digunakan di sini,
// karena branch 'update' secara eksplisit meminta untuk menghapusnya atau memindahkan rute keluar darinya.
/*
Route::middleware('auth')->group(function () {
    // Rute-rute yang tadinya ada di sini (dari branch 'main')
    // sekarang berada di luar grup, mengikuti struktur dari branch 'update'.
});
*/
