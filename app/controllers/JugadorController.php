<?php

use soccer\Jugador\JugadorRepository;
use soccer\Forms\RegistrarJugadorForm;
use soccer\Forms\EditarJugadorForm;
use Laracasts\Validation\FormValidationException;


class JugadorController extends \BaseController {

	protected $jugadorRepository;
	protected $registrarJugadorForm;
	protected $editarJugadorForm;

	public function __construct(JugadorRepository $jugadorRepository,
			RegistrarJugadorForm $registrarJugadorForm,
			EditarJugadorForm $editarJugadorForm){

		$this->jugadorRepository = $jugadorRepository;
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
	public function update()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editarJugadorForm->validate($input);
				$this->jugadorRepository->update($input);
				return Response::json(['success' => true]);
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
			}
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		if (Request::ajax())
		{
			if (Input::has('jugadorId'))
			{
				$jugador = $this->jugadorRepository->delete(Input::get('jugadorId'));
				return Response::json(['success' => true]);
			}else{
				return Response::json(['success' => false]);
			}
		}

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
			 return $model->getAgeAttribute();
		});

		$collection->addColumn('Acciones', function($model)
		{
			$links = "<a class='ver-jugador' href='#' id='ver_".$model->id."'>Ver</a>
					<br />";
			$links .= "<a  class='editar-jugador' href='#new-player-form' id='editar_".$model->id."'>Editar</a>
					<br />
					<a class='eliminar-jugador' href='#' id='eliminar_".$model->id."'>Eliminar</a>";

			return $links;
		});
	
		return $collection->make();
	
	}

	public function getData()
	{
		if (Request::ajax())
		{
			if (Input::has('jugadorId'))
			{
				$jugador = $this->jugadorRepository->getById(Input::get('jugadorId'));
				return Response::json(['success' => true, 'jugador' => $jugador->toArray(),
					'urlImg' => $jugador->foto->url('thumb'),
					'posicion' => $jugador->posicion->toArray(),
					'pais' => $jugador->pais->toArray(),
					'public' => public_path()
					]);
			}else{
				return Response::json(['success' => false]);
			}
		}
	}

}
