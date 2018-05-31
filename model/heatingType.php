<?php

declare(strict_types=1);

class HeatingType
{
    private $heatingTypeTable;

    public function __construct()
    {
        $this->heatingTypeTable = config::DB_PREFIX."sildymo_tipas";
    }

    public function insertNewHeatingType($post)
    {
        $keys = array_keys($post);
        $values = array_values($post);

        $sql = "INSERT INTO {$this->heatingTypeTable}(".implode(',',$keys).") VALUES ('".implode('\',\'', $values)."')";

        if(!mysql::query($sql))
            vdd("HEATING TYPE INSERT ERROR: ".$sql);
    }
}