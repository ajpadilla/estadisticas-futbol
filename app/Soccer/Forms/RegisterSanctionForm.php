<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterSanctionForm extends FormValidator{
        protected $rules = [
          'observations' => 'max:256',
          'minute' => 'required|max:3',
          'second' => 'required|max:2',
          'type_id' => 'required|exists:sanction_types,id',
          'game_id' => 'required|exists:games,id',
          'team_id' => 'required|exists:equipos,id',
          'player_id' => 'required|exists:players,id',
     ];
}
