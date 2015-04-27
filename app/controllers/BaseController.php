<?php

class BaseController extends Controller {


	protected $responseArray = array('success' => false);
	public $breadcrumbs;
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

		$this->breadcrumbs = new \Creitive\Breadcrumbs\Breadcrumbs;

		$this->breadcrumbs->addCrumb('Home', route('pages.home'));
		$this->breadcrumbs->addCssClasses('breadcrumb');
		$this->breadcrumbs->setDivider('');
		$this->breadcrumbs->setListElement('ul');

		$currentRoute = Route::currentRouteName();
		$urlSegments = Request::segments();
		$breadcrumbs = $this->breadcrumbs;
		View::share(compact('currentRoute', 'urlSegments', 'breadcrumbs'));
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