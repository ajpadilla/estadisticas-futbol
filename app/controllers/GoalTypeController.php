<?php

use soccer\Game\Goal\GoalTypeRepository;
use soccer\Forms\RegisterGoalTypeForm;

class GoalTypeController extends \BaseController {

	protected $repository;
	protected $registerGoalTypeForm;

	public function __construct(GoalTypeRepository $repository,
		RegisterGoalTypeForm $registerGoalTypeForm) {
		$this->repository = $repository;
		$this->registerGoalTypeForm = $registerGoalTypeForm;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = $this->repository->getAllTable();
		return View::make('goal-types.index', compact('table'));
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
				$this->registerGoalTypeForm->validate($input);
				$goalType = $this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('goalType', $goalType);
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

	public function listApi()
	{
		return $this->repository->getDefaultTableForAll();
	}


	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('goalTypeId'))
			{
				$goalType = $this->repository->get(Input::get('goalTypeId'));
				$this->setSuccess(($goalType ? true : false));
				$this->addToResponseArray('goalType', $goalType);
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
				$this->registerGoalTypeForm->validate($input);
				$goalType = $this->repository->get($input['goal_type_id']);
				$goalType->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('goalType', $goalType);
				return $this->getResponseArrayJson();					
			}
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
	}

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('goalTypeId')));
		return $this->getResponseArrayJson();
	}


}
