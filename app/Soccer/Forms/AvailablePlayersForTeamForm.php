<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class AvailablePlayersForTeamForm extends FormValidator{
        protected $rules = [
          'id' => 'required|exists:games,id',
          'teamId' => 'required|exists:equipos,id', 
     ];
}