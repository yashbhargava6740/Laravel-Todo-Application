<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompletedToTodosTable extends Migration
{
    public function up(): void
    {
        Schema::table('todo', function (Blueprint $table) {
            $table->boolean('completed')->default(false)->after('image_url');
        });
    }

    public function down(): void
    {
        Schema::table('todo', function (Blueprint $table) {
            $table->dropColumn('completed');
        });
    }
}
