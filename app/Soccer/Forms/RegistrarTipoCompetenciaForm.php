<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegistrarTipoCompetenciaForm extends FormValidator{

	protected $rules = [ 
		'nombre' => 'required|max:128',
		'grupos' => 'required|numeric|digits_between:1,6',
		'fases_eliminatorias' => 'required|numeric|digits_between:1,6',
		'ida_vuelta'=> 'required|boolean',
		'pre_clasificacion' => 'required|boolean',
		'equipos_por_grupo' => 'required|numeric|digits_between:1,6',
		'ascenso' => 'required|numeric|digits_between:1,6',
		'descenso' => 'required|numeric|digits_between:1,6',
		'clasificados_por_grupo' => 'required|numeric|digits_between:1,6'
	];



}