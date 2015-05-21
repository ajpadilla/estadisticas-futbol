<?php namespace soccer\Game\Sanction;

use soccer\Game\Sanction\Sanction;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;


/**
* 
*/
class SanctionRepository extends BaseRepository
{
	
	function __construct() {
		$this->columns = [];

		$this->setModel(new Sanction);
		$this->setListAllRoute('');
	}

	public function create($data = array())
	{
		$sanction = $this->model->create($data); 
		return $sanction;
	}

}