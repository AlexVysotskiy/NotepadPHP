<?php

namespace DB;

/**
 * Description of Entity
 *
 * @author Alexander
 */
abstract class Entity
{

    /**
     * значение primary key
     */
    abstract public function getId();

    public function getType()
    {
        throw new \Exception('Method is not implemented!');
    }

    /**
     * собираем сущность из данных
     */
    abstract public function fromArray($params);

    /**
     * подготавливаем данные для сохранения
     */
    abstract public function toArray();
}
