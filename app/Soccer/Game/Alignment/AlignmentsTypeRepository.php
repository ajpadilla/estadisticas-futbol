<?php namespace soccer\Game\Alignment;

use soccer\Game\Alignment\AlignmentType;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;

/**
* 
*/
class AlignmentsTypeRepository extends BaseRepository
{
	
	function __construct() {
		$this->columns = [];

		$this->setModel(new AlignmentType);
		$this->setListAllRoute('');
	}

}