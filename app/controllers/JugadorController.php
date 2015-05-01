<?php

use soccer\Jugador\JugadorRepository;
use soccer\Equipo\EquipoRepository;
use soccer\Forms\RegistrarJugadorForm;
use soccer\Forms\EditarJugadorForm;
use Laracasts\Validation\FormValidationException;


class JugadorController extends \BaseController {

	protected $repository;
	protected $equipoRepository;
	protected $registrarJugadorForm;
	protected $editarJugadorForm;

	public function __construct(JugadorRepository $repository,
			EquipoRepository $equipoRepository,
			RegistrarJugadorForm $registrarJugadorForm,
			EditarJugadorForm $editarJugadorForm){
		$this->repository = $repository;
		$this->equipoRepository = $equipoRepository;
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
		$this->breadcrumbs->addCrumb('Jugadores', route('jugadores.index'));
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
				//$this->addToResponseArray('jugador', $jugador);
				$this->addToResponseArray('data', $input);
				return $this->getResponseArrayJson();				
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(false);
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
		$equipos = $this->equipoRepository->getAllForSelect();
		$this->breadcrumbs->addCrumb($jugador->nombre, route('jugadores.show', $jugador->id));
		$table = $this->repository->getEquiposTable($id);
		return View::make('jugadores.show', compact('jugador', 'table', 'equipos'));
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
	public function update($id)
	{
		$input = Input::all();
		$input['jugador_id'] = $id;
		try
		{
			$this->editarJugadorForm->validate($input);
			$jugador = $this->repository->update($input);
			return Redirect::route('jugadores.show', $id);
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());			
		}
	}


	public function updateApi()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editarJugadorForm->validate($input);
				$jugador = $this->repository->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('jugador', $jugador);
				//$this->addToResponseArray('equipo', $jugador->getEquipoAttribute()->toArray());
				$this->addToResponseArray('datos', $input);
				return $this->getResponseArrayJson();					
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(false);
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

	public function equiposApi($id)
	{
		return $this->repository->getTableForTeams($id);
	}	

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('jugadorId'))
			{
				$jugador = $this->repository->get(Input::get('jugadorId'));

				if($jugador->equipoActual)
					$equipo = $jugador->equipoActual;
				else
					$equipo = $jugador->ultimoEquipo;

				$this->setSuccess(true);
				$this->addToResponseArray('jugador', $jugador->toArray());
				$this->addToResponseArray('urlImg',  $jugador->foto->url('thumb'));
				$this->addToResponseArray('posicion',  $jugador->posicion->toArray());
				$this->addToResponseArray('pais',   $jugador->pais->toArray());
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

	public function addEquipoApi()
	{
		if(Request::ajax()) {
			$id = Input::get('id');
			$this->setSuccess($this->repository->addEquipo($id, Input::all()));
		}
		return $this->getResponseArrayJson();
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
