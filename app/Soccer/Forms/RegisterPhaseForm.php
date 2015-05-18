<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterPhaseForm extends FormValidator{
        protected $rules = [
          'name' => 'required|max:128',
          'from' => 'date_format:Y-m-d', 
          'to' =>'date_format:Y-m-d',
          'competition_id' => 'required|numeric|exists:competitions,id',
          'format_id' =>'required|numeric|exists:competition_formats,id' ,
     ];
}
