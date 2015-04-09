<?php

use soccer\Jugador\JugadorRepository;

class JugadorController extends \BaseController {

	protected $jugadorRepository;

	public function __construct(JugadorRepository $jugadorRepository) {
		$this->jugadorRepository = $jugadorRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('jugadores.index');
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
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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

	public function listadoJugadores()
	{
		$collection = Datatable::collection($this->jugadorRepository->getAll())
			->searchColumns('nombre')
			->orderColumns('nombre');

		$collection->addColumn('País', function($model)
		{
			 return $model->pais->nombre;
		});

		$collection->addColumn('Posición', function($model)
		{
			 return $model->posicion->abreviacion;
		});

		$collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$collection->addColumn('Edad', function($model)
		{
			 return 0;
		});

		$collection->addColumn('Acciones', function($model)
		{
			 return 0;
		});
	
		return $collection->make();
	
	}

}
