<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class EditGameForm extends FormValidator{
        protected $rules = [
        	'game_id' => 'required|exists:games,id',
         	'date' => 'required',
         	'type_id' => 'required|exists:game_types,id'
     ];
}
