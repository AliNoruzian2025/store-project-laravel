<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            // مرحله اول: فقط شماره موبایل (اجباری)
            $table->string('mobile')->unique();
            
            // مرحله دوم: نام و نام خانوادگی و رمز عبور (اجباری)
            $table->string('first_name'); // نام
            $table->string('last_name');  // نام خانوادگی
            $table->string('password');
            
            // مرحله بعدی: آدرس و کدپستی (اختیاری - بعداً تکمیل می‌شود)
            $table->text('address')->nullable();
            $table->string('postal_code', 10)->nullable();
            
            // فیلدهای سیستم
            $table->string('role')->default('user');
            $table->rememberToken();
            $table->timestamps();
            
            // ایندکس‌ها
            $table->index('mobile');
            $table->index('role');
        });
        
        // ایجاد کاربر ادمین اولیه
        $this->createAdminUser();
    }
    
    private function createAdminUser(): void
    {
        if (DB::table('users')->count() === 0) {
            DB::table('users')->insert([
                'mobile' => '09123456789',
                'first_name' => 'مدیر',
                'last_name' => 'سیستم',
                'password' => bcrypt('Admin@123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};