<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddBanderaFieldsToEquiposTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('equipos', function(Blueprint $table) {     
            
            $table->string('bandera_file_name')->nullable();
            $table->integer('bandera_file_size')->nullable();
            $table->string('bandera_content_type')->nullable();
            $table->timestamp('bandera_updated_at')->nullable();

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

            $table->dropColumn('bandera_file_name');
            $table->dropColumn('bandera_file_size');
            $table->dropColumn('bandera_content_type');
            $table->dropColumn('bandera_updated_at');

        });
    }

}
