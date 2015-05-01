<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegistrarJugadorForm extends FormValidator{
        protected $rules = [
          'nombre' => 'required|max:128',
          'apodo' => 'max:128',
          'fecha_nacimiento' => 'date_format:Y-m-d', 
          'lugar_nacimiento' =>'max:512',
          'altura' => 'numeric',
          'peso' =>'numeric',
          'posiciones_id' => 'required',
          'posicion_id' => 'required|exists:posiciones,id',
          'pais_id' => 'required|exists:paises,id',
          'foto' =>'image',
          'historia' => 'max:512',
          //'info_url' => 'url' ,
          //'facebook_url' => 'url',
          //'twitter_url' =>'url' 
     ];
}
