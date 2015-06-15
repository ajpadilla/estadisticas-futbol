<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class EditCompetitionForm extends FormValidator{
        protected $rules = [
          'competition_id' => 'required|exists:competitions,id',
          'nombre' => 'required|max:128',
          'desde' => 'required|date_format:Y-m-d', 
          'hasta' =>'required|date_format:Y-m-d',
          'internacional' => 'boolean',
          'country_id' =>'numeric|exists:paises,id',
          'tipo_competencia_id' => 'required|exists:tipo_competencias,id',
          'imagen' =>'image'
     ];
}