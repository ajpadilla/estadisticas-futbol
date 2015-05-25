<?php

use soccer\Game\Alignment\AlignmentsTypeRepository;

class AlignmentsTypeController extends \BaseController {

	protected $repository;

	public function __construct(AlignmentsTypeRepository $repository){
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
			$alignmentsType = $this->repository->getAllForSelect();
			if (count($alignmentsType) > 0) 
			{
				$this->setSuccess(true);
				$this->addToResponseArray('data', $alignmentsType);
				return $this->getResponseArrayJson();	
			}else{
				return $this->getResponseArrayJson();	
			}
		}else{
			return $this->getResponseArrayJson();
		}
	}

}
