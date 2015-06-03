<?php

use soccer\Game\Alignment\AlignmentsTypeRepository;
use soccer\Forms\RegisterAlignmentTypeForm;

class AlignmentsTypeController extends \BaseController {

	protected $repository;
	protected $registerAlignmentTypeForm;

	public function __construct(AlignmentsTypeRepository $repository,
		RegisterAlignmentTypeForm $registerAlignmentTypeForm){
		$this->repository = $repository;
		$this->registerAlignmentTypeForm = $registerAlignmentTypeForm;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = $this->repository->getAllTable();
		return View::make('alignment-types.index', compact('table'));
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
				$this->registerAlignmentTypeForm->validate($input);
				$alignmentType = $this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('alignmentType', $alignmentType);
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

	public function listApi()
	{
		return $this->repository->getDefaultTableForAll();
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('alignmentTypeId'))
			{
				$alignmentType = $this->repository->get(Input::get('alignmentTypeId'));
				$this->setSuccess(($alignmentType ? true : false));
				$this->addToResponseArray('alignmentType', $alignmentType);
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
				$this->registerAlignmentTypeForm->validate($input);
				$alignmentType = $this->repository->get($input['alignment_type_id']);
				$alignmentType->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('alignmentType', $alignmentType);
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
			$this->setSuccess($this->repository->delete(Input::get('alignmentTypeId')));
		return $this->getResponseArrayJson();
	}

}
