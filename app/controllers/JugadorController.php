<?php

use soccer\Jugador\JugadorRepository;
use soccer\Forms\RegistrarJugadorForm;
use Laracasts\Validation\FormValidationException;

class JugadorController extends \BaseController {

	protected $jugadorRepository;
	protected $registrarJugadorForm;


	public function __construct(JugadorRepository $jugadorRepository,
			RegistrarJugadorForm $registrarJugadorForm ){

		$this->jugadorRepository = $jugadorRepository;
		$this->registrarJugadorForm = $registrarJugadorForm;
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
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->registrarJugadorForm->validate($input);
				$jugador = $this->jugadorRepository->create($input);
				return Response::json(['success' => true, 'jugador' => $jugador->toArray()]);
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
			 return $model->getAge();
		});

		$collection->addColumn('Acciones', function($model)
		{
			return 0;
		});
	
		return $collection->make();
	
	}

}
