<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegistrarJugadorForm extends FormValidator{
        protected $rules = [
          'nombre' => 'required|max:128',
          'fecha_nacimiento' => 'required|date_format:d-m-Y', 
          'altura' => 'required|numeric',
          'abreviacion' => 'required|max:20',
          'posicion_id' => 'required|integer',
          'pais_id' => 'required|integer'
     ];
}
