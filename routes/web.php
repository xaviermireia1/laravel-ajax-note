<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
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

/* Display a listing of the resource. */
//Vista
Route::get('/notes',[NoteController::class,'index'])->name('notes.index');
Route::post('/notes/shows',[NoteController::class,'shows'])->name('notes.shows');
//Crear
Route::post('/notes',[NoteController::class,'store'])->name('notes.store');
//Eliminar
Route::delete('/notes/{note}',[NoteController::class,'destroy'])->name('notes.destroy');