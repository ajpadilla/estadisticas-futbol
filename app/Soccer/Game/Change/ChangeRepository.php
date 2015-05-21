<?php namespace soccer\Game\Change;

use soccer\Game\Change\Change;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;


/**
* 
*/
class ChangeRepository extends BaseRepository
{
	
	function __construct() {
		$this->columns = [];

		$this->setModel(new Change);
		$this->setListAllRoute('');
	}

	public function create($data = array())
	{
		$change = $this->model->create($data);
		return $change;
	}

}