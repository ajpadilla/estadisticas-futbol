<?php

use soccer\Game\Alignment\AlignmentRepository;
use soccer\Forms\RegisterAlignmentForm;
use Laracasts\Validation\FormValidationException;

class AlignmentController extends \BaseController {

	protected $repository;
	protected $registerAlignmentForm;

	public function __construct(AlignmentRepository $repository,
		RegisterAlignmentForm $registerAlignmentForm){
		$this->repository = $repository;
		$this->registerAlignmentForm = $registerAlignmentForm;
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
			if (Input::has('alignmentId'))
			{
				$alignment = $this->repository->get(Input::get('alignmentId'));
				$this->setSuccess(($alignment ? true : false));
				$this->addToResponseArray('alignment', $alignment);
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
				$this->registerAlignmentForm->validate($input);
				$alignment = $this->repository->get($input['alignment_id']);
				$alignment->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('alignment', $alignment);
				return $this->getResponseArrayJson();					
			}
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errores', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
	}


	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('alignmentId')));
		return $this->getResponseArrayJson();
	}


}
