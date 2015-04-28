<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class EditarPosicionForm extends FormValidator{

        protected $rules = [
          'nombre' => 'required|max:128',
          'abreviacion' => 'required|max:20'
     ];

}