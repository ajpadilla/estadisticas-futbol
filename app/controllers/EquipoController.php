<?php

use soccer\Equipo\EquipoRepository;
use soccer\Pais\PaisRepository;
use soccer\Forms\EquipoForm;
use Laracasts\Validation\FormValidationException;
//use Datatable;

class EquipoController extends \BaseController {

	protected $repository;
	protected $paisRepository;
	protected $equipoForm;

	public function __construct(EquipoRepository $repository, 
								PaisRepository $paisRepository, 
								EquipoForm $equipoForm){
		$this->repository = $repository;
		$this->paisRepository = $paisRepository;
		$this->equipoForm = $equipoForm;
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
		$jugadoresTable = $this->repository->getJugadoresTable($id);
		return View::make('equipos.show', compact('equipo', 'paises', 'jugadoresTable'));
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
		$inpunt['equipo_id'] = $id;
		try
		{
			$this->equipoForm->validate($input);
			$equipo = $this->repository->create($input);
		}
		catch (FormValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());			
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
	public function destroyApi($id)
	{		
		if(Request::ajax())
			$this->setSuccess($this->repository->delete($id));
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
			$equipos = $this->repository->getAllForSelect();
			if (count($equipos) > 0) {
				$this->setSuccess(true);
				$this->addToResponseArray('data', $equipos);
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

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('equipoId'))
			{
				$equipo = $this->repository->get(Input::get('equipoId'));
				$this->setSuccess(true);
				$this->addToResponseArray('equipo', $equipo->toArray());
				return $this->getResponseArrayJson();
			}else{
				$this->setSuccess(false);
				return $this->getResponseArrayJson();
			}
		}
	}
}
