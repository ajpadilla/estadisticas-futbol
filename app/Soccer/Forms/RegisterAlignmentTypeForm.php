<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterAlignmentTypeForm extends FormValidator{
        protected $rules = [
          'name' => 'required|max:128',
     ];
}