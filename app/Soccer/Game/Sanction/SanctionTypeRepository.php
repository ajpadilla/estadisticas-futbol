<?php namespace soccer\Game\Sanction;

use soccer\Game\Sanction\SanctionType;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;


/**
* 
*/
class SanctionTypeRepository extends BaseRepository
{
	
	function __construct() {
		$this->columns = [];

		$this->setModel(new SanctionType);
		$this->setListAllRoute('');
	}

	
}