<?php

use soccer\Game\GameRepository;
use soccer\Forms\RegisterGameForm;
use Laracasts\Validation\FormValidationException;

class GameController extends \BaseController {

	protected $repository;
	protected $registerGameForm;

	public function __construct(GameRepository $repository,
			RegisterGameForm $registerGameForm){
		$this->repository = $repository;
		$this->registerGameForm = $registerGameForm;
	}

	/**
	 * Display a listing of the resource.
	 * GET /game
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /game/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /game
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Response::ajax()) {
			$input = Input::all();
			try
			{
				$this->registerGameForm->validate($input);
				$game = $this->repository->create($input);
				if($game) {
					$this->setSuccess(true);
					$this->addToResponseArray('game', $game);
				}
				return $this->getResponseArrayJson();
			}
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}			
		}
	}

	/**
	 * Display the specified resource.
	 * GET /game/{id}
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
	 * GET /game/{id}/edit
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
	 * PUT /game/{id}
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
	 * DELETE /game/{id}
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

}