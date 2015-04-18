<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFotoFieldsToEquiposTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('equipos', function(Blueprint $table) {     
            
            $table->string('foto_file_name')->nullable();
            $table->integer('foto_file_size')->nullable();
            $table->string('foto_content_type')->nullable();
            $table->timestamp('foto_updated_at')->nullable();

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

            $table->dropColumn('foto_file_name');
            $table->dropColumn('foto_file_size');
            $table->dropColumn('foto_content_type');
            $table->dropColumn('foto_updated_at');

        });
    }

}
