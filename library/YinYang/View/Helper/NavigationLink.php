<?php
/**
 * A view helper that renders a navigation link based on the ID value.
 *
 * @category    YinYang
 * @package     YinYang_View
 * @subpackage  Helper_NavigationLink
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: NavigationLink.php 29 2011-12-20 15:00:17Z mail@henryhayes.co.uk $
 * @since       Saturday, 26 November 2011
 */

/**
 * A view helper that renders a navigation link based on the ID value.
 *
 * @category    YinYang
 * @package     YinYang_View
 * @subpackage  Helper_NavigationLink
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
*/
class YinYang_View_Helper_NavigationLink extends Zend_View_Helper_Abstract
{
    /**
     * This helper can access a navigation link created with Zend Navigation
     * Container. It proxies to the Zend_View_Helper_Navigation helper and
     * then accesses the Zend Navigation element based on it's id that
     * was specified at creation time.
     *
     * To use this helper, you must ensure that any links you create in the
     * Zend Navigation have a specified id. - This is good practice anyway.
     *
     * @example $this->navigationLink('some-link-id', 'My Anchor Text');
     *
     * @param string $pageId Ths unique page Id.
     * @param string $label Link label, defaults to NULL.
     */
    public function navigationLink($pageId, $label = null)
    {
        $container = $this->_getNavigationContainer();
        $page = $container->findOneBy('id', $pageId);

        if ($page instanceof Zend_Navigation_Page) {
            $page = clone $page;
            $page->setLabel(!empty($label) ? $label : $page->getLabel());
            $html = $this->getView()->navigation()->menu()->htmlify($page);
            unset($page);
        } else {
            $html = $this->getView()->escape((string)$label);
        }

        return $html;
    }

    /**
     * Returns an object of type Zend_Navigation_Container.
     *
     * This method returns the navigation container that is held by the
     * Zend_Registry object named 'Zend_Navigation' and is accessable
     * by calling the Zend_View_Helper_Navigation::getContainer() method.
     *
     * @return Zend_Navigation_Container
     */
    protected function _getNavigationContainer()
    {
        return $container = $this->getView()->navigation()->getContainer();
    }

    /**
     * Gets the View object.
     *
     * @return Zend_View
     */
    public function getView()
    {
        return $this->view;
    }
}