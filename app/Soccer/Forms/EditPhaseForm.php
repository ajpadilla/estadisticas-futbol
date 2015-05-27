<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class EditPhaseForm extends FormValidator{
        protected $rules = [
          'name' => 'required|max:128',
          'from' => 'date_format:Y-m-d', 
          'to' =>'date_format:Y-m-d',
     ];
}
