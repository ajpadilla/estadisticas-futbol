<?php

use soccer\Equipo\EquipoRepository;
use soccer\Forms\EquipoForm;
use Laracasts\Validation\FormValidationException;
//use Datatable;

class EquipoController extends \BaseController {

	protected $equipoRepository;
	protected $equipoForm;

	public function __construct(EquipoRepository $equipoRepository, EquipoForm $equipoForm){
		$this->equipoRepository = $equipoRepository;
		$this->equipoForm = $equipoForm;
	}	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$columns = [
			'País',
			'Nombre',
			'Tipo',
			'Fecha Fundación',
			'Apodo',
			'Acciones'
		];

		$table = Datatable::table()
		->addColumn($columns)
		->setUrl(route('equipos.api.lista'))
		->noScript();

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
		$equipo = $this->equipoRepository->get($id);
		return View::make('equipos.show', compact('equipo'));
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
