<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Redirección según rol después de iniciar sesión
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->hasRole('superadmin') || $user->hasRole('admin')) {
        return view('selector'); // Vista con botones
    }

    if ($user->hasRole('usuario')) {
        return redirect()->route('books.index'); // Solo libros
    }

    abort(403); // Si no tiene rol asignado
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de perfil (editar, actualizar, eliminar)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ LIBROS
// Todos los roles pueden ver (index)
Route::middleware('auth')->get('/books', [BookController::class, 'index'])->name('books.index');

// Solo admin y superadmin pueden crear, editar y eliminar
Route::middleware(['auth', 'role:admin|superadmin'])->group(function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});

// 👑 AUTORES
// Solo admin y superadmin
Route::middleware(['auth', 'role:admin|superadmin'])->resource('authors', AuthorController::class);

require __DIR__.'/auth.php';
