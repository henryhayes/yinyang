<?php
/**
 * Abstract class for controller plugins file.
 *
 * @category    YinYang
 * @package     YinYang_Controller
 * @subpackage  Plugin_Abstract
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: Abstract.php 31 2012-01-11 08:38:47Z mail@henryhayes.co.uk $
 * @since       Wednesday, 11th January 2012
 */

/**
 * Abstract class for controller plugins.
 *
 * @category    YinYang
 * @package     YinYang_Controller
 * @subpackage  Plugin_Abstract
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
*/
abstract class YinYang_Controller_Plugin_Abstract extends Zend_Controller_Plugin_Abstract
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

    /**
     * Returns an instance of the redirector helper.
     *
     * @return Zend_Controller_Action_Helper_Redirector
     */
    protected function _getHelperRedirect()
    {
        return Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
    }

    /**
     * Returns an instance of the redirector layout.
     *
     * @return Zend_Layout_Controller_Action_Helper_Layout
     */
    protected function _getHelperLayout()
    {
        return Zend_Controller_Action_HelperBroker::getStaticHelper('layout');
    }

    /**
     * Returns an instance of the url helper.
     *
     * @return Zend_Controller_Action_Helper_Url
     */
    protected function _getHelperUrl()
    {
        return Zend_Controller_Action_HelperBroker::getStaticHelper('url');
    }

    /**
     * Returns the zend navigation container.
     *
     * @return Zend_Navigation_Container
     */
    protected function _getNavigationContainer()
    {
        return $this->_getView()->getHelper('navigation')->navigation()->getContainer();
    }
}