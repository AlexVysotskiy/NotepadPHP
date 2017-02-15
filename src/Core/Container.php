<?php

namespace Core;

use Core\Exceptions\ParameterNotExistsException;
use Core\Exceptions\ServiceNotExistsException;

/**
 * Класс для 
 *
 * @author Alexander
 */
class Container
{

    /**
     * список сервисов
     * @var type 
     */
    protected $_services = array();

    /**
     * 
     */
    protected $_compiledServices = array();

    /**
     * список параметров
     * @var type 
     */
    protected $_parameters = array();
    protected static $_instance = null;

    private function __construct()
    {
        /* @var $reader ConfigReader */
        $reader = ConfigReader\Factory::getReader('php');
        $reader->addSetting('type', 'params');

        // ппараметры приложения
        $this->_parameters = $reader->read();

        // сервисы
        $reader->addSetting('type', 'services');
        $this->_services = $reader->read();
    }

    public function getParameter($param)
    {
        $paramPath = explode(':', $param);
        $p = array_shift($paramPath);

        $currentResult = isset($this->_parameters[$p]) ? $this->_parameters[$p] : null;

        foreach ($paramPath as $p) {

            if (isset($currentResult[$p])) {

                $currentResult = $currentResult[$p];
            } else {

                throw new ParameterNotExistsException(sprintf('Parameter %s no exists!', $param));
            }
        }

        return $currentResult;
    }

    public function getService($name)
    {
        if (!isset($this->_compiledServices[$name])) {


            if (isset($this->_services[$name])) {

                $params = $this->_services[$name];

                if (!class_exists($params['class'])) {
                    throw new ServiceNotExistsException(sprintf('Class %s not found!', $params['class']));
                }

                $instance = new $params['class']();

                if (isset($params['calls'])) {

                    foreach ($params['calls'] as $methodName => $argsList) {

                        $args = array();

                        foreach ($argsList as $value) {

                            // @ - сервис, % - параметр
                            if (strpos($value, '@') === 0) {

                                $args[] = $this->getService(substr($value, 1));
                            } elseif (strpos($value, '%') === 0) {

                                $args[] = $this->getParameter(substr($value, 1));
                            } else {
                                $args[] = $value;
                            }
                        }

                        call_user_func_array(array($instance, $methodName), $args);
                    }
                }

                $this->_compiledServices[$name] = $instance;
            } else {
                throw new ServiceNotExistsException(sprintf('Service %s no exists!', $name));
            }
        }

        return $this->_compiledServices[$name];
    }

    public static function getInstance()
    {
        return self::$_instance ? : (self::$_instance = new self());
    }

}
