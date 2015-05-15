<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterTeamGroupForm extends FormValidator{
        protected $rules = [
          'group_id' => 'required|numeric|exists:groups,id',
          'teams_ids' => 'required'
     ];
}
