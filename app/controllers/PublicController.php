<?php

use soccer\Competition\CompetitionRepository;
use Carbon\Carbon;

class PublicController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$competitionRepository = new CompetitionRepository;
		$competitions = $competitionRepository->playingCompetitions();
		$date = new Carbon('tomorrow');   
		$tomorrow = ucwords ($date->formatLocalized('%A %d %B %Y'));
		$today = ucwords ($date->now()->formatLocalized('%A %d %B %Y'));
		return View::make('public.home', compact('competitions', 'tomorrow', 'today'));
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


}
