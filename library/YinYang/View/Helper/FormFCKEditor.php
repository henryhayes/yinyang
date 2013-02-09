<?php
/**
 * A view helper that creates a FCKeditor wysiwyg box.
 *
 * @category    YinYang
 * @package     YinYang_View
 * @subpackage  Helper_FormFCKEditor
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: FormFCKEditor.php 13 2011-06-14 14:44:37Z mail@henryhayes.co.uk $
 * @since       Tuesday, 14 June 2011
 */

/**
 * A view helper that implements the SentenceLength filter.
 *
 * @category    YinYang
 * @package     YinYang_View
 * @subpackage  Helper_FormFCKEditor
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
*/
class YinYang_View_Helper_FormFCKEditor extends Zend_View_Helper_FormTextarea
{
    /**
    * How many instances of the wysiwyg editor is set in the form
    *
    * @var int
    */
    public static $instances = 0;

    /**
    * Generates a 'wysiwyg' textarea element.
    *
    * @param string|array $name If a string, the element name.
    * @param mixed $value The element value.
    * @param array $attribs Attributes for the element tag.
    *
    * @return string The element XHTML.
    */
    public function formFCKEditor($name, $value = null, $attribs = null)
    {
        $info = $this->_getInfo($name, $value, $attribs);
        extract($info); // name, value, attribs, options, listsep, disable

        $xhtml = $this->formTextarea($name, $value, $attribs);
        $xhtml .= '<script type="text/javascript">
            window.onload = function()
            {
                var oFCKeditor = new FCKeditor("' . $this->view->escape($id) . '");
                oFCKeditor.ReplaceTextarea();
            }
            </script>';
        self::$instances++;

        if (self::$instances == 1) {
            $this->view->headScript()->appendFile($this->view->baseUrl() . '/js/fckeditor/fckeditor.js');
        }
        return $xhtml;
    }
}