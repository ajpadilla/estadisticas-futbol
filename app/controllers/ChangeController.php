<?php
use soccer\Game\Change\ChangeRepository;
use soccer\Forms\RegisterChangeForm;
use Laracasts\Validation\FormValidationException;

class ChangeController extends \BaseController {


	protected $repository;
	protected $registerChangeForm;

	public function __construct(ChangeRepository $repository,
		RegisterChangeForm $registerChangeForm){
		$this->repository = $repository;
		$this->registerChangeForm = $registerChangeForm;
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
			if (Input::has('changeId'))
			{
				$change = $this->repository->get(Input::get('changeId'));
				$this->setSuccess(($change ? true : false));
				$this->addToResponseArray('change', $change);
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
				$this->registerChangeForm->validate($input);
				$change = $this->repository->get($input['change_id']);
				$change->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('change', $change);
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
