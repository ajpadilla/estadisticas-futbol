<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddImagenFieldsToCompetenciasTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('competencias', function(Blueprint $table) {     
            
            $table->string('imagen_file_name')->nullable();
            $table->integer('imagen_file_size')->nullable();
            $table->string('imagen_content_type')->nullable();
            $table->timestamp('imagen_updated_at')->nullable();

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competencias', function(Blueprint $table) {

            $table->dropColumn('imagen_file_name');
            $table->dropColumn('imagen_file_size');
            $table->dropColumn('imagen_content_type');
            $table->dropColumn('imagen_updated_at');

        });
    }

}
