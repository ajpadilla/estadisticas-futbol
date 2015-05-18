<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterGameForm extends FormValidator{
        protected $rules = [
          'date' => 'required',
          'local_team_id' => 'required|exists:equipos,id',
          'away_team_id' => 'required|exists:equipos,id',
          'type_id' => 'required|exists:game_types,id',
          'stadium' => 'between:2,128',
          'main_referee' => 'between:2,128',
          'line_referee' => 'between:2,128'
     ];
}
