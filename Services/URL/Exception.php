<?php
/**
 * Exception class
 * 
 * This is the Services_URL_Exception class that is
 * used thorough the system. You can edit and change
 * The exception messages 
 *
 * @author   David Coallier <david@echolibre.com>
 * @package  Services_URL
 * @abstract The Services_URL_Exception class
 * @uses     Exception
 */
class Services_URL_Exception extends Exception
{
    const DRIVER_DOES_NOT_EXIST = 'Driver does not exist.';
    const CLASS_DOES_NOT_EXIST  = 'Class does not exist.';
}
