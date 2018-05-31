<?php

declare(strict_types=1);

require_once "model/saleContract.php";

class User
{

    private $userTable;
    private $addressTable;
    private $userTypeTable;
    private $addressTypes;
    private $contractTable;
    private $saleContractTable;
    const BROKER = 1;
    const SELLER = 2;
    const CLIENT = 3;
    const ADDRESS_HOME = 1;


    public function __construct()
    {
        $this->userTable = config::DB_PREFIX . "asmuo";
        $this->addressTable = config::DB_PREFIX . "adresas";
        $this->userTypeTable = config::DB_PREFIX . "vartotojo_tipas";
        $this->addressTypes = config::DB_PREFIX. "adreso_tipas";
        $this->contractTable = config::DB_PREFIX. "sutartis";
        $this->saleContractTable = config::DB_PREFIX. "pirkimo_pardavimo_sutartis";
    }

    public function getUsersList($limit, $offset, $filters = [])
    {
        $sql = "SELECT u.*, a.*, t.name AS vartotojo_tipas, COUNT(a.id_Adresas) AS adresu_kiekis, 
               (SELECT COUNT(*) FROM {$this->contractTable} s 
                  WHERE (s.fk_Savininkoasmens_kodas = u.asmens_kodas OR s.fk_Klientoasmens_kodas = u.asmens_kodas OR s.fk_Brokerioasmens_kodas = u.asmens_kodas) AND s.sutarties_tipas = ".SaleContract::CONTRACT_TYPE_ID.") AS sutarciu_kiekis,
               (SELECT SUM(pps.kaina+pps.avansas) FROM {$this->contractTable} s 
               LEFT JOIN {$this->saleContractTable} pps ON pps.fk_Sutartisid_Sutartis = s.id_Sutartis
                  WHERE s.fk_Savininkoasmens_kodas = u.asmens_kodas OR s.fk_Klientoasmens_kodas = u.asmens_kodas OR s.fk_Brokerioasmens_kodas = u.asmens_kodas) AS sutarciu_verte
               FROM {$this->userTable} u
               LEFT JOIN {$this->addressTable} a ON u.asmens_kodas = a.fk_Asmuoasmens_kodas
               LEFT JOIN {$this->userTypeTable} t ON u.vartotojo_tipas = t.id_Vartotojo_tipas";

        if(!empty($filters))
        {
            $filter_values = [];
            foreach ($filters as $key => $value)
            {
                if($value != '' && !in_array($key, ['module', 'action', 'page']))
                    $filter_values[] = $key." LIKE '%{$value}%'";
            }
            if(!empty($filter_values))
            {
                $sql .= " WHERE ";
                $sql.= implode(' AND ', $filter_values);
            }
        }
        $sql .= " GROUP BY u.asmens_kodas ORDER BY registracijos_data DESC, id_Adresas DESC LIMIT {$offset}, {$limit}";

        return mysql::select($sql);
    }

    public function getUsersReport($filters){
        $sql = "SELECT u.*, a.*, t.name AS vartotojo_tipas, COUNT(a.id_Adresas) AS adresu_kiekis, 
               (SELECT COUNT(*) FROM {$this->contractTable} s 
                  WHERE (s.fk_Savininkoasmens_kodas = u.asmens_kodas OR s.fk_Klientoasmens_kodas = u.asmens_kodas OR s.fk_Brokerioasmens_kodas = u.asmens_kodas) AND s.sutarties_tipas = ".SaleContract::CONTRACT_TYPE_ID.") AS sutarciu_kiekis,
               (SELECT SUM(pps.kaina+pps.avansas) FROM {$this->contractTable} s 
               LEFT JOIN {$this->saleContractTable} pps ON pps.fk_Sutartisid_Sutartis = s.id_Sutartis
                  WHERE s.fk_Savininkoasmens_kodas = u.asmens_kodas OR s.fk_Klientoasmens_kodas = u.asmens_kodas OR s.fk_Brokerioasmens_kodas = u.asmens_kodas) AS sutarciu_verte
               FROM {$this->userTable} u
               LEFT JOIN {$this->addressTable} a ON u.asmens_kodas = a.fk_Asmuoasmens_kodas
               LEFT JOIN {$this->userTypeTable} t ON u.vartotojo_tipas = t.id_Vartotojo_tipas             
               GROUP BY u.asmens_kodas
               HAVING sutarciu_verte >= {$filters['sutarciu_verte_min']} AND sutarciu_verte <= {$filters['sutarciu_verte_max']} 
              ORDER BY registracijos_data DESC, id_Adresas DESC
               ";


        return mysql::select($sql);
    }

