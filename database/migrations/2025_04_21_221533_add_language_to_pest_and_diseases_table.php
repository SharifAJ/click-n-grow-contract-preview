<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pest_and_diseases', function (Blueprint $table) {
            $table->string('language', 5)->default('en')->after('farm_id')->index();
        });
    }

    public function down(): void
    {
        Schema::table('pest_and_diseases', function (Blueprint $table) {
            $table->dropColumn('language');
        });
    }
};
