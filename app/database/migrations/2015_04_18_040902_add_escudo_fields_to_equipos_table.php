<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddEscudoFieldsToEquiposTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('equipos', function(Blueprint $table) {     
            
            $table->string('escudo_file_name')->nullable();
            $table->integer('escudo_file_size')->nullable();
            $table->string('escudo_content_type')->nullable();
            $table->timestamp('escudo_updated_at')->nullable();

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipos', function(Blueprint $table) {

            $table->dropColumn('escudo_file_name');
            $table->dropColumn('escudo_file_size');
            $table->dropColumn('escudo_content_type');
            $table->dropColumn('escudo_updated_at');

        });
    }

}
