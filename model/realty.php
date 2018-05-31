<?php

declare(strict_types=1);

class Realty
{
    private $realtyTable;
    private $realtyTypeTable;
    private $heatingTypeTable;
    private $buildingType;
    private $contractTable;
    private $saleContractTable;

    public function __construct()
    {
        $this->realtyTable =  config::DB_PREFIX . "nekilnojamas_turtas";
        $this->realtyTypeTable = config::DB_PREFIX ."turto_tipas";
        $this->heatingTypeTable = config::DB_PREFIX ."sildymo_tipas";
        $this->buildingType = config::DB_PREFIX ."statinio_tipas";
        $this->buildingState = config::DB_PREFIX."irengimo_lygis";
        $this->contractTable = config::DB_PREFIX."sutartis";
        $this->saleContractTable = config::DB_PREFIX."pirkimo_pardavimo_sutartis";

    }

    public function getRealtyData(int $start = 0, int $offset = 0)
    {
        $sql = "SELECT nt.*, tt.name AS turto_tipas_name, st.name AS sildymo_tipas_name, stti.name AS statinio_tipas_name
                      FROM  {$this->realtyTable} nt
                            LEFT JOIN {$this->realtyTypeTable} tt ON nt.turto_tipas = tt.id_turto_tipas
                            LEFT JOIN {$this->heatingTypeTable} st ON nt.sildymo_tipas = st.id_Sildymo_tipas
                            LEFT JOIN {$this->buildingType} stti ON nt.statinio_tipas = stti.id_Statinio_tipas
                      ORDER BY nt.id_Nekilnojamas_turtas DESC";
         if($start != 0 && $offset != 0)
             $sql .= " LIMIT ".$start." OFFSET ".$offset;

        return mysql::select($sql);
    }

    public function getRealty($realtyId)
    {
        $sql = "SELECT * FROM {$this->realtyTable} WHERE id_Nekilnojamas_turtas = {$realtyId}";
        return mysql::select($sql)[0];
    }

    public function getTotalCount(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->realtyTable}";
        return (int)mysql::select($sql)[0]['total'];
    }

    public function deleteRealtyData($realtyId)
    {
        $sql = "DELETE FROM {$this->realtyTable} WHERE id_Nekilnojamas_turtas = {$realtyId}";
        mysql::query($sql);
    }

    public function getRealtyTypes()
    {
        $sql = "SELECT * FROM {$this->realtyTypeTable}";
        return mysql::select($sql);
    }

    public function getBuildingTypes()
    {
        $sql = "SELECT * FROM {$this->buildingType}";
        return mysql::select($sql);
    }

    public function getHeatingTypes()
    {
        $sql = "SELECT * FROM {$this->heatingTypeTable}";
        return mysql::select($sql);
    }

    public function getBuildingStates()
    {
        $sql = "SELECT * FROM {$this->buildingState}";
        return mysql::select($sql);
    }

    public function insertNewRealty($post)
    {
        $inputKeys = array_keys($post);
        $inputValues = array_values($post);

        $sql = "INSERT INTO {$this->realtyTable} (".implode(',', $inputKeys).") VALUES ('".implode('\',\'', $inputValues)."')";
        mysql::query($sql);
    }

    public function updateRealty($realtyId, $post)
    {
        $updateValues = [];
        foreach ($post as $key => $value)
        {
            $updateValues[] = $key . "='" . mysql::escape($value) . "'";
        }
        $sql = "UPDATE {$this->realtyTable} SET ".implode(', ', $updateValues)." WHERE id_Nekilnojamas_turtas = {$realtyId}";

        mysql::query($sql);
    }


    public function getRealtyReportByType($type)
    {
        $sql = "SELECT nt.*, st.name AS sildymo_tipas,
                    (SELECT SUM(pps.kaina + pps.avansas) FROM {$this->contractTable} sut 
                    JOIN {$this->saleContractTable} pps ON pps.fk_Sutartisid_Sutartis = sut.id_Sutartis 
                    WHERE sut.fk_Nekilnojamas_turtasid_Nekilnojamas_turtas = nt.id_Nekilnojamas_turtas) AS sutarciu_suma
                 FROM {$this->buildingType} tt 
                JOIN {$this->realtyTable} nt ON tt.id_Statinio_tipas = nt.statinio_tipas 
                JOIN {$this->heatingTypeTable} st ON nt.sildymo_tipas = st.id_Sildymo_tipas
                WHERE tt.id_Statinio_tipas = {$type} GROUP BY nt.id_Nekilnojamas_turtas HAVING NOT sutarciu_suma IS NULL
                ";
        return mysql::select($sql);
    }

}