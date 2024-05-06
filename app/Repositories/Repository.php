<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
abstract class Repository
{
    protected Model $model;
    abstract public function getModelClass():string;
    public function getNewModel()
    {
        $modelClass = $this->getModelClass();
        return new $modelClass;
    }
    public function getModel()
    {
        if (empty($this->model)){
            $this->model = $this->getNewModel();
        }
        return $this->model;
    }
    public function getBuilder()
    {
       return $this->getModel()->newQuery();
    }
    public function hasData(string $columnsNote, $note):bool
    {
        return $this->getBuilder()->where($columnsNote, '=', $note)->exists();
    }
    public function inserOrUpdateNoteDB(array $arrayCondition, array $arrayInsert)
    {
        $this->getBuilder()->updateOrInsert($arrayCondition,$arrayInsert);
    }
    public function save(Model $model)
    {
        return $model->save();
    }
    public  function getByFieldName(string $fieldName, $fieldValue)
    {
        return $this->getBuilder()
            ->where($fieldName, '=', $fieldValue)
            ->first();
    }

}
