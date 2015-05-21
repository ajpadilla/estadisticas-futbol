<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegisterChangeForm extends FormValidator{
	protected $rules = [
	'observations' => 'max:256',
	'minute' => 'required|max:3',
	'second' => 'required|max:2',
	'game_id' => 'required|exists:games,id',
	'team_id' => 'required|exists:equipos,id',
	'player_out_id' => 'required|exists:players,id',
	'player_in_id' => 'required|exists:players,id'
	];
}
