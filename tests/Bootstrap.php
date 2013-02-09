<?php
/**
 * This is the unit test bootstrap file.
 *
 * @category    YinYang
 * @package     YinYang Unit Tests
 * @subpackage  Bootstrap
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: Bootstrap.php 5 2011-06-05 16:15:08Z pricespin.craig $
 * @link        Some Link...
 * @since       Saturday, 04 June 2011
 */

define('BASE_PATH', dirname(dirname(realpath(__FILE__))));
define('LIBRARY_PATH', BASE_PATH . DIRECTORY_SEPARATOR . 'library');
set_include_path(implode(PATH_SEPARATOR, array(get_include_path(), LIBRARY_PATH)));

require_once('Zend/Loader/Autoloader.php');
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->setFallbackAutoloader(true);