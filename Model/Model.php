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
    
    public abstract function getTableName();

    protected abstract function fill($array);
    
    protected abstract function getInsertSql();
    
    protected abstract function getUpdateSql();

    public abstract static function getTableCreateString();

    public function save(){
        if($this->id == null){
            DB::query($this->getInsertSql());
        }else{
            DB::query($this->getUpdateSql());
        }
    }
}