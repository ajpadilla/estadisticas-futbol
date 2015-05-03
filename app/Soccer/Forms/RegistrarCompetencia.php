<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegistrarCompetencia extends FormValidator{
        protected $rules = [
          'nombre' => 'required|max:128',
          'desde' => 'required|date_format:Y-m-d', 
          'hasta' =>'required|date_format:Y-m-d',
          'internacional' => 'boolean',
          'pais_id' =>'numeric' ,
          'tipo_competencia_id' => 'required|exists:tipo_competencias,id',
          'imagen' =>'image'
     ];
}
