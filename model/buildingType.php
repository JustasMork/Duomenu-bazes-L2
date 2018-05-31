<?php

declare(strict_types=1);

class BuildingType
{
    private $buildingTypeTable;

    public function __construct()
    {
        $this->buildingTypeTable = config::DB_PREFIX."statinio_tipas";
    }

    public function insertNewBuildingTypes($post)
    {
        $values = array_values($post);
        foreach ($values as $value){
            if(!empty($value)){
                $sql = "INSERT INTO {$this->buildingTypeTable}(name) VALUES ('{$value}')";
                mysql::query($sql);
            }
        }
    }

    public function getBuildingType($id)
    {
        $sql = "SELECT * FROM {$this->buildingTypeTable} WHERE id_Statinio_tipas = {$id}";
        return mysql::select($sql)[0];
    }

    public function getTotal()
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->buildingTypeTable}";
        return (int)mysql::select($sql)[0]['total'];
    }

    public function getBuildingTypes(int $limit = 0, int $offset = 0)
    {
        $sql = "SELECT * FROM {$this->buildingTypeTable} ORDER BY id_Statinio_tipas DESC";
        if($limit != 0 && $offset != 0)
            $sql .= " LIMIT {$limit}, {$offset}";
        return mysql::select($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->buildingTypeTable} WHERE id_Statinio_tipas = {$id}";
        if(!mysql::query($sql))
            vdd('DELETE BUILDING TYPE ERROR: '.$sql);
    }

    public function update($id, $post)
    {
        $sql = "UPDATE {$this->buildingTypeTable} SET name = '{$post['name']}' WHERE id_Statinio_tipas = {$id}";
        if(!mysql::query($sql))
            vdd("UPDATE BUILDING TYPE ERROR: ".$sql);
    }
}