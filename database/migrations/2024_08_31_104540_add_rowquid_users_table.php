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
        Schema::table('users', function (Blueprint $table) {
            $table->text('rowquid')->nullable()->after('times_recuperacion');
        });


        $usuarios = \App\Models\User::all();
        foreach ($usuarios as $user){
            $usuario = \App\Models\User::find($user->id);
            $usuario->rowquid = generarStringAleatorio(16);
            $usuario->save();
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            //
        });
    }
};
