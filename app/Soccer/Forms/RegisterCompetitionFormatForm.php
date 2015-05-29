<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterCompetitionFormatForm extends FormValidator{
        protected $rules = [
          'name' => 'required|max:128',
          'groups' => 'numeric|digits_between:1,6', 
          'clasificated_by_group' =>'numeric|digits_between:1,6',
          'local_away_game' => 'boolean',
          'local_away_game_final' =>'boolean' ,
          'away_goal' => 'boolean',
          'teams_by_group' => 'numeric|digits_between:1,6',
          'promotion' => 'numeric|digits_between:1,6',
          'descent' => 'numeric|digits_between:1,6',
     ];
}
