<?php

use soccer\Player\PlayerRepository;
use soccer\Equipo\EquipoRepository;
use soccer\Forms\RegisterPlayerForm;
use soccer\Forms\EditPlayerForm;
use Laracasts\Validation\FormValidationException;

class PlayerController extends \BaseController {

	protected $repository;
	protected $teamRepository;
	protected $registerPlayerForm;
	protected $editPlayerForm;

	public function __construct(PlayerRepository $repository,
			EquipoRepository $teamRepository,
			RegisterPlayerForm $registerPlayerForm,
			EditPlayerForm $editPlayerForm){
		$this->repository = $repository;
		$this->teamRepository = $teamRepository;
		$this->registerPlayerForm = $registerPlayerForm;
		$this->editPlayerForm = $editPlayerForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		$this->breadcrumbs->addCrumb('Jugadores', route('players.index'));
		$table = $this->repository->getAllTable();
		return View::make('players.index', compact('jugadoresTable','table'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}


	public function selctAjax()
	{
		return View::make('players.autocomplete');
	}

	public function filter()
	{
		$items = $this->repository->filterListName(Input::get('term'));
		$this->setSuccess(true);
		$this->addToResponseArray('items', $items);
		return $this->getResponseArrayJson();	
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
				$this->registerPlayerForm->validate($input);
				$jugador = $this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('jugador', $jugador->toArray());
				$this->addToResponseArray('urlFoto', $jugador->foto->url());
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

	public function prueba($id)
	{
		$jugador = $this->repository->get($id);
		//$ruta = substr($jugador->foto->url(), 0,8);
		$ruta = explode("/", $jugador->foto->url());
		$directorio = 'public/system/soccer/Jugador/Jugador/fotos/000/000/'.$ruta[8];
		var_dump($ruta);
		echo $directorio;
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$player = $this->repository->get($id);
		$teams = $this->teamRepository->getAllForSelect();
		$this->breadcrumbs->addCrumb($player->nombre, route('players.show', $player->id));
		$table = $this->repository->getEquiposTable($id);
		$positionsSelect = $player->posiciones()->lists('jugador_posicion.posicion_id');
		$positions = $player->posiciones()->get(['jugador_posicion.id','posiciones.nombre']);
		return View::make('players.show', compact('player', 'table', 'teams', 'positions','positionsSelect'));
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
			$this->editPlayerForm->validate($input);
			$jugador = $this->repository->update($input);
			return Redirect::route('players.show', $id);
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
				$this->editPlayerForm->validate($input);
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
			$this->repository->deleteImageDirectory(Input::get('idPlayer'));
			$this->setSuccess($this->repository->delete(Input::get('idPlayer')));
		return $this->getResponseArrayJson();
	}

	public function listApi()
	{
		return $this->repository->getDefaultTableForAll();
	}

	public function teamsApi($id)
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
				$this->addToResponseArray('posiciones',  $jugador->posiciones()->lists('jugador_posicion.posicion_id'));
				$this->addToResponseArray('posicionesSelect', $jugador->posiciones()->get());
				$this->addToResponseArray('posicion', $jugador->getPosicionActual()->toArray());
				$this->addToResponseArray('pais',   $jugador->pais->toArray());
				return $this->getResponseArrayJson();
			}else{
				$this->setSuccess(false);
				return $this->getResponseArrayJson();
			}
		}
	}

	public function changeTeamApi($id)
	{
		
	}

	public function addTeamApi()
	{
		if(Request::ajax()) {
			$id = Input::get('id');
			$this->setSuccess($this->repository->addEquipo($id, Input::all()));
		}
		return $this->getResponseArrayJson();
	}

	public function existApi()
	{
		return false;
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
