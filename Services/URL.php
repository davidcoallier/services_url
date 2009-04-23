<?php
require_once 'Services/URL/Exception.php';

require_once 'Services/URL/Drivers/Common.php';
require_once 'Services/URL/Drivers/Interface.php';
/**
 * Services_URL Class
 * 
 * This class is used in order to retrieve instances
 * and should not be instantiated by itself.
 *
 * @category  Services
 * @author    David Coallier <david@echolibre.com>
 * @package   Services_URL
 * @copyright echolibre ltd. 2008
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
abstract class Services_URL
{
    const OUTPUT_XML  = 'xml';
    const OUTPUT_JSON = 'json';
    
    /**
     * Instances
     *
     * This variables stores the instances
     * that are already instantiated of Services_URL_*
     * objects.
     */
    protected static $instances = array();
    
    /**
     * Factory method
     *
     * This method will be used mostly to generate
     * or retrieve existing objects of the requested
     * URL Shortening service's API.
     *
     * @param  string $method                    The method to load (Driver)
     * @return mixed  self::$instances[$method]  An instance of the requested
     *                                           driver.
     */
    public static function factory($method)
    {
        $method = ucfirst(strtolower($method));
        
        if (isset(self::$instances[$method])) {
            return self::$instances[$method];
        }
        
        $file = 'Services/URL/Drivers/' . $method . '.php';
        if (!file_exists($file)) {
            throw new Services_URL_Exception(
                Services_URL_Exception::DRIVER_DOES_NOT_EXIST
            );
        }
        include_once $file;

        $class = 'Services_URL_Driver_' . $method;
        if (!class_exists($class)) {
            throw new Services_URL_Exception(
                Services_URL_Exception::CLASS_DOES_NOT_EXIST
            );
        }
        
        self::$instances[$method] = new $class();
        return self::$instances[$method];
    }
}

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 foldmethod=marker: */
?>
