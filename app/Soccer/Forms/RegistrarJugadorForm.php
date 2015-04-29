<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegistrarJugadorForm extends FormValidator{
        protected $rules = [
          'nombre' => 'required|max:128',
          'fecha_nacimiento' => 'date_format:d-m-Y', 
          'altura' => 'numeric',
          'peso' =>'numeric',
          'apodo' => 'max:128',
          'posicion_id' => 'required|exists:posiciones,id',
          'pais_id' => 'required|exists:paises,id',
          'foto' =>'image'
     ];
}
