<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class EditarPaisForm extends FormValidator{
        protected $rules = [
          'nombre' => 'required|max:128',
          'bandera' => 'required|max:128', 
     ];
}
