<?php

use soccer\Equipo\EquipoRepository;
use soccer\Pais\PaisRepository;
use soccer\Forms\EquipoForm;
use Laracasts\Validation\FormValidationException;
//use Datatable;

class EquipoController extends \BaseController {

	protected $equipoRepository;
	protected $paisRepository;
	protected $equipoForm;

	public function __construct(EquipoRepository $equipoRepository, 
								PaisRepository $paisRepository, 
								EquipoForm $equipoForm){
		$this->equipoRepository = $equipoRepository;
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
		$table = $this->equipoRepository->getAllTable();
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
				$equipo = $this->equipoRepository->create($input);
				return Response::json(['success' => true, 'equipo' => $equipo->toArray()]);
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
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
		$equipo = $this->equipoRepository->get($id);
		$jugadoresTable = $this->equipoRepository->getJugadoresTable($id);
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
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/*
	************************** API METHODS *****************************
	*/
	public function listaApi()
	{
		return $this->equipoRepository->getDefaultTableForAll();
	}

	public function jugadoresApi($id)
	{
		return $this->equipoRepository->getTableForPlayers($id);
	}
}
