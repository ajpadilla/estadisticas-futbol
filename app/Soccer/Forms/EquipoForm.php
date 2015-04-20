<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class EquipoForm extends FormValidator{
        protected $rules = [
          'nombre' => 'required|max:128',
          'foto' => 'image',
          'bandera' => 'image',
          'escudo' => 'image',
          'tipo' => 'required',
          'fecha_fundacion' => 'required|date_format:d-m-Y', 
          'apodo' => 'min:2|max:128',
          'ubicacion' => 'min:2|max:512',
          'historia' => 'min:2|max:512',
          'info_url' =>'min:2|max:128',
          'pais_id' => 'required|exists:paises,id'
     ];
}