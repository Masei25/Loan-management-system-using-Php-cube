<?php

namespace App\Providers;

use App\Models\UsersModel;

class UsersProvider
{
    const ACCESS_TYPE_ADMIN = 1;
    const ACCESS_TYPE_USER = 0;

    private $_model;

    /**
     * UsersProvider constructor
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->_model = UsersModel::findByPrimaryKey($id);
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