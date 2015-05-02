<?php

use soccer\Equipo\EquipoRepository;
use soccer\Jugador\JugadorRepository;
use soccer\Pais\PaisRepository;
use soccer\Forms\EquipoForm;
use soccer\Forms\EditarEquipoForm;
use Laracasts\Validation\FormValidationException;
//use Datatable;

class EquipoController extends \BaseController {

	protected $repository;
	protected $paisRepository;
	protected $jugadorRepository;
	protected $equipoForm;
	protected $editarEquipoForm;

	public function __construct(EquipoRepository $repository,
								JugadorRepository $jugadorRepository, 
								PaisRepository $paisRepository, 
								EquipoForm $equipoForm,
								EditarEquipoForm $editarEquipoForm){
		$this->repository = $repository;
		$this->jugadorRepository = $jugadorRepository;
		$this->paisRepository = $paisRepository;
		$this->equipoForm = $equipoForm;
		$this->editarEquipoForm = $editarEquipoForm;
	}	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		$table = $this->repository->getAllTable();
		return View::make('equipos.index', compact('table'));
	}	


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

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
				$this->equipoForm->validate($input);
				$equipo = $this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('equipo', $equipo->toArray());
				$this->addToResponseArray('data', $input);
				return $this->getResponseArrayJson();
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(false);
				$this->addToResponseArray('errors', $e->getErrors()->all());
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
		$paises = $this->paisRepository->getAllForSelect();
		$equipo = $this->repository->get($id);
		$jugadores = $this->jugadorRepository->getAllForSelect();
		$table = $this->repository->getJugadoresTable($id);
		return View::make('equipos.show', compact('equipo', 'paises', 'table', 'jugadores'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{


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
		$input['equipo_id'] = $id;
		try
		{
			$this->editarEquipoForm->validate($input);
			$equipo = $this->repository->update($input);
			$this->addToResponseArray('data', $input);
			return Redirect::route('equipos.show', $id);
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
				$this->editarEquipoForm->validate($input);
				$equipo = $this->repository->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('equipo', $equipo);
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
		if(Request::ajax()){

		}
			$equipo = $this->repository->delete(Input::get('idTeam'));
			$this->setSuccess(true);
			$this->addToResponseArray('equipo', $equipo);
			return $this->getResponseArrayJson();
	}

	public function listaApi()
	{
		return $this->repository->getDefaultTableForAll();
	}

	public function jugadoresApi($id)
	{
		return $this->repository->getTableForPlayers($id);
	}

	public function getAllValue()
	{
		if(Request::ajax())
		{
			$equipos = $this->repository->listForType();
			if (count($equipos) > 0) {
				$this->setSuccess(true);
				$this->addToResponseArray('data', $equipos);
			}
		}
		return $this->getResponseArrayJson();
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('equipoId'))
			{
				$equipo = $this->repository->get(Input::get('equipoId'));
				$this->setSuccess(true);
				$this->addToResponseArray('equipo', $equipo->toArray());
				//$this->addToResponseArray('jugadores', $equipo->jugadoresActuales());
				$this->addToResponseArray('urlImg',  $equipo->foto->url('thumb'));
			}
		}
		return $this->getResponseArrayJson();
	}

	public function existeNumeroApi()
	{
		if (Request::ajax()) {
			$id = Input::get('id');
			$numero = Input::get('numero');
			return Response::json(!$this->repository->existeNumero($id, $numero));	
		}
		return false;
	}

	public function addJugadorApi()
	{
		if(Request::ajax()) {
			$id = Input::get('id');
			$this->setSuccess($this->repository->addJugador($id, Input::all()));
		}
		return $this->getResponseArrayJson();
	}

	public function confirmExistsPlayerTeam()
	{
		if (Request::ajax()) 
		{
			$input = Input::all();
			//$this->repository->existsPlayerTeam($input);
			/*$this->addToResponseArray(true);
			return $this->getResponseArrayJson();*/
			return Response::json(false);
		}else{
			$this->setSuccess(false);
			return $this->getResponseArrayJson();
		}
	}

}
