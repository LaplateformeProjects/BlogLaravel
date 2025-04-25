<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            // n’ajoute la colonne que si elle n’existe pas
            if (! Schema::hasColumn('articles', 'user_id')) {
                $table->foreignId('user_id')
                      ->nullable()
                      ->constrained()
                      ->onDelete('set null');
            }

            if (! Schema::hasColumn('articles', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }

            if (Schema::hasColumn('articles', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};

