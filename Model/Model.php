<?php

namespace Model;

use Database\DB;

abstract class Model
{
    protected $id = null;

    public function __construct($array, $id = null){
        $this->fill($array);
        $this->id = $id;
    }

    public function update($array){
        $this->fill($array);
    }
    
    public static abstract function getTableName();

    protected abstract function fill($array);
    
    protected abstract function getInsertSql();
    
    protected abstract function getUpdateSql();

    public abstract static function getTableCreateString();
    
    public abstract function asArray();

    public function save(){
        if($this->id == null){
            $params = $this->asArray();
            unset($params['id']);
            DB::query($this->getInsertSql(), $params);
        }else{
            DB::query($this->getUpdateSql(), $this->asArray());
        }
    }
    
    public function delete(){
        if($this->id != null){
           DB::query("DELETE FROM " . $this->getTableName() . " WHERE id = :id", array('id' => $this->id)); 
        }
    }
}