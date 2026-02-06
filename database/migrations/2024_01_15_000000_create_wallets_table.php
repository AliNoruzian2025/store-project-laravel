<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('balance', 15, 0)->default(0);
            $table->timestamps();
            
            $table->index('user_id');
        });
        
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['deposit', 'withdraw', 'purchase', 'refund']);
            $table->decimal('amount', 15, 0);
            $table->string('description')->nullable();
            $table->string('tracking_code')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled'])->default('pending');
            $table->json('meta')->nullable();
            $table->timestamps();
            
            $table->index('type');
            $table->index('status');
            $table->index('tracking_code');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallet_transactions');
        Schema::dropIfExists('wallets');
    }
};
