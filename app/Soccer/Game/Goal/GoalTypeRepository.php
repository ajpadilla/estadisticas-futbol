<?php namespace soccer\Game\Goal;

use soccer\Game\Goal\GoalType;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;


/**
* 
*/
class GoalTypeRepository extends BaseRepository
{
	
	function __construct() {
		$this->columns = [];

		$this->setModel(new GoalType);
		$this->setListAllRoute('');
	}	
}