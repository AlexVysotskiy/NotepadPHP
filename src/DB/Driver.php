<?php

namespace DB;

/**
 * Description of Driver
 *
 * @author Alexander
 */
abstract class Driver
{

    /**
     *
     * @var Connection
     */
    protected $_connection = null;

    /**
     * настройки сущностей
     * @var type 
     */
    protected $_entitySettings = array();

    /**
     * добавляем сущности в базу
     */
    abstract public function insert($entitiesList);

    /**
     * обновляем сущности в базе
     */
    abstract public function update($entitiesList);

    /**
     * выбираем сущность
     */
    abstract public function select($criteria, $order = null, $offset = 0, $limit = 0);

    abstract public function selectOne($criteria, $order = null);

    /**
     * удаляем сущности
     */
    abstract public function delete($entitiesList);

    abstract public function deleteByCriteria($criteria);

    public function setConnection(Connection $connection)
    {
        $this->_connection = $connection;
    }

    public function setEntitySettings($settings)
    {
        $this->_entitySettings = $settings;
    }

}
