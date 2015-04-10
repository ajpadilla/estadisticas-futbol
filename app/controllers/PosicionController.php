<?php
use soccer\Posicion\PosicionRepository;

class PosicionController extends \BaseController {

	protected $posicionRepository;

	public function __construct(PosicionRepository $posicionRepository) {
		$this->posicionRepository = $posicionRepository;
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

	public function getAllValue(){
		if(Request::ajax()){
			$posiciones = $this->posicionRepository->listAll();
			if (count($posiciones) > 0) {
				return Response::json(['success' => true, 'data' => $posiciones]);
			}else{
				return Response::json(['success' => false]);
			}
		}else{
			return Response::json(['success' => false]);
		}
	}

}
