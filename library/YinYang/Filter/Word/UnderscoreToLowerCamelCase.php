<?php
/**
 * Very simple class that simply extends the built-in zend filter
 * class that converts under_score to CamelCase, this class makes
 * the first word lower case; known as lowerCamelCase.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  Word_UnderscoreToLowerCamelCase
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: UnderscoreToLowerCamelCase.php 3 2011-06-05 11:21:23Z pricespin.craig $
 * @since       Saturday, 04 June 2011
 */

/**
 * Very simple class that simply extends the built-in zend filter
 * class that converts under_score to CamelCase, this class makes
 * the first word lower case; known as lowerCamelCase.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  Word_UnderscoreToLowerCamelCase
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @since       Saturday, 04 June 2011
*/
class YinYang_Filter_Word_UnderscoreToLowerCamelCase extends Zend_Filter_Word_UnderscoreToCamelCase
{
    public function filter($value)
    {
        $value = parent::filter($value);

        return lcfirst($value);
    }
}