<?php

use soccer\Competencia\CompetenciaRepository;


class CompetenciaController extends \BaseController {

	protected $repository;

	public function __construct(CompetenciaRepository $repository){
		$this->repository = $repository;
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
		//
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
		//
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

	public function destroyApi($id)
	{
		# code...
	}

	public function listaApi()
	{
		return $this->repository->getDefaultTableForAll();
	}

}