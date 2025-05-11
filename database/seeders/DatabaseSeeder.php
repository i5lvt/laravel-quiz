<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // إنشاء مستخدم حقيقي لتسجيل الدخول
        User::create([
            'name' => 'عبدالله الحربي',
            'email' => 'abaf44828@gmail.com',
            'password' => bcrypt('abaf3343051'), // تأكد تستخدم كلمة مرور قوية
        ]);
    }
}
