<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // In migration file
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->json('included_services')->nullable()->after('subscribable_type');
            // $table->index(['included_services'], 'included_services_index'); // Uncomment this if there are more than 10,000 entries are there in the table
        });
    }

    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('included_services');
            $table->dropIndex('included_services_index');
        });
    }
};
