<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegistrarPosicionForm extends FormValidator{

        protected $rules = [
          'nombre' => 'required|max:128',
          'abreviacion' => 'required|max:20'
     ];

}