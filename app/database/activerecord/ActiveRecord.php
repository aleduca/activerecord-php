<?php

namespace app\database\activerecord;

use ReflectionClass;
use app\database\interfaces\UpdateInterface;
use app\database\interfaces\ActiveRecordInterface;

abstract class ActiveRecord implements ActiveRecordInterface
{
    protected $table = null;

    protected $attributes = [];

    protected $idTable = null;

    public function __construct()
    {
        if (!$this->table) {
            $this->table = strtolower((new ReflectionClass($this))->getShortName());
        }
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function __set($attribute, $value)
    {
        $this->attributes[$attribute] = $value;
    }

    public function __get($attribute)
    {
        return $this->attributes[$attribute];
    }

    public function update(UpdateInterface $updateInterface)
    {
        return $updateInterface->update($this);
    }
}
