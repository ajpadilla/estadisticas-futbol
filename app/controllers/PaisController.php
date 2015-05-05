<?php
use soccer\Pais\PaisRepository;
use soccer\Forms\RegistrarPaisForm;
use soccer\Forms\EditarPaisForm;
use Laracasts\Validation\FormValidationException;


class PaisController extends \BaseController {

	protected $repository;
	protected $registrarPaisForm;
	protected $editarPaisForm;

	public function __construct(PaisRepository $repository,
		RegistrarPaisForm $registrarPaisForm,
		EditarPaisForm $editarPaisForm
		) {
		$this->repository = $repository;
		$this->registrarPaisForm = $registrarPaisForm;
		$this->editarPaisForm = $editarPaisForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = $this->repository->getAllTable();
		return View::make('paises.index', compact('table'));
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
				$this->registrarPaisForm->validate($input);
				$pais = $this->repository->create($input);
				return Response::json(['success' => true, 'pais' => $pais->toArray()]);
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
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
	public function update()
	{
		$input = Input::all();
		try
		{
			$this->editarPaisForm->validate($input);
			$this->repository->update($input);
			return Response::json(['success' => true]);
		}
		catch (FormValidationException $e)
		{
			return Response::json($e->getErrors()->all());
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		if (Request::ajax())
		{
			if (Input::has('countryId'))
			{
				$this->repository->delete(Input::get('countryId'));
				return Response::json(['success' => true]);
			}else{
				return Response::json(['success' => false]);
			}
		}
	}

	public function getAllValue(){
		if(Request::ajax()){
			$paises = $this->repository->getAllForSelect();
			if (count($paises) > 0) {
				return Response::json(['success' => true, 'data' => $paises]);
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
			if (Input::has('countryId'))
			{
				$pais = $this->repository->get(Input::get('countryId'));
				$this->setSuccess(true);
				$this->addToResponseArray('pais', $pais->toArray());
				return $this->getResponseArrayJson();
			}else{
				$this->setSuccess(false);
				return $this->getResponseArrayJson();
			}
		}
	}


}
