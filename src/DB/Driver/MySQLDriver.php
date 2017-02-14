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

        $newEntities = array();

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

    public function select($entityType, $criteria, $order = null, $offset = 0, $limit = 0)
    {
        
    }

    public function selectOne($entityType, $criteria, $order = null)
    {
        
    }

    public function update($entitiesList)
    {
        
    }

}
