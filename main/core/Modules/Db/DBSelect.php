<?php

namespace App\Core\Modules\Db;

use InvalidArgumentException;

use App\Core\Modules\DB;
use App\Core\Modules\Db\DBQueryBuilder;

class DBSelect extends DBQueryBuilder
{   
    /**
     * Provider class name
     *
     * @var string|null
     */
    public $provider_class = null;

    /**
     * Constructor
     * 
     * @param string $table_name
     * @param array $fields
     * @param string|null $provider_class
     */
    public function __construct($table_name = '', $fields = [], ?string $provider_class = null)
    {
        if($provider_class) {
            $this->provider_class = $provider_class;
        }

        if($table_name) {
            $this->joinSql('SELECT', implode(', ', $fields), 'FROM', $table_name);
        }
    }

    /**
     * Explain query
     *
     * @return object
     */
    public function explain()
    {
        $this->prependSql('EXPLAIN', null);
        return $this->fetchOne(1);
    }

    /**
     * Fetch content
     * 
     * @param int $offset
     * @param int $limit
     * 
     * @return object[]|null results
     */
    public function fetch($offset, $limit = null)
    {
        #if limit is not passed,
        #the offset argument should be passed as limit
        $offset_id = (int) ($limit ? (int) $offset : 0);
        $limit_id = (int) ($limit ? $limit : $offset);

        $this->joinSql(
            null,
            'LIMIT',
            $this->addParam($offset_id), ',',
            $this->addParam($limit_id)
        );

        return $this->get();
    }

    /**
     * Fetch all results
     * 
     * @return object[]|null result
     */
    public function fetchAll()
    {
        return $this->get();
    }

    /**
     * Fetch just one result
     * 
     * @return object|null result
     */
    public function fetchOne()
    {
        $fetched = $this->fetch(0, 1);
        return $fetched ? $fetched[0] : null;
    }

    /**
     * Return query count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->fetchOne()->count;
    }

    /**
     * Get first row based on specified field
     *
     * @param string $field Database table field
     * @return object|null
     */
    public function getFirst($field)
    {
        $this->orderByRaw("{$field} DESC");
        return $this->fetchOne();
    }

    /**
     * Get last row based on on specified field
     *
     * @param string $field Database table field
     * @return object|null
     */
    public function getLast($field)
    {
        $this->orderByRaw("{$field} ASC");
        return $this->fetchOne();
    }

    /**
     * Group query
     * 
     * @param string $field Field name
     * 
     * @return self
     */
    public function groupBy($field)
    {
        $this->joinSql('GROUP BY', $field);
        return $this;
    }

    /**
     * Join On query
     * 
     * @param string $field Field name
     * @param string $column_one
     * @param string $operator
     * @param string $column_two
     * 
     * @return self
     */
    public function join($field, $column_one, $operator, $column_two)
    {
        $this->joinSql(null, 'JOIN', $column_one, $operator, $column_two);
    }

    /**
     * Class name to wrap retrieved item
     *
     * @return self
     */
    public function map()
    {
        $class_name = $this->provider_class;

        if(!class_exists($class_name)) {
            throw new InvalidArgumentException
                ('Cannot use undefined class "' . $class_name . '" ');
        }

        $method_name = self::USE_RESERVED_METHOD_NAME;

        if(!method_exists($class_name, $method_name)) {
            throw new InvalidArgumentException
                ('Method "' . $method_name . '" is not defined in class "' . $class_name . '"');
        }

        $this->bundle = $class_name;
        return $this;
    }

    /**
     * Order query
     * 
     * @param array $order
     * 
     * @return self
     */
    public function orderBy($orders)
    {

        if(!$orders) {
            return $this;
        }

        $orders_list = [];

        foreach($orders as $field => $method) {
            $orders_list[] = $field . ' ' . $method;
        }
        
        $this->joinSql(null, 'ORDER BY', implode(', ', $orders_list));
        return $this;
    }

    /**
     * Raw order by query
     * 
     * @param string    $statement Query statement
     * @param string[]  $params
     */
    public function orderByRaw($statement, $params = [])
    {
        $this->joinSql(null, 'ORDER BY', $statement);
        $this->bindParam($params);

        return $this;
    }

    /**
     * Randomize results
     * 
     * @return self
     */
    public function randomize()
    {
        return $this->orderByRaw('RAND()');
    }

    /**
     * Union stateent
     * 
     * @param DBQueryBuilder $query Query
     * 
     * @return self
     */
    public function union(DBQueryBuilder $query)
    {

        $queryToAppend = (string) $query;
        $this->joinSql(null, 'UNION', $queryToAppend);

        return $this;
    }
    
    /**
     * UnionAll statement
     * 
     * @param DBQueryBuilder $query
     * 
     * @return self
     */
    public function unionAll(DBQueryBuilder $query)
    {

        $queryToAppend = (string) $query;
        $this->joinSql(null, 'UNION ALL', $queryToAppend);

        return $this;
    }

    /**
     * Finish query
     * 
     * @return object|null
     */
    private function get()
    {
        $sql = $this->getSqlQuery();
        $params = $this->getSqlParameters();

        $stmt = DB::statement($sql, $params);
        
        if(!$stmt->rowCount()) {
            return [];
        }

        $fetched_data = $stmt->fetchAll();
        $wrapper = $this->bundle;

        if($wrapper && is_array($fetched_data)) {

            return array_map(function ($item) use ($wrapper) {
                return call_user_func_array([$wrapper, DBQueryBuilder::USE_RESERVED_METHOD_NAME], (array) $item);
            }, $fetched_data);
        }

        return $fetched_data;
    }
}