<?php

use soccer\Forms\RegisterGoalForm;
use soccer\Game\Goal\GoalRepository;
use Laracasts\Validation\FormValidationException;

class GoalController extends \BaseController {

	protected $repository;
	protected $registerGoalForm;

	public function __construct(GoalRepository $repository,
			RegisterGoalForm $registerGoalForm
		) {
		$this->repository = $repository;
		$this->registerGoalForm = $registerGoalForm;
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

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('goalId'))
			{
				$goal = $this->repository->get(Input::get('goalId'));
				$this->setSuccess(($goal ? true : false));
				$this->addToResponseArray('goal', $goal);
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
				$this->registerGoalForm->validate($input);
				$goal = $this->repository->get($input['goal_id']);
				$goal->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('goal', $goal);
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
