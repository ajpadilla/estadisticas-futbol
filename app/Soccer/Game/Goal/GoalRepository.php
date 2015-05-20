<?php namespace soccer\Game\Goal;

use soccer\Game\Goal\Goal;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;


/**
* 
*/
class GoalRepository extends BaseRepository
{
	
	function __construct() {
		$this->columns = [];

		$this->setModel(new Goal);
		$this->setListAllRoute('');
	}


	public function create($data = array())
	{
		$goal = $this->model->create($data); 
		return $goal;
	}


	public function getAllForSelect()
	{
		return $this->getAll()->lists('name', 'id');
	}	
}