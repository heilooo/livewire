<?php

use App\Livewire\Course;
use App\Livewire\Courses;
use App\Livewire\CreateCourse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/courses', Courses::class)->name('courses');
Route::get('/courses/create', CreateCourse::class)->name('courses.create');
Route::get('/courses/show/{course}', Course::class)->name('courses.show');