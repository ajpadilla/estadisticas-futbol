<?php

use soccer\CompetitionFormats\CompetitionFormatRepository;
use soccer\Forms\RegisterCompetitionFormatForm;
use Laracasts\Validation\FormValidationException;

class CompetitionFormatController extends \BaseController {

	protected $repository;
	protected $registerCompetitionFormatForm;

	public function __construct(CompetitionFormatRepository $repository,
								RegisterCompetitionFormatForm $registerCompetitionFormatForm) {
		$this->repository = $repository;
		$this->registerCompetitionFormatForm = $registerCompetitionFormatForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = $this->repository->getAllTable();
		return View::make('competition-formats.index', compact('table'));
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
				$this->registerCompetitionFormatForm->validate($input);
				$competitionFormat = $this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('competitionFormat', $competitionFormat);
				$this->addToResponseArray('data', $input);
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


	public function listApi()
	{
		return $this->repository->getDefaultTableForAll();
	}

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('competitionFormatId')));
		return $this->getResponseArrayJson();
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('competitionFormatId'))
			{
				$competitionFormat = $this->repository->get(Input::get('competitionFormatId'));
				$this->setSuccess(($competitionFormat ? true : false));
				$this->addToResponseArray('competitionFormat', $competitionFormat);
				return $this->getResponseArrayJson();
			}else{
				return $this->getResponseArrayJson();
			}
		}
	}

	public function updateApi()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->registerCompetitionFormatForm->validate($input);
				$competitionFormat = $this->repository->get($input['competition_format_id']);
				$competitionFormat->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('competitionFormat', $competitionFormat);
				$this->addToResponseArray('data', $input);
				return $this->getResponseArrayJson();					
			}
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errores', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
	}

}
