<?php

use App\Livewire\ShowCourse;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/courses/{id}', ShowCourse::class);