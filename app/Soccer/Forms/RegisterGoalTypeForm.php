<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterGoalTypeForm extends FormValidator{
        protected $rules = [
          'name' => 'required|max:128',
     ];
}