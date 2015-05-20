<?php

use soccer\Game\Goal\GoalTypeRepository;

class GoalTypeController extends \BaseController {

	protected $repository;

	public function __construct(GoalTypeRepository $repository) {
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
			$goalTypes = $this->repository->getAllForSelect();
			if (count($goalTypes) > 0) 
			{
				$this->setSuccess(true);
				$this->addToResponseArray('data', $goalTypes);
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