<?php
/**
 * Unit test for the YinYang_Filter_NavigationLink class.
 *
 * @category    YinYang
 * @package     YinYang_View_Helper_NavigationLink
 * @subpackage  UnitTest
 * @since       Saturday, 26 November 2011
 * @version     $Id: NavigationLink.test.php 27 2011-11-26 14:06:23Z mail@henryhayes.co.uk $
 */
class YinYang_View_Helper_NavigationLinkTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests the functionality of when the pade ID exists.
     */
    public function testNavigationLinkWithValidPage()
    {
        $pageMock = $this->getMock('Zend_Navigation_Page_Mvc', null);
        $pageMock->setId('my-page-id');
        $pageMock->setLabel('my-page-label');

        $containerMock = $this->getMock('Zend_Navigation_Container', array('findOneBy'));
        $containerMock->expects($this->once())
            ->method('findOneBy')
            ->with($this->equalTo('id'), $this->equalTo('my-page-id'))
            ->will($this->returnValue($pageMock));
        $containerMock->addPage($pageMock);

        $menuMethodMock = $this->getMock('stdClass', array('htmlify'));
        $menuMethodMock->expects($this->once())
            ->method('htmlify')
            ->will($this->returnValue($pageMock->getId()));

        $navigationMock = $this->getMock('stdClass', array('getContainer', 'menu'));
        $navigationMock->expects($this->once())
            ->method('getContainer')
            ->will($this->returnValue($containerMock));
        $navigationMock->expects($this->once())
            ->method('menu')
            ->will($this->returnValue($menuMethodMock));

        $viewMock = $this->getMock('Zend_View', array('navigation'));
        $viewMock->expects($this->exactly(2))
            ->method('navigation')
            ->will($this->returnValue($navigationMock));

        $helperMock = $this->getMock('YinYang_View_Helper_NavigationLink', array('getView'));
        $helperMock->expects($this->exactly(2))
            ->method('getView')
            ->will($this->returnValue($viewMock));

        $this->assertSame('my-page-id', $helperMock->navigationLink('my-page-id'));
    }

    /**
     * This tests whether the string label is escaped and sent
     * back to the view as a non-link.
     */
    public function testNavigationLinkWithoutValidPage()
    {
        $containerMock = $this->getMock('Zend_Navigation_Container', array('findOneBy'));
        $containerMock->expects($this->once())
            ->method('findOneBy')
            ->with($this->equalTo('id'), $this->equalTo('my-page-id'))
            ->will($this->returnValue(null));

        $navigationMock = $this->getMock('stdClass', array('getContainer', 'menu'));
        $navigationMock->expects($this->once())
            ->method('getContainer')
            ->will($this->returnValue($containerMock));

        $viewMock = $this->getMock('Zend_View', array('navigation', 'escape'));
        $viewMock->expects($this->once())
            ->method('navigation')
            ->will($this->returnValue($navigationMock));
        $viewMock->expects($this->once())
            ->method('escape')
            ->will($this->returnArgument(0));

        $helperMock = $this->getMock('YinYang_View_Helper_NavigationLink', array('getView'));
        $helperMock->expects($this->exactly(2))
            ->method('getView')
            ->will($this->returnValue($viewMock));

        $this->assertSame('my-label', $helperMock->navigationLink('my-page-id', 'my-label'));
    }
}