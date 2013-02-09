<?php
/**
 * This is a FCKEditor for element.
 *
 * @category    YinYang
 * @package     YinYang_Form
 * @subpackage  Element_FCKEditor
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: FCKEditor.php 13 2011-06-14 14:44:37Z mail@henryhayes.co.uk $
 * @since       Tuesday, 14 June 2011
 */

/**
 * This is a FCKEditor for element.
 *
 * @category    YinYang
 * @package     YinYang_Form
 * @subpackage  Element_FCKEditor
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 *
 * @link        http://www.websitefactors.co.uk/zend-framework/2011/05/fckeditor-zend-form-integration/
*/
class YinYang_Form_Element_FCKEditor extends Zend_Form_Element_Xhtml
{
    /**
    * Use formFCKEditor view helper by default
    *
    * @var string
    */
    public $helper = 'formFCKEditor';
}