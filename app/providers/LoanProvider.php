<?php

namespace App\Providers;

use App\Models\LoanModel;

class LoanProvider
{
    private $_model;

    /**
     * LoanProvider constructor
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->_model = LoanModel::findByPrimaryKey($id);
    }

    /**
     * Getter
     *
     * @param string $name Field name
     * @param array $args Arguments
     * @return mixed
     */
    public function __call($name, $args)
    {
        return $this->_model->{$name} ?? null;
    }

    /**
     * Setter
     *
     * @param string $name Field name
     * @param mixed $value Field value
     */
    public function __set($name, $value)
    {

    }

    /**
    * Model mapper
    *
    * @return self
    */
    public static function map($id): self
    {
        return new self($id);
    }
}