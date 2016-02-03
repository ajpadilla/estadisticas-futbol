<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterCompetition extends FormValidator{
        protected $rules = [
          'nombre' => 'required|max:128',
          'type' => 'required',
          'desde' => 'required|date_format:Y-m-d', 
          'hasta' =>'required|date_format:Y-m-d',
          'internacional' => 'boolean',
          'country_id' =>'numeric|exists:paises,id',
          'competition_format_id' => 'required|exists:competition_formats,id',
          'imagen' =>'image'
     ];
}
