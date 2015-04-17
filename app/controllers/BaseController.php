<?php

class BaseController extends Controller {


	protected $responseArray = array('success' => false);
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

		$currentRoute = Route::currentRouteName();

		View::share(compact('currentRoute'));
	}

	public function setSuccess($success = false)
	{
		$this->responseArray['success'] = $success;
	}

	public function getResponseArray()
	{
		return $this->responseArray;
	}

	public function getResponseArrayJson()
	{
		return Response::json($this->responseArray);
	}	

	public function addToResponseArray($key, $value)
	{
		$this->responseArray[$key] = $value;
	}
}