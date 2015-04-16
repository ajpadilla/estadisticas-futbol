<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegistrarPaisForm extends FormValidator{
        protected $rules = [
          'nombre' => 'required|max:128',
          'bandera' => 'required|max:128', 
     ];
}
