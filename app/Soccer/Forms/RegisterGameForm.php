<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterGameForm extends FormValidator{
        protected $rules = [
          'date' => 'date',
          'local_team_id' => 'required|exists:equipos,id',
          'away_team_id' => 'required|exists:equipos,id',
          'type_id' => 'required|exists:game_types,id',
          'stadium' => 'between:2,128',
          'main_referee' => 'between:2,128',
          'line_referee' => 'between:2,128'
          //'info_url' => 'url' ,
          //'facebook_url' => 'url',
          //'twitter_url' =>'url' 
     ];
}