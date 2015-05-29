<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class EditGroupForm extends FormValidator{
        protected $rules = [
          'group_id' => 'required|exists:groups,id',
          'name' => 'required|max:128',
          'teams_ids' => 'required'
     ];
}
