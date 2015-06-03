<?php

use soccer\Game\Sanction\SanctionTypeRepository;
use soccer\Forms\RegisterSanctionTypeForm;


class SanctionTypesController extends \BaseController {


	protected $repository;
	protected $registerSanctionTypeForm;

	public function __construct(SanctionTypeRepository $repository,
		RegisterSanctionTypeForm $registerSanctionTypeForm) {
		$this->repository = $repository;
		$this->registerSanctionTypeForm = $registerSanctionTypeForm;
	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = $this->repository->getAllTable();
		return View::make('sanction-types.index', compact('table'));
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
				$this->registerSanctionTypeForm->validate($input);
				$sanctionType = $this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('sanctionType', $sanctionType);
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


	public function listApi()
	{
		return $this->repository->getDefaultTableForAll();
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('sanctionTypeId'))
			{
				$sanctionType = $this->repository->get(Input::get('sanctionTypeId'));
				$this->setSuccess(($sanctionType ? true : false));
				$this->addToResponseArray('sanctionType', $sanctionType);
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
				$this->registerSanctionTypeForm->validate($input);
				$sanctionType = $this->repository->get($input['sanction_type_id']);
				$sanctionType->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('sanctionType', $sanctionType);
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
			$this->setSuccess($this->repository->delete(Input::get('sanctionTypeId')));
		return $this->getResponseArrayJson();
	}

}
