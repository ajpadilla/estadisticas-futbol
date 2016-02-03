<?php  
	namespace soccer\Base;

	use Eloquent;

	/**
	* 
	*/
	class BaseModel extends Eloquent
	{
		public function hasAttribute($attr)
		{
    		return array_key_exists($attr, $this->attributes);
		}
	}

?>