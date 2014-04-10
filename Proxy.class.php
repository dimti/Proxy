<?php
/**
 * Description: Proxy class - at manager for dependency between classes A <-> B
 * Version: 0.0.1
 * Author: Alexander Demidov
 * Author Email: demidov@dimti.ru
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Class Proxy
 */
abstract class Proxy
{
    private static $instances = array();

    /**
     * @param $class
     * @return mixed
     */
    public static function get($class)
    {
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class;
        }
        return self::$instances[$class];
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * TODO: Add support $arguments
     */
    public static function __callStatic($name, $arguments)
    {
        return self::get(substr($name, 3));
    }
}

/**
 * @desc Hook for IDE Auto Completion
 */
if (!class_exists('Proxy')) {
    abstract class Proxy implements iProxy
    {

    }
}
