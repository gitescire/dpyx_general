<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRepositoryStatusColumnToEvaluationsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluations_history', function (Blueprint $table) {
            $table->enum('repository_status',['en progreso','aprobado', 'rechazado','observaciones'])->default('en progreso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluations_history', function (Blueprint $table) {
            $table->dropColumn('repository_status');
        });
    }
}
