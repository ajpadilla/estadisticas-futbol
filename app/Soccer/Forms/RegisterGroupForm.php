<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterGroupForm extends FormValidator{
        protected $rules = [
          'name' => 'required|max:128',
          'phase_id' => 'required|exists:phases,id',
          'teams_ids' => 'required'
     ];
}
