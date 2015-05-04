<?php

use soccer\Competition\CompetitionRepository;
use soccer\Forms\RegisterCompetition;
use Laracasts\Validation\FormValidationException;

class CompetitionController extends \BaseController {

	protected $repository;
	protected $registerCompetition;

	public function __construct(CompetitionRepository $repository,
			RegisterCompetition $registerCompetition
		){
		$this->repository = $repository;
		$this->registerCompetition = $registerCompetition;
	}

	/**
	 * Display a listing of the resource.
	 * GET /Competition
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = $this->repository->getAllTable();
		return View::make('competitions.index', compact('table'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /Competition/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /Competition
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
				$this->registerCompetition->validate($input);
				$competition = $this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('competencia', $competition->toArray());
				$this->addToResponseArray('data', $input);
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

	/**
	 * Display the specified resource.
	 * GET /competencia/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$competition = $this->repository->get($id);		
		return View::make('competitions.show', compact('competition'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /competencia/{id}/edit
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
	 * PUT /Competition/{id}
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
	 * DELETE /Competition/{id}
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
	public function updateApi($id)
	{
		# code...
	}

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('competitionId')));
		return $this->getResponseArrayJson();
	}

	public function listApi()
	{
		return $this->repository->getDefaultTableForAll();
	}
	

}