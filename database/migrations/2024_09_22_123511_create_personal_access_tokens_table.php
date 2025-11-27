<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalAccessTokensTable extends Migration
{
    public function up()
    {
    //     Schema::create('personal_access_tokens', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('name',10);
    //         $table->string('tokenable_type', 64); // Limiter à 191 caractères
    //         $table->foreignId('tokenable_id',64);
    //         $table->string('token', 64)->unique(); // Assure que le token est unique
    //         $table->text('abilities')->nullable(); // Peut contenir des informations supplémentaires
    //         $table->timestamps();

    //         // Crée l'index sur tokenable_type et tokenable_id
    //         $table->index(['tokenable_type', 'tokenable_id']);
    //     });
    }

    public function down()
    {
        Schema::dropIfExists('personal_access_tokens');
    }
}



