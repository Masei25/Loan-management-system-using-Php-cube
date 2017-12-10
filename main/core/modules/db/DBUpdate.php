<?php

namespace App\Core\Modules\DB;

use InvalidArgumentException;

use App\Core\Modules\DB;

use App\Core\Modules\DB\DBQueryBuilder;

class DBUpdate extends DBQueryBuilder
{

    /**
     * Constructor
     * 
     * @param string $table_name
     */
    public function __construct($table_name)
    {
        $this->joinSql('UPDATE', $table_name);
    }

    /**
     * Create insert entry
     * 
     * @param string[] $params
     * 
     * @return int
     */
    public function entry($params)
    {
        $this->make($params);
        return $this;
    }

    /**
     * Query executor
     * 
     * @return
     */
    public function fulfil()
    {
        $db = DB::statement($this->getSqlQuery(), $this->getSqlParameters());
        return $db->rowCount();
    }

    /**
     * Make query
     * 
     * @param string[] $params Parameters to make query from
     * 
     * @return 
     */
    private function make($params)
    {
        $keys = array_keys($params);
        $values = array_values($params);
        $placeholders = [];
        
        foreach($keys as $key) $placeholders[] = "{$key} = ?";

        $fields = implode(',', $placeholders);
        $this->bindParam($values);
        $this->joinSql(null, 'SET', $fields);
    }
}