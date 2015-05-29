<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterCompetitionFormatForm extends FormValidator{
        protected $rules = [
          'name' => 'required|max:128',
          'groups' => 'required|numeric', 
          'clasificated_by_group' =>'required|numeric',
          'local_away_game' => 'boolean',
          'local_away_game_final' =>'boolean' ,
          'away_goal' => 'boolean',
          'teams_by_group' => 'required|numeric',
          'promotion' => 'required|numeric',
          'descent' => 'required|numeric',
     ];
}
