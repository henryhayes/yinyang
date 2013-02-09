<?php
/**
 * TLD information class file.
 *
 * @category    YinYang
 * @package     Service
 * @subpackage  Iana_Tld
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: Tld.php 57 2012-09-11 17:56:41Z mail@henryhayes.co.uk $
 * @since       Sunday, 9th September 2012
 */

/**
 * TLD information class.
 *
 * @category    YinYang
 * @package     Service
 * @subpackage  Iana_Tld
 * @copyright   Copyright (c) 2011 YinYang Library (http://code.google.com/p/yinyang/)
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @since       Sunday, 9th September 2012
*/
class YinYang_Service_Iana_Tld
{
    /**
     * iana TLD text file location
     *
     * @link http://www.icann.org/en/resources/registries/tlds
     * @var string
     */
    protected $_iana = 'http://data.iana.org/TLD/tlds-alpha-by-domain.txt';

    /**
     * The location of the temp path, also setup in the constructor.
     *
     * @var string
     */
    protected $_tempPath = '/tmp';

    /**
     * The name of the temp file to be used for caching.
     *
     * @var string
     */
    protected $_tempFileName = 'tld.tmpq';

    /**
     * The cache time for the ttl of the tld file.
     *
     * @var string
     */
    protected $_cacheTime = 360;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->setTempPath(sys_get_temp_dir());
    }

    /**
     * Get's a new instance of this object, for speed.
     *
     * @return YinYang_Tld
     */
    public static function getInstance()
    {
        return new self();
    }

    /**
     * Sets the temp path for the tld file to live.
     *
     * @param string $path
     * @throws YinYang_Exception
     */
    public function setTempPath($path)
    {
        if (!is_scalar($path)) {
            throw new YinYang_Exception('Temp path must be a string');
        }

        if (!file_exists($path)) {
            throw new YinYang_Exception("Temp path does not exist, used: {$path}");
        }

        if (!is_writable($path)) {
            throw new YinYang_Exception("Temp path is not writable, used: {$path}");
        }

        $this->_tempPath = $path;

        return $this;
    }

    /**
     * Gets the temp path for where the tld file lives.
     *
     * @return string
     */
    public function getTempPath()
    {
        return $this->_tempPath;
    }

    /**
     * Sets the temp file name.
     *
     * @param string $fileName
     */
    public function setTempFileName($fileName)
    {
        $this->_tempFileName = $fileName;

        return $this;
    }

    /**
     * Gets the temp file name.
     *
     * @return string
     */
    public function getTempFileName()
    {
        return $this->_tempFileName;
    }

    /**
     * Sets the TTL for the cache file.
     *
     * @param string $seconds
     * @throws YinYang_Exception
     */
    public function setCacheTime($seconds)
    {
        if (!is_numeric($seconds)) {
            throw new YinYang_Exception('Cache time must be numeric');
        }
        $this->_cacheTime = $seconds;

        return $this;
    }

    /**
     * Gets the TTL for the cache file.
     *
     * @return string
     */
    public function getCacheTime()
    {
        return $this->_cacheTime;
    }

    /**
     * Returns an array of valid top level domain extensions.
     */
    public function getTlds()
    {
        $fileName = $this->getTempPath() . DIRECTORY_SEPARATOR . $this->getTempFileName();
        $this->cacheFile();

        $tlds = file($fileName);
        // Remove the 0 array element.
        array_shift($tlds);

        // remove junk
        for ($i=0; $i<count($tlds); $i++) {
            if ($pos = strpos($tlds[$i], '-')) {
                $tlds[$i] = substr($tlds[$i], 0, $pos);
            }
        }

        $tlds = array_map('trim', $tlds);
        $tlds = array_unique($tlds);
        $tlds = array_map('strtolower', $tlds);

        return $tlds;
    }

    /**
     * Cache's the tld extension file.
     *
     * @throws YinYang_Exception
     * @return YinYang_Tld
     */
    protected function cacheFile()
    {
        $fileName = $this->getTempPath() . DIRECTORY_SEPARATOR . $this->getTempFileName();

        if (!file_exists($fileName) || filemtime($fileName) <= time()-$this->getCacheTime()) {
            if (!copy($this->_iana, $fileName)) {
                throw new YinYang_Exception('Could not be fetch IANA file');
            }
        }

        return  $this;
    }
}