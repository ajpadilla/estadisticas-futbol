<?php

use soccer\TipoCompetencia\TipoCompetenciaRepository;
use soccer\Forms\RegistrarTipoCompetenciaForm;
use Laracasts\Validation\FormValidationException;

class TipoCompetenciaController extends \BaseController {

	protected $repository;
	protected $registrarTipoCompetenciaForm;

	public function __construct(TipoCompetenciaRepository $repository,
		RegistrarTipoCompetenciaForm $registrarTipoCompetenciaForm
		){
		$this->repository = $repository;
		$this->registrarTipoCompetenciaForm = $registrarTipoCompetenciaForm;
	}

	/**
	 * Display a listing of the resource.
	 * GET /tipocompetencia
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = $this->repository->getAllTable();
		return View::make('tipos-competencia.index', compact('table'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tipocompetencia/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tipocompetencia
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
				$this->registrarTipoCompetenciaForm->validate($input);
				$tipoCompetencia = $this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('tipoCompetencia', $tipoCompetencia->toArray());
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
	 * GET /tipocompetencia/{id}
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
	 * GET /tipocompetencia/{id}/edit
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
	 * PUT /tipocompetencia/{id}
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
	 * DELETE /tipocompetencia/{id}
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

	public function destroyApi($id)
	{
		# code...
	}

	public function listaApi()
	{
		return $this->repository->getDefaultTableForAll();
	}

}