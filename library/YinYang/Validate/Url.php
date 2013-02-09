<?php
/**
 * Url validator.
 *
 * @category    YinYang
 * @package     YinYang_Validate
 * @subpackage  Url
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: Url.php 23 2011-11-09 12:59:52Z mail@henryhayes.co.uk $
 * @since       Monday, 06 June 2011
 */

/**
 * Url validator that validates against the schemes in
 * the $_schemes member variable.
 *
 * @category    YinYang
 * @package     YinYang_Validate
 * @subpackage  Url
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
*/
class YinYang_Validate_Url extends Zend_Validate_Abstract
{
    /**
     * Schemes that are considered valid.
     *
     * @var string
     */
    protected $_schemes = array('http', 'https', 'ftp');

    /**
     * Default error message handle.
     *
     * @var string
     */
    const INVALID_SCHEME = 'invalidScheme';

    /**
     * Invalid url error message handle.
     *
     * @var string
     */
    const INVALID_SYNTAX = 'invalidSyntax';

    /**
     * Invalid url error message handle.
     *
     * @var string
     */
    const INVALID_HOSTNAME = 'invalidHostname';

    /**
     * A string that contains a validation IP address regular expression.
     *
     * @var string
     */
    const VALID_IP_REGEX =
        '/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/';

    /**
     * Array of error messages.
     *
     * @var string
     */
    protected $_messageTemplates = array(
        self::INVALID_SCHEME    => "'%value%' does not have a valid scheme",
        self::INVALID_SYNTAX    => "'%value%' does not appear to be a syntactically correct url format",
        self::INVALID_HOSTNAME  => "'%value%' is not a valid url"
    );

    /**
     * Checks if $value is valid based on whether it's symantically
     * correct and starts with a valid scheme, i.e. http, https or ftp.
     *
     * This should really be improved to check if the hostname
     * resolves etc. For backward compatibility, however, default behaviour
     * should always be to simply check if the url is symantically correct.
     *
     * @param   string  $value
     */
    public function isValid($value)
    {
        $this->_setValue($value);

        $uri            = explode(':', $this->value, 2);
        $scheme         = strtolower($uri[0]);

        /**
         * There is a bug in previoud versions of PHP
         * which don't allow hyphenated domain names.
         *
         * @see https://bugs.php.net/bug.php?id=51192
         */
        if (version_compare(PHP_VERSION, '5.3.3') >= 0) {
            if (false === filter_var($this->value, FILTER_VALIDATE_URL)) {

                $this->_error(self::INVALID_SYNTAX);
                return false;
            }
        }

        if (!in_array($scheme, $this->_schemes)) {

            $this->_error(self::INVALID_SCHEME);
            return false;
        }

        $hostname = parse_url($this->value, PHP_URL_HOST);

        if (!preg_match(self::VALID_IP_REGEX, gethostbyname($hostname))) {

            $this->_error(self::INVALID_HOSTNAME);
            return false;
        }

        return true;
    }
}
