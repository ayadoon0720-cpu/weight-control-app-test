<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeightColumnsToUsersTable extends Migration
{
    public function up(): void
    {
      Schema::table('users', function (Blueprint $table) {
        $table->decimal('current_weight', 5, 1)->nullable();
        $table->decimal('target_weight', 5, 1)->nullable();
      });
    }

    public function down(): void
    {
       Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['current_weight', 'target_weight']);
       });
    }
}
