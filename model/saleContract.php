<?php

declare(strict_types=1);

class SaleContract
{

    private $contractTable;
    private $contractTypeTable;
    private $saleContractTable;
    private $userTable;
    private $contractType;
    const CONTRACT_TYPE_ID = 3;

    public function __construct()
    {
        $this->contractTable = config::DB_PREFIX."sutartis";
        $this->contractTypeTable = config::DB_PREFIX."sutarties_tipas";
        $this->saleContractTable = config::DB_PREFIX."pirkimo_pardavimo_sutartis";
        $this->userTable = config::DB_PREFIX."asmuo";
        $this->contractStatusTable = config::DB_PREFIX."sutarties_busena";
        $this->contractType = 3; //Sale contract ID
    }

    public function getSaleContracts(int $start, int $offset)
    {
        $sql = "SELECT s.id_Sutartis, s.sudarymo_data, CONCAT(k.vardas, \" \", k.pavarde) AS klientas, CONCAT(p.vardas, \" \", p.pavarde) AS pardavejas, pps.*, sb.name AS sutarties_busena 
                  FROM {$this->contractTable} s 
                        JOIN {$this->contractTypeTable} st ON s.sutarties_tipas = st.id_Sutarties_tipas 
                        JOIN {$this->saleContractTable} pps ON s.id_Sutartis = pps.fk_Sutartisid_Sutartis
                        JOIN {$this->userTable} k ON s.fk_Klientoasmens_kodas = k.asmens_kodas
                        JOIN {$this->userTable} p ON s.fk_Savininkoasmens_kodas = p.asmens_kodas
                        JOIN {$this->contractStatusTable} sb ON pps.fk_busena = sb.id_Sutarties_busena
                  WHERE st.id_Sutarties_tipas = {$this->contractType} ORDER BY s.sudarymo_data DESC, s.id_Sutartis DESC LIMIT {$offset}, {$start}";
        return mysql::select($sql);
    }

    public function getSaleContract($contractId)
    {
        $sql = "SELECT * FROM {$this->contractTable} s 
                        JOIN {$this->saleContractTable} pps ON s.id_Sutartis = pps.fk_Sutartisid_Sutartis
                  WHERE s.id_Sutartis = {$contractId}";

        return mysql::select($sql)[0];
    }

    public function getTotalSaleContracts()
    {
        $sql = "SELECT COUNT(s.id_Sutartis) AS total
                  FROM {$this->contractTable} s 
                        JOIN {$this->contractTypeTable} st ON s.sutarties_tipas = st.id_Sutarties_tipas 
                        JOIN {$this->saleContractTable} pps ON s.id_Sutartis = pps.fk_Sutartisid_Sutartis
                        JOIN {$this->userTable} k ON s.fk_Klientoasmens_kodas = k.asmens_kodas
                        JOIN {$this->userTable} p ON s.fk_Savininkoasmens_kodas = p.asmens_kodas
                        JOIN {$this->contractStatusTable} sb ON pps.fk_busena = sb.id_Sutarties_busena
                  WHERE st.id_Sutarties_tipas = {$this->contractType} ORDER BY s.sudarymo_data DESC";
        return (int)mysql::select($sql)[0]['total'];
    }

    public function insertNewContract($post)
    {
        $contractKeys = array_keys($post['contract']);
        $contractValues = array_values($post['contract']);
        $saleContractKeys = array_keys($post['saleContract']);
        $saleContractValues = array_values($post['saleContract']);
        $sql = "INSERT INTO {$this->contractTable}(".implode(',', $contractKeys).") VALUES ('".implode('\',\'', $contractValues)."')";
        if(mysql::query($sql)){
            $contractId = mysql::getLastInsertedId();
            $saleContractKeys[] = 'fk_Sutartisid_Sutartis';
            $saleContractValues[] = $contractId;
            $sql = "INSERT INTO {$this->saleContractTable}(".implode(',', $saleContractKeys).") VALUES ('".implode('\',\'', $saleContractValues)."')";
            if(!mysql::query($sql))
                vdd("SALE CONTRACT INSERT ERROR: ".$sql);
        }else{
            vdd("CONTRACT INSERT ERROR: ".$sql);
        }
    }

    public function updateContract($contractId, $post)
    {
        $contractValues = $post['contract'];
        $saleContractValues = $post['saleContract'];
        array_walk($contractValues, function(&$value, $key){ $value = $key.'=\''.mysql::escape($value).'\''; });
        array_walk($saleContractValues, function(&$value, $key){ $value = $key.'=\''.mysql::escape($value).'\''; });
        $sql = "UPDATE {$this->saleContractTable} SET ".implode(', ', $saleContractValues). " WHERE fk_Sutartisid_Sutartis = {$contractId}";
        if(mysql::query($sql)){
            $sql = "UPDATE {$this->contractTable} SET ".implode(', ', $contractValues). " WHERE id_Sutartis = {$contractId}";
            if(!mysql::query($sql))
                vdd("UPDATE CONTRACT ERROR: ".$sql);
        } else {
            vdd("UPDATE SALE CONTRACT ERROR: ".$sql);
        }
    }

    public function deleteContract($contractId)
    {
        $sql = "DELETE FROM {$this->saleContractTable} WHERE fk_Sutartisid_Sutartis = {$contractId}";
        if(mysql::query($sql))
        {
            $sql = "DELETE FROM {$this->contractTable} WHERE id_Sutartis = {$contractId}";
            if(!mysql::query($sql))
                vdd("CONTRACT DELETE ERROR: ".$sql);
        } else {
            vdd("SALE CONTRACT DELETE ERROR: ".$sql);
        }
    }

    public function getStatuses()
    {
        $sql = "SELECT * FROM {$this->contractStatusTable}";
        return mysql::select($sql);
    }
}