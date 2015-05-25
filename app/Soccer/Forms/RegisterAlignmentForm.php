<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterAlignmentForm extends FormValidator{
        protected $rules = [
          'observations' => 'max:256',
          'game_id' => 'required|exists:games,id',
          'team_id' => 'required|exists:equipos,id',
          'player_id' => 'required|exists:players,id',
          'position_id' => 'required|exists:posiciones,id',
          'type_id' => 'required|exists:alignment_types,id',
     ];
}