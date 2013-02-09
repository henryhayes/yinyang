<?php
/**
 * Very simple class that simply extends the built-in zend filter
 * class that converts CamelCase to under_score, this class makes
 * all words lower_underscore_case.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  Word_CamelCaseToLowerUnderscore
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: CamelCaseToLowerUnderscore.php 3 2011-06-05 11:21:23Z pricespin.craig $
 * @since       Saturday, 04 June 2011
 */

/**
 * Very simple class that simply extends the built-in zend filter
 * class that converts CamelCase to under_score, this class makes
 * all words lower_underscore_case.
 *
 * @category    YinYang
 * @package     YinYang_Filter
 * @subpackage  Word_CamelCaseToLowerUnderscore
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @since       Saturday, 04 June 2011
*/
class YinYang_Filter_Word_CamelCaseToLowerUnderscore extends Zend_Filter_Word_CamelCaseToUnderscore
{
    public function filter($value)
    {
        $value = parent::filter($value);

        return strtolower($value);
    }
}