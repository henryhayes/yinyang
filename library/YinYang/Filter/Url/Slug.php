<?php
/**
 * Creates a URL slug for SEO friendly URLs from any string.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  Url_Slug
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: Slug.php 2 2011-06-04 17:51:20Z pricespin.craig $
 * @since       Saturday, 04 June 2011
 */

/**
 * Creates a URL slug for SEO friendly URLs from any string.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  Url_Slug
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @since       Saturday, 04 June 2011
*/
class YinYang_Filter_Url_Slug implements Zend_Filter_Interface
{
    protected $_delimiter = '-';

    /**
     * Returns a URL slug for SEO urls.
     *
     * @param   string  $string The string to be filtered.
     * @return  string
     */
    public function filter($string)
    {
        $string = strtolower($string);

        // Trim
        $trim   = new Zend_Filter_StringTrim();
        $string = $trim->filter($string);

        // UTF-8 Decode (for when data is stored in MySQL tables as utf-8)
        $string = utf8_decode($string);

        // HTML Special Characters Decode
        $string = html_entity_decode($string, ENT_QUOTES);

        // Replace & ampersand symbol with the word 'and'. Generally
        // not recommended for SEO urls.
        $string = str_replace('&', 'and', $string);

        $string = str_replace('-', ' ', $string);

        // Only allow alpha-numeric characters with whitespaces
        $alnum = new Zend_Filter_Alnum(true);
        $string = $alnum->filter($string);

        // Replace all instances of whitespace with a single "-" hyphen.
        $string = preg_replace('/\s+/', '-', $string);

        // If the string ends in "and", remove it.
        $string = preg_replace('/-and$/', '', $string);

        return $string;
    }
}