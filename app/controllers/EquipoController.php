<?php

use soccer\Equipo\EquipoRepository;
use soccer\Pais\PaisRepository;
use soccer\Jugador\JugadorRepository;
use soccer\Forms\EquipoForm;
use Laracasts\Validation\FormValidationException;
//use Datatable;

class EquipoController extends \BaseController {

	protected $equipoRepository;
	protected $paisRepository;
	protected $jugadorRepository;
	protected $equipoForm;

	public function __construct(EquipoRepository $equipoRepository, 
								PaisRepository $paisRepository, 
								JugadorRepository $jugadorRepository, 
								EquipoForm $equipoForm){
		$this->equipoRepository = $equipoRepository;
		$this->paisRepository = $paisRepository;
		$this->jugadorRepository = $jugadorRepository;
		$this->equipoForm = $equipoForm;
	}	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = $this->equipoRepository->getTable();
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
		$jugadoresTable = $this->jugadorRepository->getTable();
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
		$collection = Datatable::collection($this->equipoRepository->getAll())
			->searchColumns('País', 'Nombre', 'Tipo', 'Fecha Fundación', 'Apodo')
			->orderColumns('País', 'Nombre', 'Tipo', 'Fecha Fundación', 'Apodo');

		$collection->addColumn('País', function($model)
		{
			 return $model->pais->nombre;
		});

		$collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$collection->addColumn('Tipo', function($model)
		{
			 return $model->tipo;
		});

		$collection->addColumn('Fecha Fundación', function($model)
		{
			 return $model->fecha_fundacion;
		});

		$collection->addColumn('Apodo', function($model)
		{
			 return $model->apodo;
		});

		$collection->addColumn('Acciones', function($model)
		{
			$links = "<a class='ver-jugador' href='" . route('equipos.show', $model->id) . "'>Ver</a>
					<br />";
			$links .= "<a  class='editar-jugador' href='#new-player-form' id='editar_".$model->id."'>Editar</a>
					<br />
					<a class='eliminar-jugador' href='#' id='eliminar_".$model->id."'>Eliminar</a>";

			return $links;
		});
	
		return $collection->make();	
	}

}
