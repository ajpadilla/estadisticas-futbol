<?php

use soccer\Competencia\CompetenciaRepository;
use soccer\Forms\RegistrarCompetencia;
use Laracasts\Validation\FormValidationException;

class CompetenciaController extends \BaseController {

	protected $repository;
	protected $registrarCompetencia;

	public function __construct(CompetenciaRepository $repository,
			RegistrarCompetencia $registrarCompetencia
		){
		$this->repository = $repository;
		$this->registrarCompetencia = $registrarCompetencia;
	}

	/**
	 * Display a listing of the resource.
	 * GET /Competencia
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = $this->repository->getAllTable();
		return View::make('competencias.index', compact('table'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /Competencia/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /Competencia
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
				$this->registrarCompetencia->validate($input);
				$competencia = $this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('competencia', $competencia->toArray());
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
	 * GET /Competencia/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$competencia = $this->repository->get($id);
		return View::make('competencias.show', compact('competencia'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /Competencia/{id}/edit
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
	 * PUT /Competencia/{id}
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
	 * DELETE /Competencia/{id}
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

	public function listaApi()
	{
		return $this->repository->getDefaultTableForAll();
	}
	

}