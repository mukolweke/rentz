<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * is active will be used to know if user is current occupant of a unit
         *
         * unit cannot have more than one occupant
         */
        Schema::table('tenants', function (Blueprint $table) {
            $table->boolean('is_active')->after('phone')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
