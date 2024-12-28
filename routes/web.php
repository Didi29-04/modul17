<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FileController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use GuzzleHttp\Middleware;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('home', function () {
//     return redirect()->route('login');
// })->name('home');

Route::get('/', function () {
    $pageTitle = 'Welcome';
    return view('welcome', compact('pageTitle'));
})->name('welcome');

// Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('default', [HomeController::class, 'index'])->Middleware('auth')->name('default');
Route::get('profile', ProfileController::class)->middleware('auth')->name('profile');
Route::resource('employees', EmployeeController::class)->middleware('auth');
Route::get('getEmployees', [EmployeeController::class, 'getData'])->name('employees.getData');
Route::get('exportExcel', [EmployeeController::class, 'exportExcel'])->name('employees.exportExcel');
Route::get('exportPdf', [EmployeeController::class, 'exportPdf'])->name('employees.exportPdf');

// Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
// routes/web.php

// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//local dan public disk
Route::get('/local-disk', function() {
    Storage::disk('local')->put('local-example.txt', 'This is local example content');
    return asset('storage/local-example.txt');
});

Route::get('/public-disk', function() {
    Storage::disk('public')->put('public-example.txt', 'This is public example content');
    return asset('storage/public-example.txt');
});


// local dan public isi file
Route::get('/retrieve-local-file', function() {
    if (Storage::disk('local')->exists('local-example.txt')) {
        $contents = Storage::disk('local')->get('local-example.txt');
    } else {
        $contents = 'File does not exist';
    }

    return $contents;
});

Route::get('/retrieve-public-file', function() {
    if (Storage::disk('public')->exists('public-example.txt')) {
        $contents = Storage::disk('public')->get('public-example.txt');
    } else {
        $contents = 'File does not exist';
    }

    return $contents;
});

// local dan public download file
Route::get('/download-local-file', function() {
    return Storage::download('local-example.txt', 'local file');
});

// Route::get('/download-public-file', function() {
//     return Storage::disk('public')->download('public-example.txt', 'public file');
// });

Route::get('/download-public-file', function() {
    return Storage::download('public/public-example.txt', 'public file');
});


// path, URL, size
Route::get('/file-url', function() {
    // Just prepend "/storage" to the given path and return a relative URL
    $url = Storage::url('local-example.txt');
    return $url;
});

Route::get('/file-size', function() {
    $size = Storage::size('local-example.txt');
    return $size;
});

Route::get('/file-path', function() {
    $path = Storage::path('local-example.txt');
    return $path;
});

// menyimpan file form
Route::get('/upload-example', function() {
    return view('upload_example');
});

Route::post('/upload-example', function(Request $request) {
    $path = $request->file('avatar')->store('public');
    return $path;
})->name('upload-example');

//menghapus file
Route::get('/delete-local-file', function(Request $request) {
    Storage::disk('local')->delete('local-example.txt');
    return 'Deleted';
});

Route::get('/delete-public-file', function(Request $request) {
    Storage::disk('public')->delete('public-example.txt');
    return 'Deleted';
});

// download file employee
Route::get('download-file/{employeeId}', [EmployeeController::class,'downloadFile'])->name('employees.downloadFile');

// Delete
Route::delete('/employees/{employeeId}/deleteFile', [EmployeeController::class, 'deleteFile'])->name('employees.deleteFile');

Route::get('getEmployees', [EmployeeController::class, 'getData'])->name('employees.getData');

