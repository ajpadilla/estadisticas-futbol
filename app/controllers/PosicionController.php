<?php
use soccer\Posicion\PosicionRepository;
use soccer\Forms\RegistrarPosicionForm;
use soccer\Forms\EditarPosicionForm;
use Laracasts\Validation\FormValidationException;

class PosicionController extends \BaseController {

	protected $repository;
	protected $registrarPosicionForm;
	protected $editarPosicionForm;

	public function __construct(PosicionRepository $repository,
		RegistrarPosicionForm $registrarPosicionForm,
		EditarPosicionForm $editarPosicionForm) {
		$this->repository = $repository;
		$this->registrarPosicionForm = $registrarPosicionForm;
		$this->editarPosicionForm = $editarPosicionForm;

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = $this->repository->getAllTable();
		return View::make('posiciones.index', compact('table'));
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
				$this->registrarPosicionForm->validate($input);
				$posicion = $this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('posicion', $posicion->toArray());
				return $this->getResponseArrayJson();				
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(false);
				$this->addToResponseArray('errores', $e->getErrors()->all());
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


	public function updateApi()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editarPosicionForm ->validate($input);
				$posicion = $this->repository->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('posicion', $posicion->toArray());
				$this->addToResponseArray('datos', $input);
				return $this->getResponseArrayJson();					
			}
			catch (FormValidationException $e)
			{
				$this->setSuccess(false);
				$this->addToResponseArray('errores', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
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

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('positionId')));
		return $this->getResponseArrayJson();
	}

	public function getAllValue()
	{
		if(Request::ajax()){
			$posiciones = $this->repository->listAll();
			if (count($posiciones) > 0) {
				return Response::json(['success' => true, 'data' => $posiciones]);
			}else{
				return Response::json(['success' => false]);
			}
		}else{
			return Response::json(['success' => false]);
		}
	}

	public function listaApi()
	{
		return $this->repository->getDefaultTableForAll();
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('positionId'))
			{
				$posicion = $this->repository->get(Input::get('positionId'));
				$this->setSuccess(true);
				$this->addToResponseArray('posicion', $posicion->toArray());
				return $this->getResponseArrayJson();
			}else{
				$this->setSuccess(false);
				return $this->getResponseArrayJson();
			}
		}
	}

}
