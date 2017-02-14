<?php

namespace DB\Driver;

use DB\Driver;

/**
 * Description of MySQLDriver
 *
 * @author Alexander
 */
class MySQLDriver extends Driver
{

    public function delete($entitiesList)
    {
        if (!is_array($entitiesList)) {
            $entitiesList = array();
        }

        $removedEntities = array();

        foreach ($entitiesList as $entity) {

            if ($entity instanceof \DB\Entity) {

                $entityType = $entity->getType();
                if (!isset($removedEntities[$entityType])) {
                    $removedEntities[$entityType] = array();
                }

                $removedEntities[$entityType][] = $entity->getId();
            }
        }

        if ($removedEntities) {

            /* @var $connection \PDO */
            $connection = $this->_connection->getConnection();

            try {

                $connection->beginTransaction();

                $command = new \DB\Query\Mysql\Delete();
                foreach ($removedEntities as $entityType => $ids) {

                    if ($ids && isset($this->_entitySettings['entities'][$entityType]['table'])) {

                        $command->setTable($this->_entitySettings['entities'][$entityType]['table']);
                        $command->setLimit(count($ids));
                        $command->where()->in('id', $ids);

                        $connection->prepare($command->compile())->execute();
                    }
                }

                $connection->commit();
            } catch (\Exception $e) {

                $connection->rollBack();

                throw $e;
            }
        }
    }

    public function deleteByCriteria($entityType, $criteria)
    {
        if (isset($this->_entitySettings['entities'][$entityType]['table'])) {

            /* @var $connection \PDO */
            $connection = $this->_connection->getConnection();

            $command = new \DB\Query\Mysql\Delete();
            try {

                $connection->beginTransaction();

                $command->setTable($this->_entitySettings['entities'][$entityType]['table']);

                foreach ($criteria as $info) {
                    $command->where()->add($info[0], $info[1], $info[2]);
                }

                $connection->prepare($command->compile())->execute();

                $connection->commit();
            } catch (\Exception $e) {

                $connection->rollBack();

                throw $e;
            }
        } else {
            throw new \DB\Exception\DBException(sprintf('Unknown %s entity type!', $entityType));
        }
    }

    public function insert($entitiesList)
    {
        if (!is_array($entitiesList)) {
            $entitiesList = array();
        }

        /* @var $connection \PDO */
        $connection = $this->_connection->getConnection();

        try {

            $settings = $this->_entitySettings['entities'];
            $command = new \DB\Query\Mysql\Insert();

            $connection->beginTransaction();

            foreach ($entitiesList as $entity) {

                if ($entity instanceof \DB\Entity) {

                    if (isset($settings[$entity->getType()]['table'])) {

                        $values = $entity->toArray();

                        $command->setTable($settings[$entity->getType()]['table']);
                        $command->setInsertCount(1);
                        $command->setFields(array_keys($values));

                        $connection->prepare($command->compile())->execute(array_values($values));
                    }
                }
            }

            $connection->commit();
        } catch (\Exception $e) {

            $connection->rollBack();

            throw $e;
        }
    }

    public function select($entityType, $criteria, $order = array(), $page = 0, $limit = 30)
    {
        if (isset($this->_entitySettings['entities'][$entityType]['table'])) {

            $settings = $this->_entitySettings['entities'][$entityType];

            /* @var $connection \PDO */
            $connection = $this->_connection->getConnection();

            try {

                $command = new \DB\Query\Mysql\Insert();
                $command->setTable($settings['table']);
                $command->setOrder($order);
                $command->setPage($page);
                $command->setLimit($limit);

                foreach ($criteria as $info) {
                    $command->where()->add($info[0], $info[1], $info[2]);
                }

                $command->setFields(array('*'));

                $sth = $connection->query($command->compile());
                $sth->setFetchMode(\PDO::FETCH_CLASS, $settings['class']);

                $result = array();
                /* @var $entity \DB\Entity */
                while ($entity = $sth->fetch()) {

                    $result[$entity->getId()] = $entity;
                }

                return $result;
            } catch (\Exception $e) {

                throw $e;
            }
        } else {
            throw new \DB\Exception\DBException(sprintf('Unknown %s entity type!', $entityType));
        }
    }

    public function selectOne($entityType, $criteria, $order = array())
    {
        $result = $this->select($entityType, $criteria, $order, 0, 1);

        return $result ? reset($result) : $result;
    }

    public function update($entitiesList)
    {
        if (!is_array($entitiesList)) {
            $entitiesList = array();
        }

        /* @var $connection \PDO */
        $connection = $this->_connection->getConnection();

        try {

            $settings = $this->_entitySettings['entities'];
            $command = new \DB\Query\Mysql\Update();

            $connection->beginTransaction();

            foreach ($entitiesList as $entity) {

                if ($entity instanceof \DB\Entity) {

                    if (isset($settings[$entity->getType()]['table'])) {

                        $values = $entity->toArray();

                        $command->setTable($settings[$entity->getType()]['table']);
                        $command->setFields(array_keys($values));

                        $connection->prepare($command->compile())->execute($values);
                    }
                }
            }

            $connection->commit();
        } catch (\Exception $e) {

            $connection->rollBack();

            throw $e;
        }
    }

    public function setConnectionSettings($settings)
    {
        $this->_connection = new \DB\Connection\MySQLConnection(new \DB\Settings($settings));
    }

}
