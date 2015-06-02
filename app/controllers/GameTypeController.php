<?php

use soccer\Game\GameType\GameTypeRepository;

class GameTypeController extends \BaseController {

	protected $repository;

	public function __construct(GameTypeRepository $repository) {
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
			$gameTypes = $this->repository->getAllForSelect();
			if (count($gameTypes) > 0) 
			{
				$this->setSuccess(true);
				$this->addToResponseArray('data', $gameTypes);
				return $this->getResponseArrayJson();	
			}else{
				return $this->getResponseArrayJson();	
			}
		}else{
			return $this->getResponseArrayJson();
		}
	}

}
