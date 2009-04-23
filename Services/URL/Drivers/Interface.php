<?php
/**
 * Services URL Interface
 *
 * Anyone in the services_url family must be
 * implementing this in order to be compliant
 * to the driver standard.
 *
 * @author    David Coallier <david@echolibre.com>
 * @package   Services_URL
 * @category  Services
 * @copyright echolibre ltd. 2008
 */
interface Services_URL_Driver_Interface
{
    /**
     * Authorize
     *
     * This method is either used to authorize
     * or set the values for authentication
     * at the API level. Every drivers should have
     * this method.
     *
     * @param  array  $params   The array of values 
     *                          for the authorization
     */
    public function authorize(array $params);

    /**
     * Shorten the url
     *
     * This is the method that all drivers
     * will have in order to shorten the values
     *
     * @param  array $params  The parameters associated
     *                        to the url shortening service.
     */
    public function shorten(array $params);
}
