<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class EquipoForm extends FormValidator{
        protected $rules = [
          'nombre' 	=> 'required|max:128',
          'bandera' => 'min:2|max:128',
          'escudo' 	=> 'min:2|max:128',
          'tipo' 	=> 'required|in:club,selección',
          'fecha_fundacion' => 'required|date_format:d-m-Y', 
          'apodo' 	=> 'min:2|max:128',
          'ubicacion' 	=> 'min:2|max:512',
          'pais_id' => 'required|exists:paises,id'
     ];
}