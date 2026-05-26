<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id(); // Khóa chính
        $table->string('name'); // Tên sản phẩm
        $table->integer('price'); // Giá sản phẩm
        
        // Tạo khóa ngoại nối với bảng categories
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
