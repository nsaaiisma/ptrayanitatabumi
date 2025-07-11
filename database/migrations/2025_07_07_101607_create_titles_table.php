<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('title', function (Blueprint $table) {
            $table->id();
            $table->string('captionProduct');
            $table->text('descriptionProduct')->nullable();
            $table->string('captionPortofolio');
            $table->text('descriptionPortofolio')->nullable();
            $table->string('captionAboutMe');
            $table->text('descriptionAboutMe')->nullable();
            $table->text('owner_image')->nullable();
            $table->text('owner_description')->nullable();
            $table->string('captionTestimoni');
            $table->text('descriptionTestimoni')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('title');
    }
};
