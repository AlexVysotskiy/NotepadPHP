<?php

namespace Core;

/**
 * Считываем конфиги в разных форматах и возвращаем приложению
 *
 * @author Alexander
 */
abstract class ConfigReader
{

    protected $_settings = array();

    public function __construct($settings = array())
    {
        if ($settings) {
            $this->setSettings($settings);
        }
    }

    abstract public function read();

    public function setSettings($settings)
    {
        if (is_array($settings)) {
            $this->_settings = $settings;
        }
    }

    public function addSettings($settings)
    {
        if (is_array($settings)) {
            $this->_settings += $settings;
        }
    }

    public function addSetting($name, $value)
    {
        $this->_settings[$name] = $value;
    }

}
