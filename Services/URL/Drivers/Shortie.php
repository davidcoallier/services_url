<?php
/**
 * Services URL Driver Shortie
 *
 * This is the class/driver used to make requests
 * on the short.ie api.
 *
 * @category Services
 * @package  Services_URL
 * @author David Coallier <david@echolibre.com>
 * @copyright echolibre ltd. 2008
 */
class Services_URL_Driver_Shortie 
    extends Services_URL_Driver_Common
    implements Services_URL_Driver_Interface
{
    /**
     * The URL
     *
     * @global  The url to place the request on.
     */
    const URL = 'http://short.ie/api?';

    /**
     * The short.ie email key
     *
     * In order to authorize, the short.ie
     * api uses your email address.
     *
     * @var string $email  The email to login with (Default null)
     */
    private $email = null;

    /**
     * The short.ie secret key
     *
     * In order to authorize, the short.ie
     * api uses a secret key that you previously
     * generated on the site.
     */
    private $secretKey = null;

    public function __construct() {}

    /**
     * Authorize
     *
     * It is possible to use the short.ie api
     * anonymously, however if you want to track
     * your clicks, you will need to pass your
     * email and secretKey as array keys here.
     *
     * @param array $params   The authentication parameters
     * @see   $this->email
     * @see   $this->secretKey
     * @return boolean true
     */
    public function authorize(array $params)
    {
        if (isset($params['email'])) {
            $this->email = $params['email'];
        }

        if (isset($params['secretKey'])) {
            $this->secretKey = $params['secretKey'];
        }

        return true;
    }

    /**
     * The most important part. Shorten the URL
     *
     * Shorten the URL. This is the most important
     * part of this is definitely the urlParts passed
     * to the method.
     *
     * The urlParts parameters is constructed of 1 required key
     * and 2 optional parameters.
     * <ul>
     *  <li>(Required)url: The original url</li>
     *  <li>(Optional)custom: The custom url ot use</li>
     *  <li>(Optional)private: Is the url private? (Show or not in the public links)</li>
     * </ul>
     *
     * @param array $urlParts  The url parts
     * @see Services_URL_Drvier_Common::_getJSON()
     * @return mixed Either a result object or false
     */
    public function shorten(array $urlParts)
    {
        if (!isset($urlParts['url'])) {
            return false;
        }

        $urlParts['email']     = $this->email;
        $urlParts['secretKey'] = $this->secretKey;

        $urlParts = http_build_query($urlParts);

        $res = $this->_getJSON(self::URL . $urlParts);
        return $res;
    }
}
