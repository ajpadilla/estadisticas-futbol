<?php namespace soccer\Base;

use Datatable;
use Illuminate\Database\Eloquent\Collection;

class BaseRepository 
{
	protected $model;
	protected $columns;	
	protected $actionColums = array();
	protected $collection;

	public function setModel($model)
	{
		$this->model = $model;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function getAll()
	{
		return $this->model->all();
	}	

	public function delete($id)
	{
		$model = $this->get($id); 
		$model->delete();
	}

	public function get($id)
	{
		return $this->model->findOrFail($id);
	}	


	/*
	************************** DATATABLE COLLECTION METHODS *********************************
	*/

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
}