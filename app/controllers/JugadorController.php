<?php

use soccer\Jugador\JugadorRepository;
use soccer\Forms\RegistrarJugadorForm;
use soccer\Forms\EditarJugadorForm;
use Laracasts\Validation\FormValidationException;


class JugadorController extends \BaseController {

	protected $repository;
	protected $registrarJugadorForm;
	protected $editarJugadorForm;

	public function __construct(JugadorRepository $repository,
			RegistrarJugadorForm $registrarJugadorForm,
			EditarJugadorForm $editarJugadorForm){

		$this->repository = $repository;
		$this->registrarJugadorForm = $registrarJugadorForm;
		$this->editarJugadorForm = $editarJugadorForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = $this->repository->getAllTable();
		return View::make('jugadores.index', compact('jugadoresTable','table'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->registrarJugadorForm->validate($input);
				$jugador = $this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('jugador', $jugador->toArray());
				return $this->getResponseArrayJson();				
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(true);
				$this->addToResponseArray('errores', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$jugador = $this->repository->get($id);
		return View::make('jugadores.show', compact('jugador'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editarJugadorForm->validate($input);
				$this->repository->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('jugador', $jugador);
				$this->addToResponseArray('equipo', $jugador->getEquipoAttribute()->toArray());
				return $this->getResponseArrayJson();					
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(true);
				$this->addToResponseArray('errores', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
	}



	/*
	************************** API METHODS *****************************
	*/

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('idPlayer')));
		return $this->getResponseArrayJson();
	}

	public function listaApi()
	{
		return $this->repository->getDefaultTableForAll();
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('jugadorId'))
			{
				$jugador = $this->repository->get(Input::get('jugadorId'));
				$this->setSuccess(true);
				$this->addToResponseArray('jugador', $jugador->toArray());
				$this->addToResponseArray('urlImg',  $jugador->foto->url('thumb'));
				$this->addToResponseArray('equipo', $jugador->getEquipoAttribute()->toArray());
				$this->addToResponseArray('posicion',  $jugador->posicion->toArray());
				$this->addToResponseArray('pais',   $jugador->pais->toArray());
				$this->addToResponseArray('fechaNacimiento', date("d-m-Y",strtotime($jugador->fecha_nacimiento)));
				$this->addToResponseArray('fechaInicio', date("d-m-Y",strtotime( $jugador->getEquipoAttribute()->pivot->fecha_inicio)));
				$this->addToResponseArray('fechaFin', date("d-m-Y",strtotime($jugador->getEquipoAttribute()->pivot->fecha_fin)));
				return $this->getResponseArrayJson();
			}else{
				$this->setSuccess(false);
				return $this->getResponseArrayJson();
			}
		}
	}

	public function cambiarEquipoApi($id)
	{
		
	}

	public function getAllValue()
	{
		if(Request::ajax())
		{
			$jugadores = $this->repository->getAllForSelect();
			if (count($jugadores) > 0) {
				$this->setSuccess(true);
				$this->addToResponseArray('data', $jugadores);
				return $this->getResponseArrayJson();
			}else{
				$this->setSuccess(false);
				return $this->getResponseArrayJson();
			}
		}else{
			$this->setSuccess(false);
			return $this->getResponseArrayJson();
		}
	}

}
