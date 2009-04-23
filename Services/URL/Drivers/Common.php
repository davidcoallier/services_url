<?php
require_once 'HTTP/Request2.php';
/**
 * Services URL Driver Common
 *
 * This is the class that places the request and either
 * returns the result as clear text, or as a json or
 * an xml object.
 *
 * @category    Services
 * @package     Services_URL
 * @author      David Coallier <david@echolibre.com>
 * @copyright   echolibre ltd. 2008
 * @uses        HTTP_Request2
 */
abstract class Services_URL_Driver_Common
{
    /**
     * Get the request
     *
     * Place the request using the
     * decided url.
     *
     * This is using HTT_Request2 to make the
     * request and returns the body of the
     * HTTP_Request2_Response.
     *
     * @param  string $url    The url to place the query on.
     * @use    HTTP_Request2
     *
     * @return mixed          Either the body of the request
     *                        or a false response.
     */
    protected function _getRequest($url)
    {
        $req = new HTTP_Request2($url);
        $response = $req->send();

        return $response->getBody(); 
    }

    /**
     * Get JSON
     *
     * Place the request on the server and 
     * get the request in form of a json object
     *
     * @param  string  $url   The url to place the request on.
     * @return JsonObj        The json_decoded object or false
     */
    protected function _getJSON($url)
    {
        $jsonResult = $this->_getRequest($url);
        if ($jsonResult != '') {
            return json_decode($jsonResult);
        }

        return false;
    }

    /**
     * Get XML
     *
     * This method will return the SimpleXML
     * element object.
     *
     * @param   string    $url  The url to place the request on.
     * @return  SimpleXML       Either a simplexml element object or 
     *                          boolean false value
     */
    protected function _getXML()
    {
        $xmlResult = $this->_getRequest($url);
        if ($xmlResult != '') {
            return simplexml_load_string($xmlResult);
        }

        return false;
    }
}
