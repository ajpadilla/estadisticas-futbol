<?php

use soccer\Game\Sanction\SanctionTypeRepository;

class SanctionTypesController extends \BaseController {


	protected $repository;

	public function __construct(SanctionTypeRepository $repository) {
		$this->repository = $repository;
	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
		//
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



	public function getAllValue()
	{
		if(Request::ajax())
		{
			$sanctionsTypes = $this->repository->getAllForSelect();
			if (count($sanctionsTypes) > 0) 
			{
				$this->setSuccess(true);
				$this->addToResponseArray('data', $sanctionsTypes);
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
