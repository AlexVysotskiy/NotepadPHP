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
    abstract public function select($entityType, $criteria, $order = array(), $page = 0, $limit = 30);

    abstract public function selectOne($entityType, $criteria, $order = array());

    /**
     * удаляем сущности
     */
    abstract public function delete($entitiesList);

    abstract public function deleteByCriteria($entityType, $criteria);
    
//    abstract public function executeCommand();

    public function setConnection(Connection $connection)
    {
        $this->_connection = $connection;
    }

    public function getConnection()
    {
        return $this->_connection;
    }

    public function setEntitySettings($settings)
    {
        $this->_entitySettings = $settings;
    }

}
