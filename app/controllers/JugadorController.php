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
		$jugadoresTable = $this->jugadorRepository->getAllTable();
		return View::make('jugadores.index', compact('jugadoresTable'));
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
		if (Request::ajax())
		{
			return Response::json(['success' => $this->jugadorRepository->delete($id)]);
		}
		return Response::json(['success' => false]);

	}

	public function listaApi()
	{
		return $this->jugadorRepository->getDefaultTableForAllPlayers();
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('jugadorId'))
			{
				$jugador = $this->jugadorRepository->getById(Input::get('jugadorId'));
				return Response::json(['success' => true, 'jugador' => $jugador->toArray(),
					'urlImg' => $jugador->foto->url(),
					'posicion' => $jugador->posicion->toArray(),
					'pais' => $jugador->pais->toArray()
					]);
			}else{
				return Response::json(['success' => false]);
			}
		}
	}

	public function cambiarEquipoApi($id)
	{
		
	}

}
