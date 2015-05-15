<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterGroupForm extends FormValidator{
        protected $rules = [
          'name' => 'required|max:128',
          'competition_id' => 'required|exists:competitions,id',
          'teams_ids' => 'required'
     ];
}
