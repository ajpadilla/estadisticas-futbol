<?php namespace soccer\Game\GameType;

use soccer\Game\GameType\GameType;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
//use Datatable;
use Illuminate\Database\Eloquent\Collection;

class GameTypeRepository extends BaseRepository
{		
	function __construct() {
		$this->setModel(new GameType);
	}	
}