<?php
/*
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCompetenciasRelationsToTipoCompetenciasTable extends Migration {


    public function up()
    {   
        Schema::table('tipo_competencias', function(Blueprint $table) {     
            
            $table->integer('competencia_ascenso_id')->nullable();
			$table->integer('competencia_ascenso_id')->unsigned()->nullable()->after('competencia_id');	

        });

    }


    public function down()
    {
        Schema::table('equipos', function(Blueprint $table) {

            $table->dropColumn('foto_file_name');
            $table->dropColumn('foto_file_size');
            $table->dropColumn('foto_content_type');
            $table->dropColumn('foto_updated_at');

        });
    }

}*/