    public function getTotalCount(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->userTable}";
        if(!empty($filters))
        {
            $filter_values = [];
            foreach ($filters as $key => $value)
            {
                if($value != '' && !in_array($key, ['module', 'action', 'page']))
                    $filter_values[] = $key." LIKE '%{$value}%'";
            }
            if(!empty($filter_values))
            {
                $sql .= " WHERE ";
                $sql.= implode(' AND ', $filter_values);
            }
        }
        return (int)mysql::select($sql)[0]['total'];
    }

    public function getUserTypes()
    {
        $sql = "SELECT * FROM {$this->userTypeTable}";
        return mysql::select($sql);
    }

    public function insertNewUser($post)
    {
        $userKeys = array_keys($post['user']);
        $userValues = array_values($post['user']);

        $sql = "INSERT INTO {$this->userTable}(" . implode(',', $userKeys) . ") VALUES ('" . implode('\',\'', $userValues) . "')";
        $query = mysql::query($sql);
        if ($query) {
            if(isset($post['address']))
            {
                $addressKeys = "";
                $addressValues = [];
                foreach ($post['address'] as $index => $address)
                {
                    $addressKeys = array_keys($address);
                    $tempAddressValues = array_values($address);
                    $tempAddressValues[] = $post['user']['asmens_kodas'];
                    $addressValues[$index] = "('" . implode('\',\'', $tempAddressValues) . "')";
                }
                $addressKeys[] = 'fk_Asmuoasmens_kodas';

                $sql = "INSERT INTO {$this->addressTable}(" . implode(',', $addressKeys) . ") VALUES ".implode(',',$addressValues);
                if (!mysql::query($sql)){
                    vdd("INSERT ADDRESS FAILED: ".$sql);
                }
                return true;
            } else {
                return true;
            }
        }
        return false;
    }

    public function deleteUser($userId)
    {
        $sql = "DELETE FROM {$this->addressTable} WHERE fk_Asmuoasmens_kodas = {$userId}";
        if(!mysql::query($sql))
            vdd('ADDRESS DELETE ERROR: '.$sql);
        $sql = "DELETE FROM {$this->userTable} WHERE asmens_kodas = {$userId}";
        if(!mysql::query($sql))
            vdd("USER DELETE ERROR: ".$sql);
    }

    public function getUser($userId)
    {
        $data = [];
        $sql = "SELECT * FROM {$this->addressTable} WHERE fk_Asmuoasmens_kodas = {$userId}";
        $data['address'] = mysql::select($sql);
        if(empty($data['address']))
            unset($data['address']);
        $sql = "SELECT * FROM {$this->userTable} WHERE asmens_kodas = {$userId}";
        $data['user'] = mysql::select($sql)[0];

        return $data;
    }

    public function updateUser($userId, $post)
    {
        unset($post['user']['asmens_kodas']);
        $this->deleteAllAddresses($userId);

        if(isset($post['address'])) {
            $addressKeys = "";
            $addressValues = [];
            foreach ($post['address'] as $index => $address) {
                $addressKeys = array_keys($address);
                $tempAddressValues = array_values($address);
                $tempAddressValues[] = $userId;
                $addressValues[$index] = "('" . implode('\',\'', $tempAddressValues) . "')";
            }
            $addressKeys[] = 'fk_Asmuoasmens_kodas';

            $sql = "INSERT INTO {$this->addressTable}(" . implode(',', $addressKeys) . ") VALUES " . implode(',', $addressValues);
            if (!mysql::query($sql)) {
                vd($post['address']);
                vdd("ADDRESS UPDATE FAILED: " . $sql);
            }
        }

        $userValues = [];
        foreach ($post['user'] as $key => $input)
        {
            $userValues[] = $key.'=\''.$input.'\'';
        }

        $sql = "UPDATE {$this->userTable} SET ".implode(',', $userValues)." WHERE asmens_kodas = {$userId}";
        if(!mysql::query($sql))
            vdd('USER UPDATE ERROR: '.$sql);

    }

    private function deleteAllAddresses($userId)
    {
        $sql = "DELETE FROM {$this->addressTable} WHERE fk_Asmuoasmens_kodas = {$userId}";
        if(!mysql::query($sql))
            vdd('ADDRESS DELETE FAILED: '.$sql);
    }

    public function getDistinctCities()
    {
        $sql = "SELECT DISTINCT(miestas) FROM {$this->addressTable}";
        return mysql::select($sql);
    }

    public function getUsersByType(int $userTypeId)
    {
        $sql = "SELECT CONCAT(vardas, \" \", pavarde) AS vardas_pavarde, asmens_kodas AS kodas FROM {$this->userTable} WHERE vartotojo_tipas = {$userTypeId} ORDER BY vardas_pavarde ASC";
        return mysql::select($sql);
    }

    public function getAddressTypes()
    {
        $sql = "SELECT * FROM {$this->addressTypes}";
        return mysql::select($sql);
    }

}