<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentController;

// صفحة الطالب - عرض سؤال
Route::get('/', [StudentController::class, 'show'])->name('student.show');

// تسجيل إجابة الطالب
Route::post('/student/record', [StudentController::class, 'record'])->name('student.record');

Route::middleware(['auth', 'verified'])->group(function () {
    // لوحة التحكم - إحصائيات + جدول الأسئلة
    Route::get('/dashboard', [QuestionController::class, 'index'])->name('dashboard');

    // إدارة الأسئلة (إضافة - تعديل - حذف)
    Route::resource('questions', QuestionController::class)->except('show');

    // ملف المستخدم
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
