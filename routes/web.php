<?php

    use App\Http\Controllers\UserController;
    use App\Http\Controllers\NoteController;
    use App\Http\Controllers\AnnonceController;
    use App\Http\Controllers\ContactController;
    use App\Http\Controllers\CategorieController;
    use App\Http\Controllers\TransactionController;
    use App\Http\Controllers\SousCategorieController;
    use App\Http\Controllers\WelcomeController;
    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;


    // =====================================================
    // |        📂📂 Routes Simples - Page Vitrine        |
    // =====================================================
    Route::get('/', [WelcomeController::class, 'index'])->name('home');

    Route::view('/contact', 'pages/vitrine/contact')->name("contact");
    Route::view('/homeVitrine', 'pages/vitrine/home')->name("homeVitrine");

    // =====================================================
    // |        📂📂 Routes Resource - Page Admin        |
    // =====================================================
    Route::resource('annonce', AnnonceController::class);
    Route::resource('categorie', CategorieController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('note', NoteController::class);
    Route::resource('sousCategorie', SousCategorieController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('user', UserController::class);


    // =====================================================
    // |        📂📂 Routes Authentification            |
    // =====================================================
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
