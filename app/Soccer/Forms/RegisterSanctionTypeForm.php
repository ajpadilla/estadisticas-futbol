<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterSanctionTypeForm extends FormValidator{
        protected $rules = [
          'name' => 'required|max:128',
     ];
}