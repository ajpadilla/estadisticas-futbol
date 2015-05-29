<?php namespace soccer\CompetitionFormats;

use soccer\Base\BaseRepository;
use soccer\CompetitionFormats\CompetitionFormat;
/**
* 
*/
class CompetitionFormatRepository extends BaseRepository
{

	function __construct() {
		$this->columns = [];
		$this->setModel(new CompetitionFormat);
	}

}