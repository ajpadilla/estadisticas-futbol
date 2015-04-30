<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class RegistrarTipoCompetenciaForm extends FormValidator{

	protected $rules = [ 
		'nombre' => 'required|max:128',
		'grupos' => 'numeric|digits_between:1,6',
		'fases_eliminatorias' => 'numeric|digits_between:1,6',
		'ida_vuelta'=> 'boolean',
		'pre_clasificacion' => 'boolean',
		'equipos_por_grupo' => 'numeric|digits_between:1,6',
		'ascenso' => 'numeric|digits_between:1,6',
		'descenso' => 'numeric|digits_between:1,6',
		'clasificados_por_grupo' => 'numeric|digits_between:1,6'
	];

}