<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class EditarEquipoForm extends FormValidator{
        protected $rules = [
          'nombre' => 'required|max:128',
          'foto' => 'image',
          'bandera' => 'image',
          'escudo' => 'image',
          'tipo' => 'required',
          'fecha_fundacion' => 'date_format:Y-m-d', 
          'apodo' => 'min:2|max:128',
          'ubicacion' => 'min:2|max:512',
          'historia' => 'min:2|max:512',
          'info_url' =>'min:2|max:128!active_url',
          'pais_id' => 'required|exists:paises,id'
     ];
}