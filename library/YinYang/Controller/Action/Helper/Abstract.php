<?php
/**
 * YinYang_Controller_Action_Helper_Abstract file.
 *
 * @category    YinYang
 * @package     YinYang_Controller
 * @subpackage  Action_Helper_Abstract
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: Abstract.php 45 2012-03-24 10:35:15Z mail@henryhayes.co.uk $
 * @since       Saturday 24 March 2012
 */

/**
 * YinYang_Controller_Action_Helper_Abstract class.
 *
 * @category    YinYang
 * @package     YinYang_Controller
 * @subpackage  Action_Helper_Abstract
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
*/
abstract class YinYang_Controller_Action_Helper_Abstract extends Zend_Controller_Action_Helper_Abstract
{
    /**
     * Returns an instance of Zend_View.
     *
     * @return Zend_View
     */
    protected function _getView()
    {
        return $this->_getHelperViewRenderer()->view;
    }

    /**
     * Returns an instance of the url helper.
     *
     * @return Zend_Controller_Action_Helper_ViewRenderer
     */
    protected function _getHelperViewRenderer()
    {
        return Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
    }
}