<?php namespace soccer\Base;

use Datatable;
use Illuminate\Database\Eloquent\Collection;

class BaseRepository 
{
	protected $model;
	protected $columns;	
	protected $actionColums = array();
	protected $collection;
	protected $listAllRoute;

	public function getColumnCount()
	{
		return count($this->columns);
	}

	public function setListAllRoute($listAllRoute)
	{
		$this->listAllRoute = $listAllRoute;
	}

	public function getListAllRoute()
	{
		return $this->listAllRoute;
	}

	public function setModel($model)
	{
		$this->model = $model;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function create($data = array())
	{
		$model = $this->model->create($data); 
		return $model;
	}

	public function getAll()
	{
		return $this->model->all();
	}	

	public function getAllForSelect()
	{
		return $this->getAll()->lists('nombre', 'id');
	}	

	public function delete($id)
	{
		$model = $this->get($id); 
		return $model->delete();
	}

	public function get($id)
	{
		return $this->model->findOrFail($id);
	}	

	public function update($data = array()){}

	/*
	************************** DATATABLE COLLECTION METHODS *********************************
	*/

	public function getAllTable($route = null, $params = array(), $orderColumn = 1, $type = 'asc', $tableId = 'datatable')
	{
		if(!$route)
			$route = $this->listAllRoute;
		
		$datatable = Datatable::table();
		$datatable->addColumn($this->columns);
		$datatable->setOptions('order', [[$orderColumn , $type]]);
		//$datatable->setCustomValues('table-id', 'datatable-' . $tableId);
		if($tableId != 'datatable')
			$datatable->setId('datatable-' . $tableId);
		$datatable->setUrl(route($route, $params));
		$datatable->noScript();	
		return $datatable;
	}	

	public function setCollection($collection)
	{
		$this->collection = $collection;
	}	

	public function setDatatableCollection(Collection $collection)
	{
		$this->collection = Datatable::collection($collection);
	}

	public function addColumnToCollection($name, $content)
	{
		$this->collection->addColumn($name, $content);
	}

	public function addActionColumn($column)
	{
		$this->actionColums[] = $column;
	}

	public function getActionColumn()
	{
		return $this->actionColums;
	}

	public function cleanActionColumn()
	{
		unset($this->actionColums);
		$this->actionColums = array();
	}

	public function getTableCollectionForRender() {
		return $this->collection->make();
	}

	public function getDefaultTableForAll()
	{
		$collection = $this->getAll();
		$this->setDatatableCollection($collection);
		$this->setDefaultTableSettings();
		return $this->getTableCollectionForRender();
	}		

	public function setDefaultTableSettings()
	{
		$this->setBodyTableSettings();
		$this->setDefaultActionColumn();
	}	

	public function setDefaultActionColumn(){}
	public function setBodyTableSettings(){}
	public function deleteImageDirectory($id){}
}