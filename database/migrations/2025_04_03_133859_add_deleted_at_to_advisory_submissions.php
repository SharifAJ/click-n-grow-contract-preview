<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('advisory_submissions', function (Blueprint $table) {
            $table->softDeletes(); // Adds a "deleted_at" column
        });
    }

    public function down()
    {
        Schema::table('advisory_submissions', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Removes the "deleted_at" column
        });
    }
};
