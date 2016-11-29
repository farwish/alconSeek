<?php

use Phalcon\Di;

class Spoor extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $remote_addr;

    /**
     *
     * @var string
     */
    public $user_agent;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'spoor';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BkSpoor[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BkSpoor
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * 新增.
     *
     * @farwish
     */
    public static function insertOne(array $data)
    {
        $db = Di::getDefault()->getShared('db'); 

        $db->insert(
            "spoor",
            array_values($data),
            array_keys($data)
        );

        return $db->lastInsertId();
    }

}
