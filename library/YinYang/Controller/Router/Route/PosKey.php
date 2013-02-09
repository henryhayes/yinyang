<?php
/**
 * YinYang_Controller_Router_Route_PosKey file.
 *
 * @category    YinYang
 * @package     YinYang_Controller
 * @subpackage  Router_Route_PosKey
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: PosKey.php 43 2012-03-22 23:07:19Z mail@henryhayes.co.uk $
 * @since       Thursday, 08 March 2012
 */

/**
 * YinYang_Controller_Router_Route_PosKey.
 *
 * @category    YinYang
 * @package     YinYang_Controller
 * @subpackage  Router_Route_PosKey
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
*/
class YinYang_Controller_Router_Route_PosKey extends Zend_Controller_Router_Route_Abstract
{
    /**
     * Contains the stem of the route to match.
     *
     * @var string
     */
    protected $_stem;

    /**
     * An array of the positional parameters.
     *
     * @var array
     */
    protected $_positional;

    /**
     *  An array of the named parameters.
     *
     * @var array
     */
    protected $_named;

    /**
     * Holds user submitted default values for route's variables. Name and value pairs.
     *
     * @var array
     */
    protected $_defaults;

    /**
     * An array that contains the
     *
     * @var array
     */
    protected $_data = array();

    /**
     * An array that contains the requirements for matching the positonal and named arguments.
     *
     * @var array
     */
    protected $_reqs = array();

    /**
     * Sets the Url Delimiter to the default URI_DELIMITER.
     *
     * @var string
     */
    protected $_urlDelimiter = self::URI_DELIMITER;

    /**
     * Contains the regex delimiter.
     *
     * @var string
     */
    protected $_regDel = '/';

    /**
     * Constructor that creates
     *
     * @param string $stem
     * @param array  $args
     * @param array  $kwargs
     * @param array  $defaults
     * @param array  $reqs
     */
    public function __construct(
        $stem, array $positional, array $named, array $defaults = array(), array $reqs = array())
    {
        $this->_stem       = $stem;
        $this->_positional = $positional;
        $this->_named      = array_combine($named, $named);
        $this->_defaults   = $defaults;
        $this->_reqs       = $reqs;
    }

    /**
     * Instantiates route based on passed Zend_Config structure
     *
     * @param Zend_Config $config Configuration object
     */
    public static function getInstance(Zend_Config $config)
    {
        $stem       = $config->route;
        $positional = ($config->positional instanceof Zend_Config) ? $config->positional->toArray() : array();
        $named      = ($config->named instanceof Zend_Config) ? $config->named->toArray() : array();
        $defaults   = ($config->defaults instanceof Zend_Config) ? $config->defaults->toArray() : array();
        $reqs       = ($config->reqs instanceof Zend_Config) ? $config->reqs->toArray() : array();

        return new self($config->route, $positional, $named, $defaults, $reqs);
    }

    /**
     * Returns the version of this route. To be used with the router.
     *
     * @see Zend_Controller_Router_Rewrite Line 391(ish)
     * @return int
     */
    public function getVersion()
    {
        return 1;
    }

    /**
     * Matches a user submitted path with parts defined by a map. Assigns and
     * returns an array of variables on a successful match.
     *
     * @param string $path Path used to match against this routing map
     * @return array|false An array of assigned values or a false on a mismatch
     */
    public function match($path)
    {
        $path = trim($path, $this->_urlDelimiter);

        //match the stem
        if (!preg_match('#^'.preg_quote(trim($this->_stem, $this->_urlDelimiter)).'#iuS', $path)) {
            return false;
        }

        //remove the stem
        $path = preg_replace('#^'.preg_quote(trim($this->_stem, $this->_urlDelimiter)).'#iuS', '', $path);

        //tokenise the path
        $parts = explode($this->_urlDelimiter, trim($path, $this->_urlDelimiter));

        $params = array();
        $i = 0;
        //loop through the parts to set variables.
        while ($i < count($parts)) {
            if (isset($this->_named[$parts[$i]])) {
                //capture value
                if (array_key_exists(($i+1), $parts)) {
                    // Check requirements.
                    if (array_key_exists($parts[$i], $this->_reqs)) {
                        $pattern = $this->_regDel . '^' . $this->_reqs[$parts[$i]] . '$' . $this->_regDel . 'iu';
                        if (!@preg_match($pattern, $parts[$i+1])) {
                            return false;
                        }
                    }
                    $params[$parts[$i]] = $parts[$i+1];
                    unset($parts[$i], $parts[$i+1]);
                } else {
                    unset($parts[$i]);
                }
                $parts = array_merge($parts); //reindex the array from 0
            } else {
                $i++;
            }
        }

        $return = $this->_defaults;

        foreach ($parts AS $k => $part) {
            if (array_key_exists($k, $this->_positional)) {
                $name = $this->_positional[$k];
                if (array_key_exists($name, $this->_reqs)) {
                    $pattern = $this->_regDel . '^' . $this->_reqs[$name] . '$' . $this->_regDel . 'iu';
                    if (!@preg_match($pattern, $part)) {
                        return false;
                    }
                }
                $return[$this->_positional[$k]] = $part;
            }
        }
        $this->_data = $return + $params;

        //die(print_r($this->_data));
        return $this->_data;
    }

    /**
     * Generates a URL path that can be used in URL creation, redirection, etc.
     *
     * @param  array $data Options passed by a user used to override parameters
     * @param  mixed $name The name of a Route to use
     * @param  bool $reset Whether to reset to the route defaults ignoring URL params
     * @param  bool $encode Tells to encode URL parts on output
     * @throws Zend_Controller_Router_Exception
     * @return string Resulting absolute URL path
     */
    public function assemble($data = array(), $reset = false, $encode = false)
    {
        if (!$reset && is_array($this->_data)) {
            $data = array_merge($this->_data, $data);
        }

        $url = array();
        $url[] = trim($this->_stem, $this->_urlDelimiter);

        foreach ($this->_positional AS $key => $name) {
            if (array_key_exists($name, $data) && ('' != $data[$name])) {
                if ($encode) {
                    $url[] = urlencode($data[$name]);
                } else {
                    $url[] = $data[$name];
                }
            }
        }

        foreach ($this->_named AS $key) {
            if (array_key_exists($key, $data) && ('' != $data[$key])) {

                $url[] = $key;

                if ($encode) {
                    $url[] = urlencode($data[$key]);
                } else {
                    $url[] = $data[$key];
                }
            }
        }

        //die(print_r($url));

        $assembledRoute = '';
        $assembledRoute = implode($this->_urlDelimiter, $url);

        return $assembledRoute;
    }

    /**
     * Return a single parameter of route's defaults
     *
     * @param string $name Array key of the parameter
     * @return string Previously set default
     */
    public function getDefault($name)
    {
        if (isset($this->_defaults[$name])) {
            return $this->_defaults[$name];
        }
        return null;
    }

    /**
     * Return an array of defaults
     *
     * @return array Route defaults
     */
    public function getDefaults()
    {
        return $this->_defaults;
    }
}