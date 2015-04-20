<?php namespace soccer\Forms;

use Laracasts\Validation\FormValidator;

class EditarJugadorForm extends FormValidator{
        protected $rules = [
          'nombre' => 'required|max:128',
          'fecha_nacimiento' => 'required|date_format:d-m-Y', 
          'altura' => 'required|numeric',
          'peso' =>'required|numeric',
          'apodo' => 'required|max:128',
          'posicion_id' => 'required|exists:posiciones,id',
          'pais_id' => 'required|exists:paises,id',
          'numero' =>'required|numeric',
          'fecha_inicio' => 'required|date_format:d-m-Y',
          'fecha_fin' => 'date_format:d-m-Y',
          'equipo_id' => 'required|exists:equipos,id',
          'foto' =>'image'
     ];
}