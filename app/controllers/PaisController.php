<?php
use soccer\Pais\PaisRepository;
use soccer\Forms\RegistrarPaisForm;
use Laracasts\Validation\FormValidationException;


class PaisController extends \BaseController {

	protected $paisRepository;
	protected $registrarPaisForm;

	public function __construct(PaisRepository $paisRepository,
		RegistrarPaisForm $registrarPaisForm
		) {
		$this->paisRepository = $paisRepository;
		$this->registrarPaisForm = $registrarPaisForm;
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
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->registrarPaisForm->validate($input);
				$pais = $this->paisRepository->create($input);
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

	public function getAllValue(){
		if(Request::ajax()){
			$paises = $this->paisRepository->listAll();
			if (count($paises) > 0) {
				return Response::json(['success' => true, 'data' => $paises]);
			}else{
				return Response::json(['success' => false]);
			}
		}else{
			return Response::json(['success' => false]);
		}
	}

}
