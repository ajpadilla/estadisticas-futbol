<?php
use soccer\Game\Sanction\SanctionRepository;
use soccer\Forms\RegisterSanctionForm;
use Laracasts\Validation\FormValidationException;

class SanctionController extends \BaseController {

	protected $repository;
	protected $registerSanctionForm;

	public function __construct(SanctionRepository $repository,
		RegisterSanctionForm $registerSanctionForm){
		$this->repository = $repository;
		$this->registerSanctionForm = $registerSanctionForm;
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
			if (Input::has('sanctionId'))
			{
				$sanction = $this->repository->get(Input::get('sanctionId'));
				$this->setSuccess(($sanction ? true : false));
				$this->addToResponseArray('sanction', $sanction);
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
				$this->registerSanctionForm->validate($input);
				$sanction = $this->repository->get($input['sanction_id']);
				$sanction->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('sanction', $sanction);
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
